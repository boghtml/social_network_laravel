@extends('layouts.store')

@section('title', 'Оформлення замовлення')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Оформлення замовлення</h1>

    @if (!$cart || count($cart) == 0)
        <div class="alert alert-info">
            <h4 class="alert-heading"><i class="fas fa-shopping-cart"></i> Ваша корзина порожня</h4>
            <p>Додайте товари до корзини перед оформленням замовлення.</p>
            <hr>
            <p class="mb-0">
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    Продовжити покупки
                </a>
            </p>
        </div>
    @else
        <div class="row">
            
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Підсумок замовлення</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Товар</th>
                                    <th>Ціна</th>
                                    <th>Кількість</th>
                                    <th>Сума</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($cart as $item)
                                    @php
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{ route('products.show', $item['product_id']) }}" class="text-decoration-none">
                                                {{ $item['name'] }}
                                            </a>
                                        </td>
                                        <td>{{ number_format($item['price'], 2) }} ₴</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>{{ number_format($subtotal, 2) }} ₴</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Загальна сума</h5>
                    </div>
                    <div class="card-body">
                        <h3 class="text-end mb-4">{{ number_format($total, 2) }} ₴</h3>
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-lock"></i> Підтвердити замовлення
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-block">
                        <i class="fas fa-edit"></i> Редагувати корзину
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
