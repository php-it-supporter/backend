<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'content',
        'image',
        'author',
        'category',
        'isActive',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }
}
