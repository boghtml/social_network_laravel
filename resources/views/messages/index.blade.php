@extends('layouts.main_withput_slider')

@section('content')
<div class="container">
    <div class="row">
        <!-- Сайдбар з відстежуваними користувачами -->
        <div class="col-md-4">
            <h4>Ваші чати</h4>
            <ul class="list-group">
                @foreach($following as $followedUser)
                    <li class="list-group-item">
                        <a href="{{ route('messages.show', $followedUser->username) }}" class="d-flex align-items-center text-decoration-none">
                            <img src="{{ $followedUser->profile_picture ?: asset('path/to/default-avatar.png') }}" 
                                 alt="{{ $followedUser->username }}" 
                                 class="rounded-circle me-2" 
                                 width="56" 
                                 height="56">
                            <span>{{ $followedUser->username }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Порожній простір для вибору чату -->
        <div class="col-md-8">
            <h4>Оберіть користувача для початку чату</h4>
        </div>
    </div>
</div>
@endsection