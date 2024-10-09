<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Відображення корзини
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Додавання товару до корзини
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, (int)$request->input('quantity', 1));
        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        // Якщо товар вже є в корзині, оновлюємо кількість
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Додаємо товар до корзини
            $cart[$productId] = [
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'image_url' => $product->images->first()->image_url ?? asset('images/no-image.png'),
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        // Повертаємо відповідь для AJAX-запиту
        if ($request->ajax()) {
            $cartItemCount = count($cart);
            return response()->json(['cartItemCount' => $cartItemCount]);
        }

        return redirect()->back()->with('success', 'Товар додано до корзини!');
    }

    // Оновлення кількості товару в корзині
    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, (int)$request->input('quantity', 1));

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Кількість товару оновлено!');
        }

        return redirect()->back()->with('error', 'Товар не знайдено в корзині!');
    }

    // Видалення товару з корзини
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Товар видалено з корзини!');
        }

        return redirect()->back()->with('error', 'Товар не знайдено в корзині!');
    }
}
