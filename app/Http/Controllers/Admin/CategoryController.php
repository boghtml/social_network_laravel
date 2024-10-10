<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Показати список категорій
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::query();

        if ($search) {
            $categories = $categories->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        $categories = $categories->orderBy('name')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    // Показати форму створення категорії
    public function create()
    {
        return view('admin.categories.create');
    }

    // Зберегти нову категорію
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->only('name', 'description'));

        return redirect()->route('admin.categories.index')->with('success', 'Категорію створено.');
    }

    // Показати форму редагування категорії
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Оновити категорію
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->only('name', 'description'));

        return redirect()->route('admin.categories.index')->with('success', 'Категорію оновлено.');
    }

    // Видалити категорію
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Перевірити, чи є у категорії товари
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Неможливо видалити категорію, яка містить товари.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Категорію видалено.');
    }
}
