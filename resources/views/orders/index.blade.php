@extends('layouts.store')

@section('title', 'Мої замовлення')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Мої замовлення</h1>

    @if ($orders->isEmpty())
        <div class="alert alert-info">
            Ви ще не здійснювали замовлень.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Номер замовлення</th>
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
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ number_format($order->total_price, 2) }} ₴</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-sm">Переглянути</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
