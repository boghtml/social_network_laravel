<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Workout Shop')</title>
    <!-- Підключення стилів -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css">
  
    <!-- Ваші додаткові стилі -->
    <style>
        .footer .custom-list a {
            color: white;
            text-decoration: none;
        }
        .footer .custom-list a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <!-- Навігаційна панель -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('store.home') }}">
                    <img src="{{ asset('images/logo.jfif') }}" alt="WorkoutShop Logo" class="d-inline-block align-top" style="height: 40px; margin-right: 10px;">
                    WorkoutShop
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Ліва частина меню -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('store.home') }}">Головна</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('store.about') }}">Про нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('store.contact') }}">Контакти</a>
                        </li>
                    </ul>
                    <!-- Пошук -->
                    <form class="d-flex me-2" action="{{ route('products.index') }}" method="GET">
                        <input class="form-control me-2" type="search" name="searchTerm" placeholder="Пошук" aria-label="Пошук" value="{{ request('searchTerm') }}">
                        <button class="btn btn-outline-primary" type="submit">Пошук</button>
                    </form>
                    <!-- Права частина меню -->
                    <ul class="navbar-nav">
                        @guest
                            <!-- Гість -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Увійти</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Реєстрація</a>
                            </li>
                        @else
                            <!-- Авторизований користувач -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle"></i>
                                    {{ Auth::user()->name ?? Auth::user()->email }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.show', ['username' => Auth::user()->username]) }}">Профіль</a></li>
                                    <!--  <li><a class="dropdown-item" href="{{ route('orders.index') }}">Замовлення</a></li>  -->
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Вийти</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>

                        @endguest
                       
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        <!-- Контент сторінки -->
        @yield('content')
    </main>

    <footer class="footer mt-auto py-3 bg-dark text-white">
        <div class="container">
            <!-- Ваш футер -->
            <div class="row">
                <div class="col-md-4">
                    <h5>Про WorkoutShop</h5>
                    <p>Ваш універсальний магазин для всього необхідного обладнання для тренувань.</p>
                </div>
                <div class="col-md-4">
                    <h5>Швидкі посилання</h5>
                    <ul class="list-unstyled custom-list">
                        <li><a href="{{ route('store.home') }}">Головна</a></li>
                        <li><a href="{{ route('store.about') }}">Про нас</a></li>
                        <li><a href="{{ route('store.contact') }}">Контакти</a></li>
                        <li><a href="{{ route('store.privacy') }}">Політика конфіденційності</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Зв'яжіться з нами</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#"><i class="fab fa-facebook fa-2x text-white"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-2x text-white"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fab fa-instagram fa-2x text-white"></i></a></li>
                    </ul>
                </div>
            </div>

            <hr class="bg-light">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} - WorkoutShop. Всі права захищено.</p>
            </div>
        </div>
    </footer>

    <!-- Підключення скриптів -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Ваші додаткові скрипти -->
    @yield('scripts')
</body>
</html>
