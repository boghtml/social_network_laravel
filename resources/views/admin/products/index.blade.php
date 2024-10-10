@extends('layouts.admin')

@section('title', 'Керування товарами')

@section('content')
<div class="container mt-4">
    <h1>Керування товарами</h1>

    <form method="get" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="searchTerm" value="{{ request('searchTerm') }}" class="form-control" placeholder="Пошук за назвою або описом">
            </div>
            <div class="col-md-3">
                <select name="categoryId" class="form-control">
                    <option value="">Всі категорії</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('categoryId') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Додайте інші поля фільтрації, якщо потрібно -->
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Фільтрувати</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Скинути</a>
            </div>
        </div>
    </form>

    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">Створити новий товар</a>

    @if ($products->count())
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>
                        <a href="{{ route('admin.products.index', ['sortOrder' => request('sortOrder') == 'name_asc' ? 'name_desc' : 'name_asc'] + request()->except('sortOrder')) }}">
                            Назва
                        </a>
                    </th>
                    <th>Категорія</th>
                    <th>
                        <a href="{{ route('admin.products.index', ['sortOrder' => request('sortOrder') == 'price_asc' ? 'price_desc' : 'price_asc'] + request()->except('sortOrder')) }}">
                            Ціна
                        </a>
                    </th>
                    <th>Кількість на складі</th>
                    <th>Зображення</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category ? $product->category->name : 'Без категорії' }}</td>
                        <td>{{ number_format($product->price, 2) }} ₴</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>
                            @if ($product->image_url)
                                <img src="{{ $product->image_url }}" width="50" height="50" alt="Зображення товару">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-sm">Редагувати</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цей товар?')">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->withQueryString()->links() }}
    @else
        <p>Товарів не знайдено.</p>
    @endif
</div>
@endsection
