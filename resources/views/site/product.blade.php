@extends('site.layouts.app')

@section('title', 'Product Page')
@section('content')


    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('index')}}">{{__('layout.home_page') }} <i class="ti-arrow-right"></i></a>
                            </li>
                            <li class="active"><a href="{{route('site.products')}}">{{ __('layout.all_categories') }}<i
                                        class="ti-arrow-right"></i> </a></li>
                            <li class="active"><a href="{{ route('site.product', $product) }}">{{ $product->name }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

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
                                <a href="#"><i class="ti ti-eye"></i><span> {{ __('products.quick_shop') }}</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="ti ti-heart "></i><span>
                                        {{ __('products.add_to_wishlist') }}</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="ti-bar-chart-alt"></i><span>
                                        {{ __('products.add_to_compare') }}</span></a>
                            </li>
                            <li>

                                <!--there is an error in submiting the form to add to cart, 
                                                it is not working, please fix it and make sure it works fine--> 

                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <div class="flex items-center gap-2 mt-3">
                                        {{-- Quantity Controls --}}
                                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                                            <button type="button" onclick="changeQty(this, -1)"
                                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-lg font-bold">
                                                −
                                            </button>
                                            <input type="number" name="qty" value="1" min="1" max="{{ $product->qty }}"
                                                class="w-14 text-center border-none focus:ring-0 py-2">

                                            <button type="button" onclick="changeQty(this, +1)"
                                                class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-lg font-bold">
                                                +
                                            </button>
                                        </div>

                                        {{-- Submit --}}

                                        <button type="submit"
                                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 font-weight-bold text-black text-xs uppercase py-2 px-4 rounded-lg transition">
                                            <i class="font-weight-bold ti-shopping-cart mr-1"></i>
                                            {{ __('products.add_to_cart') }}
                                        </button>
                                    </div>
                                   
                                    {{-- Stock Info --}}
                                    @if($product->qty > 0)
                                        <p class="text-xs text-green-400 mt-1">{{ $product->qty }}
                                            {{ __('cart.items_in_stock') }}</p>
                                    @else
                                        <p class="text-xs text-red-500 mt-1">{{ __('cart.out_of_stock') }}</p>
                                    @endif
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Single Product Area -->


    <script>
        function changeQty(btn, delta) {
            const input = btn.closest('div').querySelector('input[name="qty"]');
            const max = parseInt(input.max);
            const min = parseInt(input.min);
            let val = parseInt(input.value) + delta;

            input.value = Math.min(Math.max(val, min), max);
        }
    </script>

@endsection