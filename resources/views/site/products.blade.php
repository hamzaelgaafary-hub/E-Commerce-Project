@extends('site.layouts.app')

@section('title','Home Page')
@section('content')



	<!-- Start Trending Product Area -->
<section>
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Trending Item</h2>
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
                                <li class="nav-item"><a class="nav-link @if($i == 1) active @endif" data-toggle="tab" href="#{{$category->id}}" role="tab">{{ $category->name }}</a></li>
                                @php $i++ @endphp
                                @endforeach
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content" id="myTabContent">
                            @php $firstCategory = true; @endphp
                            @foreach($categories as $category)
                            <div class="tab-pane fade {{ $firstCategory ? 'show active' : '' }}" id="{{ $category->id }}" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        @forelse($products->where('category_id', $category->id)->where('trend', 1) as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                                            <div class="single-product h-100">
                                                <div class="product-img">
                                                    <a href="{{ route('site.product', $product->id) }}" class="d-block">
                                                        <img class="default-img img-fluid w-100" src="https://placehold.co/550x750" alt="{{ $product->name }}">
                                                        <img class="hover-img img-fluid w-100" src="https://placehold.co/550x750" alt="{{ $product->name }} hover">
                                                    </a>
                                                    <div class="button-head">
                                                        <div class="product-action">
                                                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="{{ route('site.product', $product->id) }}">
                                                                <i class="ti-eye"></i><span>Quick Shop</span>
                                                            </a>
                                                            <a title="Wishlist" href="#">
                                                                <i class="ti-heart"></i><span>Add to Wishlist</span>
                                                            </a>
                                                            <a title="Compare" href="#">
                                                                <i class="ti-bar-chart-alt"></i><span>Compare</span>
                                                            </a>
                                                        </div>
                                                        <div class="product-action-2">
                                                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                                                @csrf 
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="ti ti-shopping-cart"></i> أضف إلى السلة
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content p-3">
                                                    <h3 class="mb-1">
                                                        <a href="{{ route('site.product', $product->id) }}" class="text-dark">
                                                            {{ Str::limit($product->name, 30) }}
                                                        </a>
                                                    </h3>
                                                    <div class="product-price">
                                                        <span class="text-danger font-weight-bold">${{ number_format($product->price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-12">
                                            <div class="alert alert-info">No trending products found in this category.</div>
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            @php $firstCategory = false; @endphp
                            @endforeach
                            <!--/ End Single Tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Trending Product Area -->


	<!-- Start all Products Area -->
<section >
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>All Products</h2>
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
                                    <a class="nav-link @if($i == 0) active @endif" data-toggle="tab" href="#cat-{{$category->id}}" role="tab">
                                        {{ $category->name }}
                                    </a>
                                </li>
                                @php $i++ @endphp
                                @endforeach
                            </ul>
                            <!--/ End Tab Nav -->
                        </div>
                        <div class="tab-content" id="myTabContent">
                            @php $firstCategory = true; @endphp
                            @foreach($categories as $category)
                            <div class="tab-pane fade {{ $firstCategory ? 'show active' : '' }}" id="cat-{{ $category->id }}" role="tabpanel">
                                <div class="tab-single">
                                    <div class="row">
                                        @forelse($products->where('category_id', $category->id) as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                                            <div class="single-product h-100">
                                                <div class="product-img">
                                                    <a href="{{ route('site.product', $product->id) }}" class="d-block">
                                                        <img class="default-img img-fluid w-100" src="https://placehold.co/550x750" alt="{{ $product->name }}">
                                                        <img class="hover-img img-fluid w-100" src="https://placehold.co/550x750" alt="{{ $product->name }} hover">
                                                    </a>
                                                    <div class="button-head">
                                                        <div class="product-action">
                                                            <a data-toggle="modal" data-target="#quickViewModal" title="Quick View" href="{{ route('site.product', $product->id) }}">
                                                                <i class="ti-eye"></i><span>Quick Shop</span>
                                                            </a>
                                                            <a title="Wishlist" href="#">
                                                                <i class="ti-heart"></i><span>Add to Wishlist</span>
                                                            </a>
                                                            <a title="Compare" href="#">
                                                                <i class="ti-bar-chart-alt"></i><span>Compare</span>
                                                            </a>
                                                        </div>
                                                        <div class="product-action-2">
                                                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                                                @csrf 
                                                                <button type="submit" class="btn btn-success">
                                                                    <i class="ti ti-shopping-cart"></i> أضف إلى السلة
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content p-3">
                                                    <h3 class="mb-1">
                                                        <a href="{{ route('site.product', $product->id) }}" class="text-dark">
                                                            {{ Str::limit($product->name, 30) }}
                                                        </a>
                                                    </h3>
                                                    <div class="product-price">
                                                        <span class="text-danger font-weight-bold">${{ number_format($product->price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-12">
                                        </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!--/ End Single Tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

	<!-- End Product Area -->



@endsection