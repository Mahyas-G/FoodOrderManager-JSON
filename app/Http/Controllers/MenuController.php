<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private string $menuPath = 'data/menu.json';
    private string $surveyPath = 'data/surveys.json';

    public function index()
    {
        $foods = Storage::exists($this->menuPath)
            ? json_decode(Storage::get($this->menuPath), true) ?? []
            : [];

        $surveys = Storage::exists($this->surveyPath)
            ? json_decode(Storage::get($this->surveyPath), true)
            : [];

        foreach ($foods as &$food) {
            $ratings = collect($surveys)->where('food_id', $food['id'])->pluck('rating');
            $food['average_rating'] = $ratings->count() > 0
                ? round($ratings->avg(), 1)
                : null;

            if (!empty($food['image'])) {
                $food['image_url'] = Storage::url("images/{$food['image']}");
            } else {
                $food['image_url'] = null;
            }
        }
        unset($food);

        return view('menu.index', ['foods' => $foods]);
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foods = Storage::exists($this->menuPath)
            ? json_decode(Storage::get($this->menuPath), true)
            : [];

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'food_' . time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
        }

        $foods[] = [
            'id'          => count($foods) + 1,
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imageName
        ];

        Storage::put($this->menuPath, json_encode($foods, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('menu.index')->with('success', 'غذا با موفقیت افزوده شد.');
    }

    public function edit($id)
    {
        $foods = json_decode(Storage::get($this->menuPath), true);
        $food = collect($foods)->firstWhere('id', (int)$id);

        if (!$food) {
            abort(404, 'غذا یافت نشد.');
        }

        return view('menu.edit', ['food' => $food]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foods = json_decode(Storage::get($this->menuPath), true);
        $index = array_search((int)$id, array_column($foods, 'id'));

        if ($index === false) {
            abort(404, 'غذا یافت نشد.');
        }

        $imageName = $foods[$index]['image'] ?? null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'food_' . time() . '_' . Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
        }

        $foods[$index] = [
            'id'          => (int)$id,
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imageName,
        ];

        Storage::put($this->menuPath, json_encode($foods, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('menu.index')->with('success', 'غذا با موفقیت ویرایش شد.');
    }

    public function delete($id)
    {
        $foods = json_decode(Storage::get($this->menuPath), true);
        $foods = array_filter($foods, fn($food) => $food['id'] != $id);

        Storage::put($this->menuPath, json_encode(array_values($foods), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->route('menu.index')->with('success', 'غذا با موفقیت حذف شد.');
    }
}
