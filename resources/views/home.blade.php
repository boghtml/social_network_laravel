<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InstaClone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Включення лівої навігації -->
            @include('partials.sidebar')

            <!-- Центральна частина з постами -->
            <main class="col-md-6 ms-sm-auto col-lg-7 px-md-4">
                <div class="stories-container my-4">
                    <h5 class="mb-3">Історії</h5>
                    <div class="stories d-flex overflow-auto">
                        <!-- Тут будуть історії користувачів -->
                    </div>
                </div>
                
                <div class="posts-container">
                    @foreach($posts as $post)
                        <div class="post-card mb-4">
                            <div class="post-header d-flex align-items-center p-3">
                                <img src="{{ $post->user->profile_picture }}" alt="{{ $post->user->username }}" class="rounded-circle me-2">
                                <a href="{{ route('profile.show', $post->user->username) }}">
                                    <span class="username fw-bold">{{ $post->user->username }}</span>
                                </a>

                                <button class="btn btn-link ms-auto">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                            @if($post->image_url)
                                <img src="{{ $post->image_url }}" class="post-image img-fluid" alt="Post Image">
                            @endif
                            <div class="post-actions p-3">
                                <!-- Кнопка "Вподобати" -->
                                <form method="POST" action="{{ route('like.toggle', $post->id) }}">
                                    @csrf
                                    <button class="btn btn-link">
                                        <i class="{{ $post->likes->where('user_id', Auth::id())->count() ? 'fas' : 'far' }} fa-heart"></i>
                                        {{ $post->likes->count() }}
                                    </button>
                                </form>

                                <button class="btn btn-link">
                                    <i class="far fa-comment"></i>
                                </button>

                                <!-- Кнопка "Зберегти" -->
                                <form method="POST" action="{{ route('save.toggle', $post->id) }}">
                                    @csrf
                                    <button class="btn btn-link float-end">
                                        <i class="{{ $post->savedPosts->where('user_id', Auth::id())->count() ? 'fas' : 'far' }} fa-bookmark"></i>
                                        {{ $post->savedPosts->count() }}
                                    </button>
                                </form>
                            </div>
                            <div class="post-footer p-3">
                                <p class="likes mb-2">{{ $post->likes->count() }} вподобань</p>
                                <p class="caption"><strong>{{ $post->user->username }}</strong> {{ $post->caption }}</p>
                                <p class="text-muted small">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="post-comments p-3 border-top">
                                <input type="text" class="form-control" placeholder="Додати коментар...">
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    @endforeach
                </div>
            </main>

            <!-- Права частина з рекомендаціями -->
            <aside class="col-md-3 d-none d-lg-block">
                <div class="position-sticky pt-3">
                    <div class="user-profile d-flex align-items-center mb-4">
                    <img src="{{ Auth::user()->profile_picture }}" alt="{{ Auth::user()->username }}" class="rounded-circle me-2" width="56" height="56">
                    <div>
                            <p class="mb-0 fw-bold">{{ Auth::user()->username }}</p>
                            <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="suggestions">
                        <h6 class="text-muted mb-3">Рекомендації для вас</h6>
                        <!-- Тут будуть рекомендовані профілі -->
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
