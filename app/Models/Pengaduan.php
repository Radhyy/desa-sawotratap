<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket',
        'nama',
        'no_whatsapp',
        'kategori',
        'lokasi',
        'tingkat_urgensi',
        'waktu_kejadian',
        'deskripsi',
        'status',
        'lampiran_path',
        'catatan_admin',
        'catatan_kades',
    ];

    protected $casts = [
        'waktu_kejadian' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
