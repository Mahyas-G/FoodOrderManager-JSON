<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    private string $orderPath   = 'data/orders.json';
    private string $paymentPath = 'data/payments.json';
    private string $menuPath    = 'data/menu.json';
    private string $surveyPath  = 'data/surveys.json';
    private string $userPath    = 'data/users.json';

    public function index()
    {
        $orders = Storage::exists($this->orderPath)
            ? (json_decode(Storage::get($this->orderPath), true) ?: [])
            : [];

        return view('admin.reports.index', compact('orders'));
    }

    public function orders()
    {
        $orders = Storage::exists($this->orderPath)
            ? (json_decode(Storage::get($this->orderPath), true) ?: [])
            : [];

        $users  = Storage::exists($this->userPath)
            ? (json_decode(Storage::get($this->userPath), true) ?: [])
            : [];

        $usersById = collect($users)->keyBy('id');

        foreach ($orders as &$order) {
            $user = $usersById->get($order['user_id'] ?? null, []);
            $order['user_email'] = $user['email'] ?? '---';

            $order['created_at'] = $order['created_at'] ?? ($order['date'] ?? null);

            $order['status'] = $order['status'] ?? 'pending';

            if (!isset($order['total']) && isset($order['items']) && is_array($order['items'])) {
                $order['total'] = collect($order['items'])->sum(function ($it) {
                    return (int)($it['price'] ?? 0) * (int)($it['qty'] ?? 1);
                });
            }
        }
        unset($order);

        return view('admin.reports.orders', compact('orders'));
    }

    public function payments()
    {
        $payments = Storage::exists($this->paymentPath)
            ? (json_decode(Storage::get($this->paymentPath), true) ?: [])
            : [];

        foreach ($payments as &$p) {
            $p['created_at'] = $p['created_at'] ?? ($p['date'] ?? null);
        }
        unset($p);

        return view('admin.reports.payments', compact('payments'));
    }

    public function popular()
    {
        $surveys = [];
        if (Storage::exists($this->surveyPath)) {
            $surveys = json_decode(Storage::get($this->surveyPath), true);
        }

        $foods = [];
        if (Storage::exists($this->menuPath)) {
            $foods = json_decode(Storage::get($this->menuPath), true);
        }

        $popularFoods = [];

        foreach ($foods as $food) {
            $foodSurveys = collect($surveys)->where('food_id', $food['id']);
            $count = $foodSurveys->count();
            $avg   = $count > 0 ? round($foodSurveys->avg('rating'), 1) : 0;

            $popularFoods[] = [
                'id'          => $food['id'],
                'name'        => $food['name'],
                'description' => $food['description'] ?? '',
                'price'       => $food['price'] ?? 0,
                'image'       => $food['image'] ?? null,
                'votes'       => $count,
                'average'     => $avg,
            ];
        }

        usort($popularFoods, function ($a, $b) {
            if ($a['average'] == $b['average']) {
                return $b['votes'] <=> $a['votes'];
            }
            return $b['average'] <=> $a['average'];
        });

        return view('admin.reports.popular', ['foods' => $popularFoods]);
    }

    public function surveys()
    {
        $surveys = Storage::exists($this->surveyPath)
            ? (json_decode(Storage::get($this->surveyPath), true) ?: [])
            : [];

        $foods   = Storage::exists($this->menuPath)
            ? (json_decode(Storage::get($this->menuPath), true) ?: [])
            : [];

        $foodsById = collect($foods)->keyBy('id');

        foreach ($surveys as &$survey) {
            $food = $foodsById->get($survey['food_id'] ?? null, []);
            $survey['food_name'] = $food['name'] ?? '---';
            $survey['created_at'] = $survey['created_at'] ?? ($survey['date'] ?? null);
        }
        unset($survey);

        return view('admin.reports.surveys', compact('surveys'));
    }

    public function comments()
    {
        $comments = [];
        if (Storage::exists('data/comments.json')) {
            $comments = json_decode(Storage::get('data/comments.json'), true) ?? [];
        }

        $foods = [];
        if (Storage::exists($this->menuPath)) {
            $foods = json_decode(Storage::get($this->menuPath), true) ?? [];
        }
        $foodsById = collect($foods)->keyBy('id');

        foreach ($comments as &$c) {
            $food = $foodsById->get($c['food_id'] ?? null, []);
            $c['food_name'] = $food['name'] ?? '---';
        }
        unset($c);

        return view('admin.reports.comments', compact('comments'));
    }

    public function users()
    {
        $users = Storage::exists($this->userPath)
            ? (json_decode(Storage::get($this->userPath), true) ?: [])
            : [];

        return view('admin.reports.users', compact('users'));
    }
}
