<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'category',
        'image',
        'excerpt',
        'content',
        'read_time',
        'author',
        'views',
        'trending',
        'tags',
    ];

    protected $casts = [
        'date' => 'date',
        'tags' => 'array',
        'trending' => 'boolean',
    ];
}
