<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Menampilkan daftar produk UMKM.
     */
    public function index()
    {
        // Mengambil semua data produk UMKM beserta kategorinya
        $umkm = Umkm::with('kategori')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Produk UMKM berhasil diambil',
            'data'    => $umkm
        ], 200);
    }
}
