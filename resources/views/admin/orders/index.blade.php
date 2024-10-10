@extends('layouts.admin')

@section('title', 'Керування замовленнями')

@section('content')
<div class="container mt-4">
    <h1>Керування замовленнями</h1>

    <form method="get" class="form-inline mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Пошук за email">
            </div>
            <div class="col-md-4">
                <select name="status" class="form-control">
                    <option value="">Всі статуси</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Очікується</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>В обробці</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Завершено</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Скасовано</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Фільтрувати</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Скинути</a>
            </div>
        </div>
    </form>

    @if ($orders->count())
        <table class="table">
            <thead>
                <tr>
                    <th>ID замовлення</th>
                    <th>Email користувача</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Загальна сума</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->email }}</td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ number_format($order->total_price, 2) }} ₴</td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-primary btn-sm">Редагувати</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->withQueryString()->links() }}
    @else
        <p>Замовлень не знайдено.</p>
    @endif
</div>
@endsection
