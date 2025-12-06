<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable =
    [
        'name',
        'price',
        'trend',
        'short_description',
        'description',
        'qty',
        'category_id',
        'image',
        'slug',
        'user_id'
    ];


    /**
     * Get the category that the product belongs to.
     */
    public function category(): BelongsTo
    {
        // Renaming 'user' to 'merchant' for clarity
        return $this->belongsTo(Category::class);
    }
    /**
     * Get the merchant (user) who owns this product.
     */
    public function merchant(): BelongsTo
    {
        // Explicitly defining the foreign key 'user_id'
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the reviews for this product.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the order items associated with this product.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }


}
