<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $orders = $user->orders()->with('orderItems.product')->orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $cart = session()->get('cart', []);
        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина порожня.');
        }

        return view('orders.create', compact('cart'));
    }

    public function confirmation(Request $request)
    {
        $orderId = $request->session()->get('order_id');
        if (!$orderId) {
            return redirect()->route('store.home')->with('error', 'Немає інформації про замовлення.');
        }

        $order = Order::find($orderId);

        return view('orders.confirmation', compact('order'));
    }

    
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Ваша корзина порожня.');
        }

        DB::beginTransaction();

        try {
            $total = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_price' => $total,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                
                $product = Product::find($item['product_id']);
                $product->stock_quantity -= $item['quantity'];
                $product->save();
            }

            DB::commit();

            
            session()->forget('cart');

            return redirect()->route('orders.confirmation')->with('order_id', $order->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cart.index')->with('error', 'Сталася помилка при оформленні замовлення.');
        }
    }

    
    public function show(Order $order)
    {
        
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('orders.show', compact('order'));
    }
}
