@extends('site.layouts.app')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            {{-- رسالة Flash (من دالة placeOrder) --}}
            @if(session('success'))
                <div class="alert alert-success text-center">
                    <h4 class="alert-heading">طلبك قيد المعالجة بنجاح!</h4>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">ملخص الطلب رقم: **#{{ $order->id }}**</h3>
                </div>
                <div class="card-body">
                    
                    {{-- تفاصيل الطلب والحالة --}}
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <strong>تاريخ الطلب:</strong><br>{{ $order->created_at->format('Y-m-d H:i') }}
                        </div>
                        <div class="col-md-4">
                            <strong>الحالة:</strong><br><span class="badge badge-info">{{ $order->status }}</span>
                        </div>
                        <div class="col-md-4">
                            <strong>الإجمالي المدفوع:</strong><br><h4 class="text-danger">${{ number_format($order->total_amount, 2) }}</h4>
                        </div>
                    </div>

                    <hr>

                    {{-- تفاصيل المنتجات --}}
                    <h5>تفاصيل المنتجات:</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>المنتج</th>
                                <th>السعر</th>
                                <th>الكمية</th>
                                <th>المجموع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    {{ $item->product->name ?? 'منتج محذوف' }}
                                </td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>المجموع الكلي:</strong></td>
                                <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <hr>

                    {{-- عنوان الشحن ومعلومات العميل --}}
                    <div class="row">
                        <div class="col-md-6">
                            <h5>عنوان الشحن:</h5>
                            <address>
                                **{{ $order->customer_info['first_name'] ?? '' }} {{ $order->customer_info['last_name'] ?? '' }}**<br>
                                {{ $shipping->address ?? '' }}<br>
                                {{ $shipping->city ?? '' }}, {{ $shipping->zip_code ?? '' }}<br>
                                الهاتف: {{ $shipping->phone ?? '' }}
                            </address>
                        </div>
                        <div class="col-md-6">
                            <h5>معلومات الدفع:</h5>
                            <p>طريقة الدفع: **الدفع عند الاستلام**</p>
                            <p class="text-muted">سنقوم بتأكيد الطلب عبر الهاتف قريباً.</p>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-center">
                    شكراً لتسوقك معنا!
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">العودة إلى الصفحة الرئيسية</a>
            </div>

        </div>
    </div>
</div>

@endsection