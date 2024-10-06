<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $user = Auth::user();

        // Знайти або створити корзину для користувача
        $cart = ShoppingCart::firstOrCreate([
            'user_id' => $user->id,
        ]);

        // Додати товар до корзини
        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity', 1),
        ]);

        // Перенаправити назад з повідомленням
        return redirect()->back()->with('success', 'Товар додано до корзини');
    }
}
