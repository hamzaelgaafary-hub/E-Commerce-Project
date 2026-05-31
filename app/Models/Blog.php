<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;
use App\Models\User;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'quote',
        'content',
        'slug',
        'image',
        'category_id',
        'user_id',
    ];


    public function Category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function User() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
