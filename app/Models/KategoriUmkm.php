<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUmkm extends Model
{
    use HasFactory;

    protected $table = 'kategori_umkms';
    protected $fillable = ['name', 'slug'];

    public function umkm()
    {
        return $this->hasMany(Umkm::class, 'kategori_umkm_id');
    }
}
