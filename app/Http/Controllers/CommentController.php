<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    private $commentPath = 'data/comments.json';
    private $menuPath    = 'data/menu.json';

    public function create($food_id)
    {
        if (!session()->has('user')) {
            return redirect()->route('login.form')->with('error', 'برای ثبت دیدگاه باید وارد شوید.');
        }

        $foods = Storage::exists($this->menuPath) ? json_decode(Storage::get($this->menuPath), true) : [];
        $food = collect($foods)->firstWhere('id', (int)$food_id);

        if (!$food) {
            abort(404, 'غذا یافت نشد.');
        }

        $comments = Storage::exists($this->commentPath) ? json_decode(Storage::get($this->commentPath), true) : [];
        $foodComments = array_filter($comments, fn($c) => $c['food_id'] == $food_id);

        return view('comments.create', [
            'food_id'  => $food_id,
            'food'     => $food,
            'comments' => $foodComments
        ]);
    }

    public function store(Request $request, $food_id)
    {
        if (!session()->has('user')) {
            return redirect()->route('login.form')->with('error', 'برای ثبت دیدگاه باید وارد شوید.');
        }

        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $comments = Storage::exists($this->commentPath) ? json_decode(Storage::get($this->commentPath), true) : [];

        $comments[] = [
            'food_id'  => (int)$food_id,
            'user_id'  => session('user.id'),
            'comment'  => $request->comment,
            'date'     => now()->toDateTimeString()
        ];

        Storage::put($this->commentPath, json_encode($comments, JSON_PRETTY_PRINT));

        return redirect()->route('menu.index', $food_id)->with('success', 'دیدگاه شما با موفقیت ثبت شد.');
    }


}
