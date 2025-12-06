<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price', // سعر الوحدة لحظة الشراء
        'subtotal',
    ];

    /**
         * Get the order that this item belongs to.
         */
        public function order(): BelongsTo
        {
            return $this->belongsTo(Order::class);
        }

        /**
         * Get the product associated with this order item.
         */
        public function product(): BelongsTo
        {
            return $this->belongsTo(Product::class);
        }

}
