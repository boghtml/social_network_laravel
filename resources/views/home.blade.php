@extends('layouts.app') <!-- типу app.blade.php --> 

@section('title', 'Головна сторінка')

@section('content')
    <div class="stories-container mb-4">
        <h6 class="mb-3">Історії</h6>
        <div class="d-flex overflow-auto">
            @for ($i = 0; $i < 10; $i++)
                <div class="story-item">
                    <img src="https://via.placeholder.com/56" class="rounded-circle" alt="User Story">
                    <small>user{{ $i }}</small>
                </div>
            @endfor
        </div>
    </div>

    <div class="posts-container">
        @foreach($posts as $post)
            @include('partials.post', ['post' => $post])
        @endforeach
    </div>
@endsection
