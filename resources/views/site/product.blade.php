@extends('site.layouts.app')

@section('title','Product Page')
@section('content')

<!-- Start Single Product Area -->
<section class="single-product-area section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="single-product-img">
                    <img class="img-fluid" src="https://placehold.co/550x750" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-product-content">
                    <h2>{{ $product->name }}</h2>
                    <div class="product-price">
                        <span class="text-danger font-weight-bold">${{ number_format($product->price, 2) }}</span>
                    </div>
                    <div class="product-short-details">
                        <p>{{ $product->short_description }}</p>
                    </div>

                    <div class="product-full-details">
                        <p>{{ $product->description }}</p>
                    </div>
                    <ul class="product-action">
                        <li>
                            <a href="#"><i class="ti ti-eye"></i><span> Quick Shop</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="ti ti-heart "></i><span> Add to Wishlist</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="ti-bar-chart-alt"></i><span> Add to Compare</span></a>
                        </li>
                        <li>
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf 
                                <input type="number" name="qty" value="1" min="1">
                                <button type="submit" class="btn btn-success">
                                    <i class="ti ti-shopping-cart"></i> أضف إلى السلة
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Single Product Area -->


@endsection