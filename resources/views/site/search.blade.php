@extends('site.layouts.app')

@section('content')

<!-- Start Products Area -->
<section class="products-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="search-bar-top">
                            <div class="search-bar">
                                <form action="{{ url('search') }}" method="GET">
                                    <div class="search-bar d-flex border rounded">
                                        <input type="text" name="query" placeholder="Search products here..." value="{{ request('query') }}">
                                        <button class="btnn"><i class="ti-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if (isset($products) && $products->count() > 0)
                        <h3 class="font-weight-bold">نتائج البحث لـ: "{{ request('query') }}"</h3>
                        <p>تم العثور على {{ $products->total() }} نتائج.</p>
                        @foreach ($products as $product)
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ route('products.show', $product->id) }}">
                                                    <img class="default-img" src="https://placehold.co/150x150" alt="{{ $product->trend }}">
                                                    <span class="new">@if($product->trend == '1') رائج @elseif($product->trend == '0') إعتيادي @endif</span>
                                                </a>
                                                <div class="button-head">
                                                    <div class="product-action">
                                                        <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="{{ route('products.show', $product->id) }}"><i class=" ti-eye"></i><span>عرض سريع</span></a>
                                                        <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>المفضلة</span></a>
                                                    </div>
                                                    <div class="product-action-2">
                                                        <a title="Add to cart" href="#">أضف إلى السلة</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h3><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h3>
                                                <div class="product-price">
                                                    <span>{{ $product->price }} درهم</span>
                                                    @if($product->compare_price)
                                                        <span class="old">{{ $product->compare_price }} درهم</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        <div class="pagination alert alert-info d-flex justify-content-center align-items-center">
                            {{ $products->links() }}
                        </div>
                    @elseif (request()->has('query'))
                        <div class="alert alert-warning">
                            لم يتم العثور على أي منتج يطابق "{{ request('query') }}".
                        </div>
                    @else
                        <div class="alert alert-info">
                            يرجى إدخال كلمة للبحث عن المنتجات.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Products Area -->

@endsection