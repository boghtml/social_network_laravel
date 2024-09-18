<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->username }}'s Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
        <!-- Включення лівої навігації -->
        @include('partials.sidebar')
        <!-- Центральна частина профілю -->
            <main class="col-md-8 ms-sm-auto col-lg-9 px-md-4">
                <div class="profile-header my-4">
                    <div class="d-flex align-items-center">
                        <img src="{{ $user->profile_picture }}" alt="{{ $user->username }}" class="rounded-circle me-3" width="100" height="100">
                        <div>
                            <h2 class="mb-0">{{ $user->username }}</h2>
                            <p class="text-muted mb-0">{{ $user->bio }}</p>
                        </div>
                        @if ($isOwner)
                            <a href="{{ route('profile.edit', ['username' => $user->username]) }}" class="btn btn-outline-primary ms-auto">Редагувати профіль</a>
                        @else
                            <form method="POST" action="{{ route('follow.toggle', ['username' => $user->username]) }}">
                                @csrf
                                @if ($isFollowing)
                                    <button type="submit" class="btn btn-secondary ms-auto">Відстежується</button>
                                @else
                                    <button type="submit" class="btn btn-primary ms-auto">Стежити</button>
                                @endif
                            </form>
                        @endif
                    </div>
                </div>

                <div class="profile-info my-4">
                    <div class="d-flex">
                        <div class="me-4"><strong>{{ $user->posts->count() }}</strong> дописів</div>
                        <div class="me-4"><strong>{{ $followersCount }}</strong> читачів</div>
                        <div><strong>{{ $followingCount }}</strong> стежить</div>
                    </div>
                </div>

                <!-- Навігаційні вкладки -->
                <ul class="nav nav-tabs my-4" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab" aria-controls="posts" aria-selected="true">Допис</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="saved-tab" data-bs-toggle="tab" data-bs-target="#saved" type="button" role="tab" aria-controls="saved" aria-selected="false">Збережено</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="liked-tab" data-bs-toggle="tab" data-bs-target="#liked" type="button" role="tab" aria-controls="liked" aria-selected="false">Вподобано</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <!-- Вкладка "Допис" -->
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                        <div class="gallery row">
                            @foreach($user->posts as $post)
                                <div class="col-md-4 mb-4">
                                    <img src="{{ $post->image_url }}" class="img-fluid" alt="{{ $post->caption }}">
                                    <div class="post-caption">{{ $post->caption }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Вкладка "Збережено" -->
                    <div class="tab-pane fade" id="saved" role="tabpanel" aria-labelledby="saved-tab">
                        <h3>Збережені Пости</h3>
                        <div class="gallery row">
                            @foreach($savedPosts as $savedPost)
                                <div class="col-md-4 mb-4">
                                    <img src="{{ $savedPost->post->image_url }}" class="img-fluid" alt="Post Image">
                                    <p>{{ $savedPost->post->caption }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane fade" id="liked" role="tabpanel" aria-labelledby="liked-tab">
                        <h3>Вподобані Пости</h3>
                        <div class="gallery row">
                            @foreach($likedPosts as $likedPost)
                                <div class="col-md-4 mb-4">
                                    <img src="{{ $likedPost->image_url }}" class="img-fluid" alt="Post Image">
                                    <p>{{ $likedPost->caption }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
