@extends('layouts.store')

@section('title', 'Замовлення #' . $order->id)

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Деталі замовлення</h1>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Замовлення #{{ $order->id }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Дата:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                    <p>
                        <strong>Статус:</strong>
                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'secondary') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p><strong>Загальна сума:</strong> <span class="h4 text-primary">{{ number_format($order->total_price, 2) }} ₴</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">Товари в замовленні</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Кількість</th>
                        <th>Ціна</th>
                        <th>Сума</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>
                                <a href="{{ route('products.show', $item->product_id) }}" class="text-decoration-none">
                                    {{ $item->product->name }}
                                </a>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price, 2) }} ₴</td>
                            <td>{{ number_format($item->price * $item->quantity, 2) }} ₴</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-active">
                        <td colspan="3" class="text-end"><strong>Загальна сума:</strong></td>
                        <td><strong>{{ number_format($order->total_price, 2) }} ₴</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Кнопка повернення до списку замовлень -->
    <div class="mt-4">
        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Повернутися до замовлень
        </a>
    </div>
    <br>
</div>

@endsection
