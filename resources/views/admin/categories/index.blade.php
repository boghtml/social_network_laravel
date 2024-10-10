@extends('layouts.admin')

@section('title', 'Керування категоріями')

@section('content')
<div class="container mt-4">
    <h1>Керування категоріями</h1>

    <form method="get" class="form-inline mb-3">
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Пошук за назвою або описом">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Пошук</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Скинути</a>
            </div>
        </div>
    </form>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">Створити нову категорію</a>

    @if ($categories->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Назва</th>
                    <th>Опис</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">Редагувати</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цю категорію?')">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->withQueryString()->links() }}
    @else
        <p>Категорій не знайдено.</p>
    @endif
</div>
@endsection
