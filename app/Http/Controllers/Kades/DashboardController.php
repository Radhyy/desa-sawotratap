<?php

namespace App\Http\Controllers\Kades;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'surat_menunggu' => PengajuanSurat::where('status', 'menunggu_kades')->count(),
            'surat_selesai'  => PengajuanSurat::where('status', 'selesai')->count(),
            'total_surat'    => PengajuanSurat::count(),
            'total_users'    => User::where('role', 'user')->count(),
        ];

        $chartData = [
            'labels' => ['Pemerintahan', 'Pembangunan', 'Pembinaan', 'Pemberdayaan', 'Tak Terduga'],
            'data'   => [1200000000, 850000000, 350000000, 250000000, 58000000],
        ];

        $recent_announcements = Announcement::latest()->take(5)->get();

        $recent_surat = PengajuanSurat::with('user')
            ->whereIn('status', ['menunggu_kades', 'selesai', 'ditolak'])
            ->latest()->take(5)->get();

        $recent_pengaduan = collect([
            (object)['id' => 1, 'nama_pelapor' => 'Budi Santoso', 'kategori' => 'Fasilitas Umum', 'judul' => 'Lampu Jalan Mati di RT 03', 'tanggal' => now()->subDays(1), 'status' => 'Pending'],
            (object)['id' => 2, 'nama_pelapor' => 'Siti Aminah',  'kategori' => 'Pelayanan',      'judul' => 'Antrean panjang di balai desa', 'tanggal' => now()->subDays(2), 'status' => 'Diproses'],
            (object)['id' => 3, 'nama_pelapor' => 'Agus Pratama', 'kategori' => 'Keamanan',       'judul' => 'Ronda malam tidak aktif', 'tanggal' => now()->subDays(4), 'status' => 'Selesai'],
        ]);

        return view('CRUD.kades.dashboard', compact('stats', 'chartData', 'recent_announcements', 'recent_surat', 'recent_pengaduan'));
    }
}
