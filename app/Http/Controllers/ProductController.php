<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $category = $request->input('category');
        $sortOrder = $request->input('sortOrder');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $searchTerm = $request->input('searchTerm');

        $products = Product::with('category', 'images');

        if ($category) {
            $products = $products->whereHas('category', function($query) use ($category) {
                $query->where('name', $category);
            });
        }

        if ($minPrice) {
            $products = $products->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $products = $products->where('price', '<=', $maxPrice);
        }

        if ($searchTerm) {
            $products = $products->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        switch ($sortOrder) {
            case 'price_asc':
                $products = $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products = $products->orderBy('price', 'desc');
                break;
            case 'popularity':
                $products = $products->orderBy('popularity', 'desc');
                break;
            default:
                $products = $products->orderBy('name', 'asc');
                break;
        }

        $products = $products->paginate(12);

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load('category', 'images');

        return view('products.show', compact('product'));
    }
}
