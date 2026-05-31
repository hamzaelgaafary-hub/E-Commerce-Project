<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use InvalidArgumentException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;


class CartController extends Controller
{
/* *****************useing seetion ************
    to store cart data for guest users, and when user login we will merge session cart with database cart******* 
   
    public function add(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'qty' => ['required', 'integer', 'min:1', "max:{$product->qty}"],
        ]);

        $qty  = (int) $request->qty;
        $cart = session()->get('cart', []);
        $id   = $product->id;

        if (isset($cart[$id])) {
            $newQty = $cart[$id]['qty'] + $qty;
            $cart[$id]['qty'] = min($newQty, $product->qty); // لا تتجاوز الـ stock
        } else {
            $cart[$id] = [
                'id'    => $product->id,
                'name'  => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'qty'   => $qty,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', __('cart.added_successfully'));
    }

    public function index(): View
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        return view('cart.index', compact('cart', 'total'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = (int) $request->qty;
            session()->put('cart', $cart);
        }

        return back()->with('success', __('cart.updated_successfully'));
    }

    public function remove($id): RedirectResponse
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success', __('cart.removed_successfully'));
    }
*/

public function __construct(private CartService $cartService) {}

    public function add(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'qty' => ['required', 'integer', 'min:1', "max:{$product->qty}"],
        ]);

        try {
            $this->cartService->add($product, (int) $request->qty);
            return back()->with('success', __('cart.added_successfully'));
        } catch (InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function index(): View
    {
        $cartItems = $this->cartService->get();
        $total     = $cartItems->sum(fn($item) => $item['price'] * $item['qty']);

        return view('cart.index', compact('cartItems', 'total'));
    }
}