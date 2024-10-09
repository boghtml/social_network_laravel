@extends('layouts.store')

@section('title', 'Підтвердження замовлення')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle text-success fa-5x mb-3"></i>
                    <h1 class="card-title">Дякуємо за ваше замовлення!</h1>
                    <p class="card-text lead">Ваше замовлення №{{ $order->id }} успішно оформлено.</p>
                    <p class="card-text">Ми надішлемо вам підтвердження електронною поштою з деталями замовлення та інформацією про доставку.</p>
                    <hr>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-list-ul"></i> Переглянути моє замовлення
                        </a>
                        <a href="{{ route('store.home') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-home"></i> Продовжити покупки
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

@endsection
