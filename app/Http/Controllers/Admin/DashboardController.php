<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use App\Models\PengajuanSurat;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_announcements' => Announcement::count(),
            'active_announcements' => Announcement::where('status', 'active')->count(),
            'total_users' => User::count(),
            'admin_users' => User::where('role', 'admin')->count(),
        ];

        // Chart Data (dummy)
        $chartData = [
            'labels' => ['Pemerintahan', 'Pembangunan', 'Pembinaan', 'Pemberdayaan', 'Tak Terduga'],
            'data' => [1200000000, 850000000, 350000000, 250000000, 58000000],
        ];

        $recent_announcements = Announcement::latest()->take(5)->get();
        
        $recent_surat = PengajuanSurat::with('user')->latest()->take(5)->get();

        $recent_pengaduan = collect([
            (object)[
                'id' => 1,
                'nama_pelapor' => 'Budi Santoso',
                'kategori' => 'Fasilitas Umum',
                'judul' => 'Lampu Jalan Mati di RT 03',
                'tanggal' => now()->subDays(1),
                'status' => 'Pending'
            ],
            (object)[
                'id' => 2,
                'nama_pelapor' => 'Siti Aminah',
                'kategori' => 'Pelayanan',
                'judul' => 'Antrean panjang di balai desa',
                'tanggal' => now()->subDays(2),
                'status' => 'Diproses'
            ],
            (object)[
                'id' => 3,
                'nama_pelapor' => 'Agus Pratama',
                'kategori' => 'Keamanan',
                'judul' => 'Ronda malam tidak aktif',
                'tanggal' => now()->subDays(4),
                'status' => 'Selesai'
            ]
        ]);

        return view('CRUD.dashboard', compact('stats', 'chartData', 'recent_announcements', 'recent_surat', 'recent_pengaduan'));
    }
}
