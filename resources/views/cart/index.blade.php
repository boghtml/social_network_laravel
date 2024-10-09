@extends('layouts.store')

@section('title', 'Ваша корзина')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Ваша корзина</h1>

    @if (!$cart || count($cart) == 0)
        <div class="alert alert-info">
            Ваша корзина порожня.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Ціна</th>
                    <th>Кількість</th>
                    <th>Сума</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($cart as $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" style="height: 50px; width: 50px; object-fit: cover;">
                            {{ $item['name'] }}
                        </td>
                        <td>{{ number_format($item['price'], 2) }} ₴</td>
                        <td>
                            <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control d-inline-block" style="width: 80px;">
                                <button type="submit" class="btn btn-primary btn-sm">Оновити</button>
                            </form>
                        </td>
                        <td>{{ number_format($subtotal, 2) }} ₴</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end"><strong>Загальна сума:</strong></td>
                    <td colspan="2"><strong>{{ number_format($total, 2) }} ₴</strong></td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('orders.create') }}" class="btn btn-success">Перейти до оформлення замовлення</a>
    @endif
</div>
@endsection
