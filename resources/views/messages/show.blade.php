@extends('layouts.main_withput_slider')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h4>Ваші чати</h4>
            <ul class="list-group">
                @foreach($following as $followedUser)
                    <li class="list-group-item {{ $followedUser->id == $chatUser->id ? 'active' : '' }}">
                        <a href="{{ route('messages.show', $followedUser->username) }}" class="d-flex align-items-center text-decoration-none">
                            <img src="{{ $followedUser->profile_picture ?: asset('path/to/default-avatar.png') }}" 
                                 alt="{{ $followedUser->username }}" 
                                 class="rounded-circle me-2" 
                                 width="40" 
                                 height="40">
                            <span>{{ $followedUser->username }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-8">
            <h4>Чат з {{ $chatUser->username }}</h4>
            <div class="chat-box" style="height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">
                @foreach($messages as $message)
                    @if($message->sender_id == Auth::id())
                        <div class="text-end mb-2">
                            <div class="d-inline-block bg-primary text-white p-2 rounded">
                                {{ $message->content }}
                            </div>
                            <small class="text-muted d-block">{{ $message->created_at }}</small>
                        </div>
                    @else
                    
                        <div class="mb-2">
                            <div class="d-inline-block bg-light p-2 rounded">
                                {{ $message->content }}
                            </div>
                            <small class="text-muted d-block">{{ $message->created_at }}</small>
                        </div>
                    @endif
                @endforeach
            </div>
            
            <form action="{{ route('messages.store', $chatUser->username) }}" method="POST" class="mt-3">
                @csrf
                <div class="input-group">
                    <input type="text" name="content" class="form-control" placeholder="Введіть повідомлення..." required>
                    <button type="submit" class="btn btn-primary">Відправити</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection