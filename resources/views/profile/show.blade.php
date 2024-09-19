<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->username }} | InstaClone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/detailedView.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Включення лівої навігації -->
            @include('partials.sidebar')
            
            <!-- Центральна частина профілю -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="profile-header">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <img src="{{ $user->profile_picture }}" alt="{{ $user->username }}" class="rounded-circle profile-picture">
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center mb-3">
                                    <h1 class="profile-username me-4">{{ $user->username }}</h1>
                                    @if ($isOwner)
                                        <a href="{{ route('profile.edit', ['username' => $user->username]) }}" class="btn btn-outline-secondary">Редагувати профіль</a>
                                    @else
                                        <form method="POST" action="{{ route('follow.toggle', ['username' => $user->username]) }}">
                                            @csrf
                                            <button type="submit" class="btn {{ $isFollowing ? 'btn-secondary' : 'btn-primary' }}">
                                                {{ $isFollowing ? 'Відстежується' : 'Стежити' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <div class="profile-stats d-flex mb-3">
                                    <div class="me-4"><strong>{{ $user->posts->count() }}</strong> дописів</div>
                                    <div class="me-4"><strong>{{ $followersCount }}</strong> читачів</div>
                                    <div><strong>{{ $followingCount }}</strong> стежить</div>
                                </div>
                                <div class="profile-bio">
                                    <p>{{ $user->bio }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               <!-- Навігаційні вкладки -->
               <ul class="nav nav-tabs justify-content-center my-4" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button" role="tab" aria-controls="posts" aria-selected="true">
                            <i class="fas fa-th-large"></i> Допис
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="saved-tab" data-bs-toggle="tab" data-bs-target="#saved" type="button" role="tab" aria-controls="saved" aria-selected="false">
                            <i class="fas fa-bookmark"></i> Збережено
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="liked-tab" data-bs-toggle="tab" data-bs-target="#liked" type="button" role="tab" aria-controls="liked" aria-selected="false">
                            <i class="fas fa-heart"></i> Вподобано
                        </button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Анімація при наведенні на кнопку "Стежити"
            $('button.btn-primary').hover(
                function() {
                    $(this).removeClass('btn-primary').addClass('btn-danger').text('Відстежити');
                },
                function() {
                    $(this).removeClass('btn-danger').addClass('btn-primary').text('Стежити');
                }
            );

            // Анімація при наведенні на кнопку "Відстежується"
            $('button.btn-secondary').hover(
                function() {
                    $(this).text('Відстежити');
                },
                function() {
                    $(this).text('Відстежується');
                }
            );
        });
    </script>
</body>
</html>
