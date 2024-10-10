<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductControllerAdmin extends Controller
{
    
     public function index(Request $request)
     {
         $searchTerm = $request->input('searchTerm');
         $categoryId = $request->input('categoryId');
         $minPrice = $request->input('minPrice');
         $maxPrice = $request->input('maxPrice');
         $sortOrder = $request->input('sortOrder', 'name_asc');
 
         $products = Product::with('category');
 
         if ($searchTerm) {
             $products = $products->where('name', 'like', "%{$searchTerm}%")
                 ->orWhere('description', 'like', "%{$searchTerm}%");
         }
 
         if ($categoryId) {
             $products = $products->where('category_id', $categoryId);
         }
 
         if ($minPrice) {
             $products = $products->where('price', '>=', $minPrice);
         }
 
         if ($maxPrice) {
             $products = $products->where('price', '<=', $maxPrice);
         }
 
         switch ($sortOrder) {
             case 'name_desc':
                 $products = $products->orderBy('name', 'desc');
                 break;
             case 'price_asc':
                 $products = $products->orderBy('price', 'asc');
                 break;
             case 'price_desc':
                 $products = $products->orderBy('price', 'desc');
                 break;
             default:
                 $products = $products->orderBy('name', 'asc');
                 break;
         }
 
         $products = $products->paginate(10);
 
         $categories = Category::all();
 
         return view('admin.products.index', compact('products', 'categories'));
     }
 
     
     public function create()
     {
         $categories = Category::all();
         return view('admin.products.create', compact('categories'));
     }
 
     
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'price' => 'required|numeric',
             'stock_quantity' => 'required|integer',
             'category_id' => 'required|exists:categories,id',
             'image_url' => 'nullable|url',
         ]);
 
         Product::create([
             'name' => $request->input('name'),
             'description' => $request->input('description'),
             'price' => $request->input('price'),
             'stock_quantity' => $request->input('stock_quantity'),
             'category_id' => $request->input('category_id'),
             'image_url' => $request->input('image_url'),
         ]);
 
         return redirect()->route('admin.products.index')->with('success', 'Товар створено.');
     }
 
     
     public function edit($id)
     {
         $product = Product::findOrFail($id);
         $categories = Category::all();
         return view('admin.products.edit', compact('product', 'categories'));
     }
 
     public function update(Request $request, $id)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'price' => 'required|numeric',
             'stock_quantity' => 'required|integer',
             'category_id' => 'required|exists:categories,id',
             'image_url' => 'nullable|url',
         ]);
 
         $product = Product::findOrFail($id);
 
         $product->update([
             'name' => $request->input('name'),
             'description' => $request->input('description'),
             'price' => $request->input('price'),
             'stock_quantity' => $request->input('stock_quantity'),
             'category_id' => $request->input('category_id'),
             'image_url' => $request->input('image_url'),
         ]);
 
         return redirect()->route('admin.products.index')->with('success', 'Товар оновлено.');
     }
 
     public function destroy($id)
     {
         $product = Product::findOrFail($id);
         $product->delete();
 
         return redirect()->route('admin.products.index')->with('success', 'Товар видалено.');
     }
}
