<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // لاستخدام الـ Transactions
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    /**
     * عرض صفحة الدفع وملخص الطلب.
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            // توجيه المستخدم إذا كانت السلة فارغة
            return redirect()->route('cart.index')->with('error', 'سلة التسوق فارغة ولا يمكن متابعة عملية الدفع.');
        }

        // حساب الإجمالي (Total Calculation)
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });
        
        // يمكن إضافة منطق حساب الشحن والضرائب هنا

        return view('checkout.index', [
            'cartItems' => $cart,
            'subtotal' => $subtotal,
            // 'shippingCost' => 0, 
            // 'total' => $subtotal + 0, 
        ]);
    }

    /**
     * معالجة تأكيد الطلب وتخزينه. 
     *           ....Under fixing and testing to link with payment gateway and database.....
     */
    public function placeOrder(Request $request)
    {
        // 1. Validate input data
        $validated = $request->validate([
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email:rfc,dns'],
            'phone'         => ['required', 'string', 'max:20'],
            'address'       => ['required', 'string', 'max:500'],
            'city'          => ['required', 'string', 'max:100'],
            'payment_method' => ['required', 'string', 'in:credit_card,paypal,cod'],
        ]);

        // Get cart from session
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty. Please add products before checkout.');
        }

        // 2. استخدام Transaction لضمان حفظ الطلب وتفاصيله معاً
        // إذا فشل أي جزء، يتم التراجع عن الكل.
        try {
            DB::beginTransaction();

            // حساب الإجمالي النهائي
            $totalAmount = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['qty'];
            });

            // 3. Create order record
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'shipping_address' => json_encode([
                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'phone' => $validated['phone']
                ]),
                'customer_info' => [
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'city' => $validated['city']
                ]
            ]);
            //dd($order);
            // 4. Process order items and update inventory
            $orderItems = [];
            
            foreach ($cart as $item) {
                $product = \App\Models\Product::findOrFail($item['id']);
                
                // Check stock availability
                if ($product->stock < $item['qty']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }
                
                // Prepare order item
                $orderItems[] = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'price' => $product->price, // Use current price from database
                    'subtotal' => $product->price * $item['qty'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                // Update product stock
                $product->decrement('stock', $item['qty']);
            }

            //dd($orderItems);
            // إدراج جميع العناصر دفعة واحدة (Bulk Insert)
            DB::table('order_items')->insert($orderItems);

            // 5. مسح السلة من الجلسة
            session()->forget('cart');
            
            DB::commit();

            //dd($order);
            //dd($orderItems);
            // 6. توجيه إلى صفحة تأكيد الطلب
            return redirect()->route('order.confirmation', $order->id)
                             ->with('success', 'تم تأكيد طلبك بنجاح! رقم الطلب هو ' . $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order placement failed: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => auth()->id(),
                'cart' => $cart
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to process your order: ' . $e->getMessage());
        }
    }

    /**
     * عرض صفحة تأكيد الطلب.
     */
    public function confirmation(Order $order)
    {
        // هنا، $order هو كائن Order جاهز ومُعبأ بالبيانات من قاعدة البيانات.

        // التأكد من أن المستخدم الحالي هو صاحب الطلب (لأسباب أمنية)
        if (auth()->check() && $order->user_id !== auth()->id()) {
            // يمكنك إرجاع خطأ 403 أو توجيهه لمكان آخر
            // return abort(403, 'Unauthorized action.');
        }

        // جلب تفاصيل المنتجات المرتبطة بالطلب (Eager Loading)
        $order->load('items.product');

        return view('checkout.order_confirmation', [
            'order' => $order,
            'shipping' => (object) $order->shipping_address, // تحويلها إلى كائن لسهولة الوصول
        ]);
    }
}