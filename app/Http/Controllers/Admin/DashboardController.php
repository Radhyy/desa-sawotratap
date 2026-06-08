<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use App\Models\PengajuanSurat;
use App\Models\Pengaduan;
use Illuminate\Support\Str;

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

        $recent_pengaduan = Pengaduan::latest()->take(5)->get()
            ->map(fn($p) => (object)[
                'nama_pelapor' => $p->nama,
                'kategori'     => $p->kategori,
                'judul'        => Str::limit($p->deskripsi, 40),
                'tanggal'      => $p->created_at,
                'status'       => $p->status,
            ]);

        return view('CRUD.dashboard', compact('stats', 'chartData', 'recent_announcements', 'recent_surat', 'recent_pengaduan'));
    }
}
