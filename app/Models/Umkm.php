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
        'kategori_umkm_id',
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
     * Relasi ke KategoriUmkm
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriUmkm::class, 'kategori_umkm_id');
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByCategory($query, $categoryId)
    {
        if ($categoryId && $categoryId !== 'Semua') {
            return $query->where('kategori_umkm_id', $categoryId);
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
