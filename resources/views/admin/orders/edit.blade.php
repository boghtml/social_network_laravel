@extends('layouts.admin')

@section('title', 'Редагування замовлення #' . $order->id)

@section('content')
<div class="container mt-4">
    <h1>Редагування замовлення #{{ $order->id }}</h1>
    
    <div>
        <h4>Деталі замовлення</h4>
        <p><strong>Користувач:</strong> {{ $order->user->email }}</p>
        <p><strong>Дата:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
        <p><strong>Загальна сума:</strong> {{ number_format($order->total_price, 2) }} ₴</p>

        <h4>Товари</h4>
        <table class="table">
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
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }} ₴</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }} ₴</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status">Статус замовлення</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Очікується</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>В обробці</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Завершено</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Скасовано</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-2">Зберегти зміни</button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary mt-2">Назад до списку</a>
        </form>
    </div>
</div>
@endsection
