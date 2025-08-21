<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SurveyController extends Controller
{
    private $surveyPath = 'data/surveys.json';
    private $menuPath   = 'data/menu.json';

    public function create($food_id)
    {
        if (!session()->has('user')) {
            return redirect()->route('login.form')->with('error', 'برای ثبت امتیاز باید وارد شوید.');
        }

        $foods = Storage::exists($this->menuPath)
            ? json_decode(Storage::get($this->menuPath), true)
            : [];

        $food = collect($foods)->firstWhere('id', (int)$food_id);
        if (!$food) {
            abort(404, 'غذا یافت نشد.');
        }

        $userId = session('user.id');
        $surveys = Storage::exists($this->surveyPath)
            ? json_decode(Storage::get($this->surveyPath), true)
            : [];

        $alreadyRated = collect($surveys)->first(fn($s) =>
            ($s['food_id'] ?? null) == (int)$food_id && ($s['user_id'] ?? null) == $userId
        );

        if ($alreadyRated) {
            return redirect()->route('menu.index')->with('error', 'شما قبلاً برای این غذا امتیاز داده‌اید.');
        }

        return view('survey.create', [
            'food'     => $food,
            'food_id'  => $food_id
        ]);
    }

    public function store(Request $request, $food_id)
    {
        if (!session()->has('user')) {
            return redirect()->route('login.form')->with('error', 'برای ثبت امتیاز باید وارد شوید.');
        }

        $request->validate([
            'rating'  => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255'
        ]);

        $surveys = Storage::exists($this->surveyPath)
            ? json_decode(Storage::get($this->surveyPath), true)
            : [];

        $userId = session('user.id');
        $alreadyRated = collect($surveys)->first(fn($s) =>
            ($s['food_id'] ?? null) == (int)$food_id && ($s['user_id'] ?? null) == $userId
        );
        if ($alreadyRated) {
            return redirect()->route('menu.index')->with('error', 'شما قبلاً برای این غذا امتیاز داده‌اید.');
        }

        $surveys[] = [
            'food_id'  => (int)$food_id,
            'user_id'  => $userId,
            'rating'   => (int)$request->rating,
            'date'     => now()->toDateTimeString()
        ];

        Storage::put($this->surveyPath, json_encode($surveys, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('menu.index')->with('success', 'امتیاز شما با موفقیت ثبت شد.');
    }
}
