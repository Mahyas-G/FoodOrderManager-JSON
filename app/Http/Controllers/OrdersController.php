<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    private $orderPath     = 'data/orders.json';
    private $paymentPath   = 'data/payment_history.json';
    private $discountsPath = 'data/discounts.json';
    private $menuPath      = 'data/menu.json';

    public function create($food_id)
    {
        if (!session()->has('user')) {
            return redirect()->route('login.form')->with('error', 'برای ثبت سفارش ابتدا وارد شوید.');
        }

        $foods = Storage::exists($this->menuPath)
            ? json_decode(Storage::get($this->menuPath), true)
            : [];

        $food = collect($foods)->firstWhere('id', (int)$food_id);
        if (!$food) {
            abort(404, 'غذا یافت نشد.');
        }

        return view('orders.create', ['food' => $food]);
    }

    public function store(Request $request, $food_id)
    {
        if (!session()->has('user')) {
            return redirect()->route('login.form')->with('error', 'برای ثبت سفارش ابتدا وارد شوید.');
        }

        $foods = Storage::exists($this->menuPath)
            ? json_decode(Storage::get($this->menuPath), true)
            : [];

        $food = collect($foods)->firstWhere('id', (int)$food_id);
        if (!$food) {
            abort(404, 'غذا یافت نشد.');
        }

        $orders = Storage::exists($this->orderPath)
            ? json_decode(Storage::get($this->orderPath), true)
            : [];

        $discounts = Storage::exists($this->discountsPath)
            ? json_decode(Storage::get($this->discountsPath), true)
            : [];

        $userId   = session('user.id');
        $quantity = max((int)$request->input('quantity', 1), 1);
        $price    = $food['price'] * $quantity;
        $discountAmount = 0;

        if ($request->filled('discount_code')) {
            $code = strtoupper(trim($request->discount_code));
            $discount = collect($discounts)->first(fn($d) =>
                strtoupper($d['code']) === $code && now()->lte($d['valid_until'])
            );

            if ($discount) {
                if ($discount['type'] === 'percentage') {
                    $discountAmount = ($price * $discount['amount']) / 100;
                } elseif ($discount['type'] === 'fixed') {
                    $discountAmount = $discount['amount'];
                }
            }
        }

        $finalPrice = max($price - $discountAmount, 0);

        $order = [
            'id'         => count($orders) + 1,
            'user_id'    => $userId,
            'food_id'    => $food['id'],
            'food_name'  => $food['name'],
            'quantity'   => $quantity,
            'unit_price' => $food['price'],
            'total'      => $finalPrice,
            'status'     => 'pending',
            'created_at' => now()->toDateTimeString()
        ];

        $orders[] = $order;
        Storage::put($this->orderPath, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('orders.pay', $order['id']);
    }

    public function pay($order_id)
    {
        $orders = Storage::exists($this->orderPath)
            ? json_decode(Storage::get($this->orderPath), true)
            : [];

        $order = collect($orders)->firstWhere('id', (int)$order_id);
        if (!$order) {
            abort(404, 'سفارش یافت نشد.');
        }

        return view('orders.pay', ['order' => $order]);
    }

    public function processPayment($order_id)
    {
        $orders = Storage::exists($this->orderPath)
            ? json_decode(Storage::get($this->orderPath), true)
            : [];

        $index = array_search((int)$order_id, array_column($orders, 'id'));
        if ($index === false) {
            abort(404, 'سفارش یافت نشد.');
        }

        $status = rand(0, 1) ? 'Completed' : 'Failed';
        $orders[$index]['status'] = $status === 'Completed' ? 'completed' : 'cancelled';

        Storage::put($this->orderPath, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $payments = Storage::exists($this->paymentPath)
            ? json_decode(Storage::get($this->paymentPath), true)
            : [];

        $payments[] = [
            'order_id'       => $orders[$index]['id'],
            'user_id'        => $orders[$index]['user_id'],
            'amount'         => $orders[$index]['total'],
            'payment_status' => $status,
            'payment_date'   => now()->toDateTimeString()
        ];

        Storage::put($this->paymentPath, json_encode($payments, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('menu.index')
            ->with($status === 'Completed' ? 'success' : 'error',
                $status === 'Completed' ? 'پرداخت با موفقیت انجام شد.' : 'پرداخت لغو شد.');
    }
}
