@extends('site.layouts.app')

@section('content')

    <div class="container">
        <h2 class='title-style text-center mt-2 mb-2'>{{ __('cart.shopping_cart') }}</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($cart)
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('cart.product') }}</th>
                        <th>{{ __('cart.price') }}</th>
                        <th>{{ __('cart.quantity') }}</th>
                        <th>{{ __('cart.subtotal') }}</th>
                        <th>{{ __('cart.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach($cart as $id => $details)
                        @php $total += $details['price'] * $details['qty'] @endphp
                        <tr>
                            <td class="product-thumbnail">
                                <div class="product-name">
                                    <img src="https://placehold.co/70x70" alt="{{ $details['name'] }}">
                                    <a href="{{ route('site.product', $id) }}">{{ $details['name'] }}</a>
                                </div>
                            </td>
                            <td class="product-price">
                                <span class="price">${{ number_format($details['price'], 2) }}</span>
                            </td>
                            <td class="product-quantity">
                                {{-- يمكنك إضافة نموذج تحديث الكمية هنا (يستخدم مسار cart.update) --}}
                                <form method="POST" action="{{ route('cart.update', $id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" class=" w-25 mt-2" name="qty" value="{{ $details['qty'] }}" min="1">
                                    <button type="submit" class="btn btn-primary btn-sm">{{ __('cart.update') }}</button>
                                </form>
                            </td>
                            <td class="product-subtotal">
                                <span class="price">${{ number_format($details['price'] * $details['qty'], 2) }}</span>
                            </td>
                            <td class="product-remove">
                                <form method="POST" action="{{ route('cart.remove', $id) }}">
                                    @csrf
                                    @method('DELETE') {{-- يجب استخدام توجيه DELETE --}}
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>{{ __('cart.total') }}:</strong></td>
                        <td><strong>${{ number_format($total, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>

            <div class="buttons-cart text-right mt-5">
                <a href="{{ route('checkout.index') }}"
                    class="btn btn-primary  font-bold">{{ __('cart.proceed_to_checkout') }}</a>
            </div>
        @else
            <div class="alert alert-info">{{ __('cart.cart_empty') }}</div>
        @endif
    </div>



@endsection