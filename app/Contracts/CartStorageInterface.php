<?php

namespace App\Contracts;

use App\Models\Product;
use Illuminate\Support\Collection;


interface CartStorageInterface
{
     public function add(Product $product, int $qty): void;
    public function get(): Collection;
    public function remove(int $productId): void;
    public function clear(): void;  
}
