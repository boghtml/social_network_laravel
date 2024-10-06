<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h3 class="mb-4 brand">AIgram</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('home') }}">
                    <i class="fas fa-home"></i> Головна
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <i class="fas fa-store"></i> Магазин
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-search"></i> Пошук
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="far fa-compass"></i> Цікаве
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-film"></i> Reels
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="far fa-paper-plane"></i> Повідомлення
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="far fa-heart"></i> Сповіщення
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-plus-square"></i> Створити
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.show', ['username' => Auth::user()->username]) }}">
                    <i class="far fa-user-circle"></i> Профіль
                </a>
            </li>
        </ul>
        <div class="mt-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fab fa-threads"></i> Threads
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-bars"></i> Більше
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
