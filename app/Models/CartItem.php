<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;
use App\Models\User;


class CartItem extends Model
{
    protected $fillable = ['user_id', 'product_id', 'qty'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
