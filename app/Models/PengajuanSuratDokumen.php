<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSuratDokumen extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat_dokumen';

    protected $fillable = [
        'pengajuan_surat_id',
        'filename',
        'filepath',
        'file_type',
        'file_size'
    ];

    /**
     * Relasi ke pengajuan surat
     */
    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSurat::class);
    }

    /**
     * Get file size in human readable format
     */
    public function getFileSizeHumanAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
