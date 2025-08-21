<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    private $orderPath = 'data/orders.json';
    private $paymentPath = 'data/payments.json';

    public function process($order_id)
    {
        return redirect("/payment/result/success/{$order_id}");
    }

    public function result($status, $order_id)
    {
        $orders = [];
        if (Storage::exists($this->orderPath)) {
            $orders = json_decode(Storage::get($this->orderPath), true);
        }

        $orderKey = array_search((int)$order_id, array_column($orders, 'id'));
        if ($orderKey === false) {
            return view('payment.result', [
                'status' => 'failed',
                'order_id' => $order_id
            ]);
        }

        $orders[$orderKey]['status'] = ($status === 'success') ? 'paid' : 'failed';
        Storage::put($this->orderPath, json_encode($orders, JSON_PRETTY_PRINT));

        $payments = [];
        if (Storage::exists($this->paymentPath)) {
            $payments = json_decode(Storage::get($this->paymentPath), true);
        }

        $payments[] = [
            'order_id' => (int)$order_id,
            'status'   => $status,
            'date'     => now()->toDateTimeString(),
        ];

        Storage::put($this->paymentPath, json_encode($payments, JSON_PRETTY_PRINT));

        return view('payment.result', [
            'status' => $status,
            'order_id' => $order_id
        ]);
    }
}
