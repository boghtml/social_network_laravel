@extends('layouts.store')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Головна</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->name]) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6">
        @if ($product->images && $product->images->count() > 0)
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($product->images as $key => $image)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ $image->image_url }}" class="d-block w-100" alt="{{ $product->name }}" style="object-fit: contain; height: 500px;">
                        </div>
                    @endforeach
                </div>
                @if ($product->images->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
            @if ($product->images->count() > 1)
                <div class="row mt-2">
                    @foreach ($product->images->take(4) as $key => $image)
                        <div class="col-3">
                            <img src="{{ $image->image_url }}"
                                class="img-thumbnail"
                                alt="{{ $product->name }}"
                                style="object-fit: cover; height: 80px; width: 100%; cursor: pointer;"
                                data-bs-target="#productCarousel"
                                data-bs-slide-to="{{ $key }}">
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <img src="{{ asset('images/no-image.png') }}" class="img-fluid" alt="No Image" style="object-fit: contain; height: 500px; width: 100%;">
        @endif

        </div>
        <div class="col-md-6">
            <h1 class="mb-3">{{ $product->name }}</h1>
            <p class="lead">{{ $product->description }}</p>
            <h3 class="text-primary mb-3">{{ number_format($product->price, 2) }} ₴</h3>
            <p>Категорія: <a href="{{ route('products.index', ['category' => $product->category->name]) }}" class="badge bg-secondary text-decoration-none">{{ $product->category->name }}</a></p>
            <p>
                Наявність:
                <span class="badge bg-{{ $product->stock_quantity > 10 ? 'success' : ($product->stock_quantity > 0 ? 'warning' : 'danger') }}">
                    {{ $product->stock_quantity > 0 ? $product->stock_quantity . ' в наявності' : 'Немає в наявності' }}
                </span>
            </p>
            @if ($product->stock_quantity > 0)
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <div class="input-group mb-3" style="max-width: 200px;">
                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock_quantity }}" id="quantityInput" />
                        <button class="btn btn-primary" type="button" id="addToCartBtn"
                            data-product-id="{{ $product->id }}"
                            data-add-cart-url="{{ route('cart.add') }}"
                            data-csrf-token="{{ csrf_token() }}">
                            <i class="fas fa-cart-plus"></i> В корзину
                        </button>

                    </div>
                </form>
            @else
                <button class="btn btn-secondary btn-lg" disabled>Немає в наявності</button>
            @endif
            <hr>
            <h4>Особливості продукту</h4>
            <ul class="list-unstyled">
                <li><i class="fas fa-check text-success me-2"></i>Висока якість матеріалів</li>
                <li><i class="fas fa-check text-success me-2"></i>Міцна конструкція</li>
                <li><i class="fas fa-check text-success me-2"></i>Підходить для всіх рівнів</li>
                <li><i class="fas fa-check text-success me-2"></i>Легко чистити та обслуговувати</li>
            </ul>
            <hr>
            <h4>Інформація про доставку</h4>
            <p><i class="fas fa-truck me-2"></i>Безкоштовна доставка при замовленні від 1000 ₴</p>
            <p><i class="fas fa-box me-2"></i>30-денна політика повернення</p>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var productCarousel = document.getElementById('productCarousel');
        if (productCarousel) {
            var carousel = new bootstrap.Carousel(productCarousel, {
                interval: false 
            });

            
            var thumbnails = document.querySelectorAll('.img-thumbnail');
            thumbnails.forEach(function (thumbnail) {
                thumbnail.addEventListener('click', function () {
                    var index = this.getAttribute('data-bs-slide-to');
                    carousel.to(parseInt(index));
                });
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'ArrowLeft') {
                    carousel.prev();
                } else if (e.key === 'ArrowRight') {
                    carousel.next();
                }
            });

            productCarousel.focus();

            var quantityInput = document.getElementById('quantityInput');
            if (quantityInput) {
                quantityInput.addEventListener('input', function () {
                    var max = parseInt(this.getAttribute('max'));
                    var value = parseInt(this.value);
                    if (value > max) {
                        this.value = max;
                    }
                });
            }
        }

        var addToCartBtn = document.getElementById('addToCartBtn');
        if (addToCartBtn) {
            var productId = addToCartBtn.getAttribute('data-product-id');
            var addCartUrl = addToCartBtn.getAttribute('data-add-cart-url');
            var csrfToken = addToCartBtn.getAttribute('data-csrf-token');

            addToCartBtn.addEventListener('click', function (e) {
                e.preventDefault();
                var quantity = document.getElementById('quantityInput').value;

                fetch(addCartUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    var cartItemCount = data.cartItemCount;
                    var cartIcon = document.querySelector('.fa-shopping-cart');
                    var badge = cartIcon.nextElementSibling;
                    if (!badge) {
                        badge = document.createElement('span');
                        badge.classList.add('position-absolute', 'top-0', 'start-100', 'translate-middle', 'badge', 'rounded-pill', 'bg-danger');
                        cartIcon.parentNode.appendChild(badge);
                    }
                    badge.textContent = cartItemCount;

                    addToCartBtn.classList.add('btn-success');
                    addToCartBtn.classList.remove('btn-primary');
                    addToCartBtn.innerHTML = '<i class="fas fa-check"></i> Додано';
                    setTimeout(function () {
                        addToCartBtn.classList.add('btn-primary');
                        addToCartBtn.classList.remove('btn-success');
                        addToCartBtn.innerHTML = '<i class="fas fa-cart-plus"></i> В корзину';
                    }, 2000);
                });
            });
        }
    });
</script>
@endsection
