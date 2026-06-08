<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perizinan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_izin',
        'nama_pemohon',
        'nik',
        'jenis_izin',
        'keterangan',
        'status',
        'lampiran_path',
        'catatan_admin',
        'catatan_kades',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
