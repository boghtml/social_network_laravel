@extends('layouts.admin')

@section('title', 'Редагування категорії')

@section('content')
<div class="container mt-4">
    <h1>Редагування категорії</h1>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Назва</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $category->name) }}">
        </div>
        <div class="form-group">
            <label for="description">Опис</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $category->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Зберегти зміни</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-2">Назад до списку</a>
    </form>
</div>
@endsection
