<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSurat;
use App\Models\Pengaduan;
use App\Models\Perizinan;

class LaporanSayaController extends Controller
{
    /**
     * Display a listing of user's reports.
     */
    public function index()
    {
        $userId = Auth::id();

        $pengajuanSurat = PengajuanSurat::where('user_id', $userId)->latest()->get();
        $pengaduan = Pengaduan::where('user_id', $userId)->latest()->get();
        $perizinan = Perizinan::where('user_id', $userId)->latest()->get();

        return view('laporan-saya.index', compact('pengajuanSurat', 'pengaduan', 'perizinan'));
    }
}
