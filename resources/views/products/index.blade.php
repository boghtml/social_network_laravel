@extends('layouts.store')

@section('title', 'Каталог товарів')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar for filters -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Фільтри</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET">
                        <!-- Категорії -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Категорія</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">Всі категорії</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Сортування -->
                        <div class="mb-3">
                            <label for="sortOrder" class="form-label">Сортувати за</label>
                            <select name="sortOrder" id="sortOrder" class="form-select">
                                <option value="price_asc" {{ request('sortOrder') == 'price_asc' ? 'selected' : '' }}>Ціна: від дешевих до дорогих</option>
                                <option value="price_desc" {{ request('sortOrder') == 'price_desc' ? 'selected' : '' }}>Ціна: від дорогих до дешевих</option>
                                <option value="popularity" {{ request('sortOrder') == 'popularity' ? 'selected' : '' }}>Популярність</option>
                            </select>
                        </div>
                        <!-- Ціновий діапазон -->
                        <div class="mb-3">
                            <label for="priceRange" class="form-label">Ціновий діапазон</label>
                            <div class="row">
                                <div class="col">
                                    <input type="number" name="minPrice" id="minPrice" class="form-control" placeholder="Мін." step="0.01" value="{{ request('minPrice') }}" />
                                </div>
                                <div class="col">
                                    <input type="number" name="maxPrice" id="maxPrice" class="form-control" placeholder="Макс." step="0.01" value="{{ request('maxPrice') }}" />
                                </div>
                            </div>
                        </div>
                        <!-- Пошук -->
                        <div class="mb-3">
                            <label for="searchTerm" class="form-label">Пошук</label>
                            <input type="text" name="searchTerm" id="searchTerm" class="form-control" placeholder="Пошук товарів..." value="{{ request('searchTerm') }}" />
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Застосувати фільтри</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main content area -->
        <div class="col-md-9">
            <h1 class="mb-4">Товари</h1>

            @if ($products->count())
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="card h-100 shadow-sm product-card">
                                <div class="position-relative">
                                @if ($product->images->count())
                                    @php
                                        $primaryImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                                        $imageUrl = $primaryImage->image_url;
                                    @endphp
                                    <a href="{{ route('products.show', $product) }}">
                                        <img src="{{ $imageUrl }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                    </a>
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
                                @endif

                                @if ($product->stock_quantity <= 5 && $product->stock_quantity > 0)
                                    <span class="badge bg-warning position-absolute top-0 end-0 m-2">Обмежений запас</span>
                                @elseif ($product->stock_quantity == 0)
                                    <span class="badge bg-danger position-absolute top-0 end-0 m-2">Продано</span>
                                @endif
                            </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text flex-grow-1">
                                        @if ($product->description)
                                            {{ Str::limit($product->description, 100) }}
                                        @else
                                            Немає опису.
                                        @endif
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <span class="h5 mb-0 text-primary">{{ number_format($product->price, 2) }} ₴</span>
                                        @if ($product->stock_quantity > 0)
                                            <button class="btn btn-sm btn-outline-primary add-to-cart" data-product-id="{{ $product->id }}">
                                                <i class="fas fa-cart-plus"></i> В корзину
                                            </button>
                                        @else
                                            <span class="badge bg-danger">Немає в наявності</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Пагінація -->
                <div class="mt-4">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="alert alert-info text-center" role="alert">
                    <h4 class="alert-heading">Товарів не знайдено</h4>
                    <p>Спробуйте змінити параметри фільтрації або зайдіть пізніше.</p>
                </div>
            @endif
        
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Додаткові скрипти, якщо потрібно -->
<script>
    
    $(document).ready(function() {
        $('.img-thumbnail').on('click', function() {
            var index = $(this).data('slide-to');
            $('#productCarousel').carousel(index);
        });
    });
</script>
@endsection
