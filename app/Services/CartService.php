<?php 

namespace App\Services;

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;
use App\Contracts\CartStorageInterface;
use App\Services\Cart\DatabaseCartStorage;
use App\Services\Cart\SessionCartStorage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartService
{
    
    private CartStorageInterface $storage;

    public function __construct()
    {
    $this->storage = auth::check()
            ? new DatabaseCartStorage(auth::user())
            : new SessionCartStorage();
    }

    public function add(Product $product, int $qty): void
    {
        if ($qty < 1 || $qty > $product->qty) {
            throw new InvalidArgumentException(__('cart.invalid_quantity'));
        }

        $this->storage->add($product, $qty);
    }

    public function get(): Collection
    {
        return $this->storage->get();
    }

    public function mergeSessionToDatabase(User $user): void
    {
        $session  = new SessionCartStorage();
        $database = new DatabaseCartStorage($user);

        foreach ($session->get() as $item) {
            $product = Product::findOrFail($item['id']);
            if ($product) {
                $database->add($product, $item['qty']);
            }
        }

        $session->clear(); // ← امسح الـ session بعد الـ merge
    }
}