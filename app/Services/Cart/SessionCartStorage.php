<?php

namespace App\Services\Cart;
use App\Contracts\CartStorageInterface;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class SessionCartStorage implements CartStorageInterface
{
    public function add(Product $product, int $qty): void
    {
        $cart   = session()->get('cart', []);
        $id     = $product->id;
        $newQty = min(($cart[$id]['qty'] ?? 0) + $qty, $product->qty); // ← cap

        $cart[$id] = [
            'id'    => $product->id,
            'name'  => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'slug'  => $product->slug,
            'qty'   => $newQty,
        ];

        session()->put('cart', $cart);
    }

    public function get(): Collection
    {
        return collect(session()->get('cart', []));
    }
    public function update(int $productId, int $qty): void
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            throw new \InvalidArgumentException("Product with ID {$productId} not found in cart.");
        }

        $cart[$productId]['qty'] = $qty;
        session()->put('cart', $cart);
    }

    public function index(): Collection
    {
        return collect(session()->get('cart', []));
    }
    
    public function remove(int $productId): void
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    public function clear(): void
    {
        session()->forget('cart');
    }
}
