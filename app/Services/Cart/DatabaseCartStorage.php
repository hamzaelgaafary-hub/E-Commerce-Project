<?php

namespace App\Services\Cart;

use App\Models\Product;
use App\Models\User;
use App\Models\CartItem;
use Illuminate\Support\Collection;
use App\Contracts\CartStorageInterface;


class DatabaseCartStorage implements CartStorageInterface
{
    public function __construct(private User $user) {}

    public function add(Product $product, int $qty): void
    {
        $existing = CartItem::query()
            ->where('user_id', $this->user->id)
            ->where('product_id', $product->id)
            ->first();

        $currentQty = $existing?->qty ?? 0;
        $newQty     = min($currentQty + $qty, $product->qty); // ← cap محمي

        CartItem::updateOrCreate(
            ['user_id' => $this->user->id, 'product_id' => $product->id],
            ['qty' => $newQty]
        );
    }

    public function get(): Collection
    {
        return CartItem::query()
            ->where('user_id', $this->user->id)
            ->with('product')
            ->get();
    }

    public function update(int $productId, int $qty): void
    {
        $cartItem = CartItem::query()
            ->where('user_id', $this->user->id)
            ->where('product_id', $productId)
            ->first();

        if (!$cartItem) {
            throw new \InvalidArgumentException("Product with ID {$productId} not found in cart.");
        }

        $cartItem->update(['qty' => $qty]);
    }

    public function index(): Collection
    {
        return CartItem::query()
            ->where('user_id', $this->user->id)
            ->with('product')
            ->get();
    }
    public function remove(int $productId): void
    {
        CartItem::query()
            ->where('user_id', $this->user->id)
            ->where('product_id', $productId)
            ->delete();
    }

    public function clear(): void
    {
        CartItem::query()->where('user_id', $this->user->id)->delete();
    }
}
