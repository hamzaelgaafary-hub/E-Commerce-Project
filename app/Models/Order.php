<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'total_amount', 
        'status', 
        'shipping_address', 
        'customer_info',
        'payment_method',
    ];
    
    // تحويل بعض الأعمدة إلى مصفوفات JSON تلقائيًا
    protected $casts = [
        'shipping_address' => 'array',
        'customer_info' => 'array',
        'payment_method' => 'string',
    ];

    /**
     * Get the user (customer) who placed the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the items for this order.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
