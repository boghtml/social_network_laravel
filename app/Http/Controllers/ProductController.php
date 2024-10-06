<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Метод для відображення каталогу товарів
    public function index(Request $request)
    {
        // Отримуємо всі категорії для фільтрації
        $categories = Category::all();

        // Отримуємо параметри фільтрації з запиту
        $category = $request->input('category');
        $sortOrder = $request->input('sortOrder');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $searchTerm = $request->input('searchTerm');

        // Базовий запит
        $products = Product::with('category', 'images');

        // Фільтрація за категорією
        if ($category) {
            $products = $products->whereHas('category', function($query) use ($category) {
                $query->where('name', $category);
            });
        }

        // Фільтрація за ціною
        if ($minPrice) {
            $products = $products->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $products = $products->where('price', '<=', $maxPrice);
        }

        // Пошук
        if ($searchTerm) {
            $products = $products->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        // Сортування
        switch ($sortOrder) {
            case 'price_asc':
                $products = $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products = $products->orderBy('price', 'desc');
                break;
            case 'popularity':
                // Припустимо, що є поле 'popularity' в таблиці продуктів
                $products = $products->orderBy('popularity', 'desc');
                break;
            default:
                // За замовчуванням сортуємо за ім'ям
                $products = $products->orderBy('name', 'asc');
                break;
        }

        // Отримуємо результати
        $products = $products->paginate(12); // Розбиваємо на сторінки по 12 товарів

        return view('products.index', compact('products', 'categories'));
    }

    // Метод для відображення детальної інформації про товар
    public function show(Product $product)
    {
        // Завантажуємо відношення
        $product->load('category', 'images');

        return view('products.show', compact('product'));
    }
}
