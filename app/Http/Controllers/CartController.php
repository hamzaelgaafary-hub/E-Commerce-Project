<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * يعرض محتويات السلة.
     */
    public function index()
    {
        // استرجاع السلة من الجلسة (إذا لم تكن موجودة، تكون مصفوفة فارغة)
        $cart = session()->get('cart', []);

        // تمرير السلة إلى العرض
        return view('cart.index', compact('cart'));
    }

    /**
     * يضيف منتجاً جديداً إلى السلة أو يزيد الكمية إذا كان موجوداً.
     */
    public function add(Request $request, Product $product)
    {
        // 1. استرجاع السلة الحالية
        $cart = session()->get('cart', []);
        
        // 2. المفتاح في السلة هو ID المنتج
        $productId = $product->id;
        $qty = 1; // يمكن جعلها $request->qty إذا كان هناك حقل كمية

        // 3. التحقق مما إذا كان المنتج موجوداً بالفعل في السلة
        if (isset($cart[$productId])) {
            // إذا كان موجوداً، نزيد الكمية
            $cart[$productId]['qty'] += $qty;
        } else {
            // إذا لم يكن موجوداً، نضيفه
            $cart[$productId] = [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "qty" => $qty,
                // يمكنك إضافة حقول أخرى مثل 'image'
            ];
        }

        // 4. حفظ مصفوفة السلة المحدثة في الجلسة
        session()->put('cart', $cart);
        //dd($cart);  
        // 5. إرجاع المستخدم مع رسالة نجاح
        return redirect()->back()->with('success', 'تم إضافة المنتج إلى السلة بنجاح!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            $cart[$id]['qty'] = $request->qty;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'تم تحديث الكمية بنجاح!');
    }
    
    /**
     * يزيل المنتج من السلة.
     */
    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'تم حذف المنتج من السلة.');
    }
}