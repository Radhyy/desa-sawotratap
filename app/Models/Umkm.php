<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';

    protected $fillable = [
        'name',
        'category',
        'price',
        'image',
        'description',
        'seller',
        'location',
        'stock',
        'phone',
        'status',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
    ];

    /**
     * Scope untuk mendapatkan UMKM aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'Semua') {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Scope untuk produk yang masih tersedia
     */
    public function scopeAvailable($query)
    {
        return $query->where('stock', '>', 0);
    }
}
