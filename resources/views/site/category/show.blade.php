@extends('site.layouts.app')

@section('title', 'Gateory Page')
@section('content')



    <!-- Start Products Area -->
    <section class="products-area shop-sidebar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        @forelse ($products as $product)
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ route('site.product', $product->id) }}">
                                                <img class="default-img" src="https://placehold.co/550x750" alt="#">
                                            </a>
                                            <div class="button-head">
                                                <!-- Quick Button Modals -->
                                                <div class="button-head">
                                                    <!-- Quick Button Modals -->
                                                    <div class="product-action">
                                                        <a data-toggle="modal" data-target="#quickViewModal" title="Quick View"
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
                                                        <form action="{{ route('cart.add', $product) }}" method="POST">
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
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3><a href="{{ route('site.product', $product->id) }}">{{ $product->name }}</a></h3>
                                        <div class="product-price">
                                            <span>{{ $product->price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info">{{ __('products.no_products_in_category') }}</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Products Area -->

    {{ $products->links() }}

@endsection