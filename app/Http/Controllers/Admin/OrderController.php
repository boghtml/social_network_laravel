<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Показати список замовлень
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $orders = Order::query();

        if ($search) {
            $orders = $orders->whereHas('user', function ($query) use ($search) {
                $query->where('email', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $orders = $orders->where('status', $status);
        }

        $orders = $orders->with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    // Показати форму редагування замовлення
    public function edit($id)
    {
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    // Оновити замовлення
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Статус замовлення оновлено.');
    }

    // Інші методи (create, store, show, destroy) можна залишити порожніми або видалити, якщо не використовуються.
}
