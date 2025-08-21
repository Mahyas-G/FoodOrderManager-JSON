<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiscountController extends Controller
{
    private $discountPath = 'data/discounts.json';
    private $orderPath = 'data/orders.json';

    public function apply(Request $request, $code)
    {
        $discounts = [];
        if (Storage::exists($this->discountPath)) {
            $discounts = json_decode(Storage::get($this->discountPath), true);
        }

        $discount = collect($discounts)->firstWhere('code', $code);

        if (!$discount) {
            return back()->withErrors(['error' => 'کد تخفیف معتبر نیست.']);
        }

        $user = session('user');
        if (!$user) {
            return back()->withErrors(['error' => 'ابتدا وارد حساب خود شوید.']);
        }

        $orders = [];
        if (Storage::exists($this->orderPath)) {
            $orders = json_decode(Storage::get($this->orderPath), true);
        }

        $userOrders = array_filter($orders, fn($o) => $o['user_id'] == $user['id']);
        $lastOrderKey = array_key_last($userOrders);

        if ($lastOrderKey === null) {
            return back()->withErrors(['error' => 'سفارشی برای اعمال تخفیف یافت نشد.']);
        }

        $orders[$lastOrderKey]['discount'] = $discount;
        Storage::put($this->orderPath, json_encode($orders, JSON_PRETTY_PRINT));

        return back()->with('success', 'کد تخفیف با موفقیت اعمال شد.');
    }
}
