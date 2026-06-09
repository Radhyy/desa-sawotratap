<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita desa.
     */
    public function index()
    {
        // Mengambil semua data berita
        $berita = Berita::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Berita Desa berhasil diambil',
            'data'    => $berita
        ], 200);
    }
}
