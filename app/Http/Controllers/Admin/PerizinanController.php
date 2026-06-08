<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perizinan;
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    // Jenis izin yang butuh Kepala Desa
    private const REQUIRES_KADES = [
        'Izin Keramaian Kegiatan Warga',
        'Izin Penggunaan Fasilitas Desa',
        'Rekomendasi Kegiatan Sosial',
    ];

    public function index()
    {
        $perizinans = Perizinan::with('user')->latest()->paginate(10);
        return view('CRUD.perizinan.index', compact('perizinans'));
    }

    public function show(Perizinan $perizinan)
    {
        $perizinan->load('user');
        return view('CRUD.perizinan.show', compact('perizinan'));
    }

    public function updateStatus(Request $request, Perizinan $perizinan)
    {
        $request->validate([
            'action'        => 'required|in:proses,selesai,tolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $action = $request->action;

        if ($action === 'tolak') {
            $status = 'ditolak';
        } elseif ($action === 'selesai') {
            $status = 'selesai';
        } elseif ($action === 'proses') {
            // Cek apakah butuh Kades
            $status = in_array($perizinan->jenis_izin, self::REQUIRES_KADES)
                ? 'menunggu_kades'
                : 'diproses';
        }

        $perizinan->update([
            'status'        => $status,
            'catatan_admin' => $request->catatan_admin ?? $perizinan->catatan_admin,
        ]);

        return redirect()->route('admin.perizinan.show', $perizinan)
            ->with('success', 'Status perizinan berhasil diperbarui.');
    }
}
