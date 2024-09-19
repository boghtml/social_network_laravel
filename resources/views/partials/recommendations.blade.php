<!-- resources/views/partials/recommendations.blade.php -->
<aside class="col-md-3 d-none d-lg-block">
    <div class="position-sticky pt-3">
        <div class="user-profile d-flex align-items-center mb-4">
            <img src="{{ Auth::user()->profile_picture }}" alt="{{ Auth::user()->username }}" class="rounded-circle me-2" width="56" height="56">
            <div>
                <p class="mb-0 fw-bold">{{ Auth::user()->username }}</p>
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="suggestions-container">
            <h6 class="text-muted mb-3">Рекомендації для вас</h6>
            @for ($i = 0; $i < 5; $i++)
                <div class="suggestion-item">
                    <img src="https://via.placeholder.com/32" class="rounded-circle" alt="Suggested User">
                    <div class="flex-grow-1">
                        <p class="mb-0 fw-bold">user{{ $i }}</p>
                        <small class="text-muted">Стежить за вами</small>
                    </div>
                    <button class="btn btn-sm btn-primary">Стежити</button>
                </div>
            @endfor
        </div>
    </div>
</aside>
