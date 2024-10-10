@extends('layouts.admin')

@section('title', 'Створення категорії')

@section('content')
<div class="container mt-4">
    <h1>Створення категорії</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Назва</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="description">Опис</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Створити</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mt-2">Назад до списку</a>
    </form>
</div>
@endsection
