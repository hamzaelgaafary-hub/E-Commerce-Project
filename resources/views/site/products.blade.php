@extends('site.layouts.app')

@section('title', 'Home Page')
@section('content')



    <!-- Start Trending Product Area -->
    <section>
        <div class="product-area section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>{{ __('products.trending_item') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-info">
                            <div class="nav-main">
                                <!-- Tab Nav -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @php $i = 0 @endphp
                                    @foreach($categories as $category)
                                        <li class="nav-item"><a class="nav-link @if($i == 1) active @endif" data-toggle="tab"
                                                href="#{{$category->id}}" role="tab">{{ $category->name }}</a></li>
                                        @php $i++ @endphp
                                    @endforeach
                                </ul>
                                <!--/ End Tab Nav -->
                            </div>
                            <!-- Start Category Trending Tab -->
                            <div class="tab-content" id="myTabContent">
                                @php $firstCategory = true; @endphp
                                @foreach($categories as $category)
                                    <div class="tab-pane fade {{ $firstCategory ? 'show active' : '' }}"
                                        id="{{ $category->id }}" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                                <!-- Start Trending Tab -->
                                                @forelse($category->Products as $product)
                                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                                                        <div class="single-product h-100">
                                                            <div class="product-img">
                                                                <a href="{{ route('site.product', $product->id) }}" class="d-block">
                                                                    <img class="default-img img-fluid w-100"
                                                                        src="https://placehold.co/550x750"
                                                                        alt="{{ $product->name }}">
                                                                </a>
                                                                <div class="button-head">
                                                                    <!-- Quick Button Modals -->
                                                                    <div class="product-action">
                                                                        <a data-toggle="modal" data-target="#exampleModal"
                                                                            title="Quick View"
                                                                            href="{{ route('site.product', $product->id) }}">
                                                                            <i
                                                                                class="ti-eye"></i><span>{{ __('products.quick_shop') }}</span>
                                                                        </a>
                                                                        <a title="Wishlist" href="#">
                                                                            <i class="ti-heart"></i><span>Add to Wishlist</span>
                                                                        </a>
                                                                        <a title="Compare" href="#">
                                                                            <i
                                                                                class="ti-bar-chart-alt"></i><span>{{ __('products.compare') }}</span>
                                                                        </a>
                                                                    </div>
                                                                    <!-- Quick Add To Cart-->
                                                                    <div class="product-action-2">
                                                                        <form action="{{ route('cart.add', $product) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="number" name="qty" value="1" min="1"
                                                                                class="form-control w-20">
                                                                            <button type="submit"
                                                                                class="ti ti-shopping-cart btn btn-success">
                                                                                {{ __('products.add_to_cart') }}
                                                                            </button>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-content p-3">
                                                                <h3 class="mb-1">
                                                                    <a href="{{ route('site.product', $product->id) }}"
                                                                        class="text-dark">
                                                                        {{ Str::limit($product->name, 30) }}
                                                                    </a>
                                                                </h3>
                                                                <div class="product-price">
                                                                    <span
                                                                        class="text-danger font-weight-bold">${{ number_format($product->price, 2) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12">
                                                        <div class="alert alert-info">{{ __('products.no_trending_products') }}
                                                        </div>
                                                    </div>
                                                @endforelse

                                                <!--/ End Trending Tab -->
                                            </div>
                                        </div>
                                    </div>
                                    @php $firstCategory = false; @endphp
                                @endforeach
                            </div>
                            <!-- End Category Trending Tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->


    <!-- Start all Products Area -->
    <section>
        <div class="product-area section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>{{ __('products.all_products') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-info">
                            <div class="nav-main">
                                <!-- Tab Nav -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @php $i = 0 @endphp
                                    @foreach($categories as $category)
                                        <li class="nav-item">
                                            <a class="nav-link @if($i == 0) active @endif" data-toggle="tab"
                                                href="#cat-{{$category->id}}" role="tab">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                        @php $i++ @endphp
                                    @endforeach
                                </ul>
                                <!--/ End Tab Nav -->
                            </div>
                            <!-- Start Category All Tab -->
                            <div class="tab-content" id="myTabContent">
                                @php $firstCategory = true; @endphp
                                @foreach($categories as $category)
                                    <div class="tab-pane fade {{ $firstCategory ? 'show active' : '' }}"
                                        id="cat-{{ $category->id }}" role="tabpanel">
                                        <div class="tab-single">
                                            <div class="row">
                                                @forelse($products->where('category_id', $category->id) as $product)
                                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                                                        <div class="single-product h-100">
                                                            <div class="product-img">
                                                                <a href="{{ route('site.product', $product->id) }}" class="d-block">
                                                                    <img class="default-img img-fluid w-100"
                                                                        src="https://placehold.co/550x750"
                                                                        alt="{{ $product->name }}">
                                                                    <img class="hover-img img-fluid w-100"
                                                                        src="https://placehold.co/550x750"
                                                                        alt="{{ $product->name }} hover">
                                                                </a>
                                                                <!-- Quick Button Modals -->
                                                                <div class="button-head">
                                                                    <!-- Quick Button Modals -->
                                                                    <div class="product-action">
                                                                        <a data-toggle="modal" data-target="#quickViewModal"
                                                                            title="Quick View"
                                                                            href="{{ route('site.product', $product->id) }}">
                                                                            <i class="ti-eye"></i>
                                                                            <span>{{ __('products.quick_shop') }}</span>
                                                                        </a>
                                                                        <a title="Wishlist" href="#">
                                                                            <i class="ti-heart"></i>
                                                                            <span>{{ __('products.add_to_wishlist') }}</span>
                                                                        </a>
                                                                        <a title="Compare" href="#">
                                                                            <i class="ti-bar-chart-alt"></i>
                                                                            <span>{{ __('products.compare') }}</span>
                                                                        </a>
                                                                    </div>
                                                                    <!-- Quick Add To Cart-->
                                                                    <div class="product-action-2">
                                                                        <form action="{{ route('cart.add', $product) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div>
                                                                                {{-- Quantity Controls --}}
                                                                                <input type="number" name="qty" value="1" min="1"
                                                                                    class="form-control w-20">
                                                                                {{-- Submit --}}
                                                                                <button type="submit" class="btn btn-success">
                                                                                    <i class="ti ti-shopping-cart"></i>
                                                                                    {{ __('products.add_to_cart') }}
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <!--/ End Quick Button Modals -->
                                                            </div>
                                                            <div class="product-content p-3">
                                                                <h3 class="mb-1">
                                                                    <a href="{{ route('site.product', $product->id) }}"
                                                                        class="text-dark">
                                                                        {{ Str::limit($product->name, 30) }}
                                                                    </a>
                                                                </h3>
                                                                <div class="product-price">
                                                                    <span
                                                                        class="text-danger font-weight-bold">${{ number_format($product->price, 2) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12">
                                                        <div class="alert alert-info">{{ __('products.no_products_in_category') }}
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!--/ End All Products Tab -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End All Products Area -->



@endsection