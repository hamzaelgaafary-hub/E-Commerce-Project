@extends('site.layouts.app')

@section('content')

    <div class="container my-5">
        <h2 class="title-style mb-5">{{ __('checkout.checkout') }}</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            {{-- 1. Order Shipping information form --}}
            <div class="col-md-7">
                <div class="card bg-light p-4">
                    <h4>{{ __('checkout.shipping_information') }}</h4>
                    <form action="{{ route('checkout.placeOrder') }}" method="POST">
                        @csrf
                        {{-- Customer information fields --}}
                        <div class="form-group mb-3">
                            <label for="first_name">{{ __('checkout.first_name') }} <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="first_name" name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name') }}" required>
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="last_name">{{ __('checkout.last_name') }} <span class="text-danger">*</span></label>
                            <input type="text" id="last_name" name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}"
                                required>
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">{{ __('checkout.email') }} <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">{{ __('checkout.phone') }} <span class="text-danger">*</span></label>
                            <input type="tel" id="phone" name="phone"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                required>
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">{{ __('checkout.address') }} <span class="text-danger">*</span></label>
                            <textarea id="address" name="address"
                                class="form-control @error('address') is-invalid @enderror"
                                required>{{ old('address') }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="city">{{ __('checkout.city') }} <span class="text-danger">*</span></label>
                            <input type="text" id="city" name="city"
                                class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                            @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        {{-- End Customer information fields --}}

                        <h4>{{ __('checkout.payment_method') }}</h4>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash"
                                checked>
                            <label class="form-check-label" for="cash">
                                {{ __('checkout.cash_on_delivery') }}
                            </label>
                        </div>
                        {{-- You can add more payment options here --}}

                        @if(Auth::check())
                            <button type="submit"
                                class="btn btn-success btn-lg mt-4">{{ __('checkout.confirm_order_and_pay') }}</button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-4">{{ __('checkout.login') }}</a>
                        @endif
                        <a href="{{ route('site.products') }}" type="button"
                            class="btn btn-danger btn-lg mt-5">{{ __('checkout.cancel') }}</a>
                    </form>
                </div>
            </div>

            {{-- 2. Order summary --}}
            <div class="col-md-5">
                <div class="card bg-light p-4 sticky-top">
                    <h4>{{ __('checkout.order_summary') }}</h4>
                    <ul class="list-group list-group-flush mb-3">
                        @foreach($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $item['name'] }} (x{{ $item['qty'] }})</span>
                                <span>${{ number_format($item['price'] * $item['qty'], 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-between font-weight-bold">
                        <span>{{ __('checkout.subtotal') }}:</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>{{ __('checkout.shipping_cost') }}:</span>
                        <span>$0.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between h4 text-success">
                        <span>{{ __('checkout.final_total') }}:</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection