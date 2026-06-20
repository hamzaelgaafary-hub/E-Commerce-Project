<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
        'is_active',
        'short_description',
        'description',
        'qty',
        'category_id',
        'image',
        'slug',
        'user_id'
    ];
    protected $casts = [
            //'trend' => 'boolean',
            'is_active' => 'boolean',
            'price' => 'decimal:2',
    ];

    // Scopes تتوافق مع بياناتك الفعلية
    public function scopeTrending(Builder $query): Builder
    {
        return $query->where('trend', true);  // ← boolean
    }

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('qty', '>', 0);  // ← assuming 'qty' is the stock quantity
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
    public function scopeRegular(Builder $query): Builder
    {
        return $query->where('trend', false);
    }


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


    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }


}
