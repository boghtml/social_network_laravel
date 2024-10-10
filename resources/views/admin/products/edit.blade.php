@extends('layouts.admin')

@section('title', 'Редагування товару')

@section('content')
<div class="container mt-4">
    <h1>Редагування товару</h1>

    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Назва</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $product->name) }}">
        </div>
        <div class="form-group">
            <label for="description">Опис</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Ціна</label>
            <input type="number" name="price" id="price" class="form-control" required step="0.01" value="{{ old('price', $product->price) }}">
        </div>
        <div class="form-group">
            <label for="stock_quantity">Кількість на складі</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" required value="{{ old('stock_quantity', $product->stock_quantity) }}">
        </div>
        <div class="form-group">
            <label for="category_id">Категорія</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Оберіть категорію</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image_url">URL зображення</label>
            <input type="url" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $product->image_url) }}">
        </div>
        <button type="submit" class="btn btn-success mt-2">Зберегти зміни</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-2">Назад до списку</a>
    </form>
</div>
@endsection
