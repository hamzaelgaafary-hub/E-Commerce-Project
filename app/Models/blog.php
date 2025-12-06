<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\category;
use App\Models\User;

class blog extends Model
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


    public function category() : BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
