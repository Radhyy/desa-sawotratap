<?php

namespace App\Http\Controllers\Kades;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::whereIn('status', ['Menunggu Kades', 'Diproses', 'Selesai', 'Ditolak'])
            ->latest()
            ->paginate(10);
            
        return view('CRUD.kades.pengaduan.index', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan)
    {
        if (!in_array($pengaduan->status, ['Menunggu Kades', 'Diproses', 'Selesai', 'Ditolak'])) {
            abort(404);
        }
        return view('CRUD.kades.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        if (!in_array($pengaduan->status, ['Menunggu Kades', 'Diproses', 'Selesai', 'Ditolak'])) {
            abort(404);
        }

        $request->validate([
            'action'        => 'required|in:setujui,tolak',
            'catatan_kades' => 'nullable|string',
        ]);

        $status = $request->action === 'setujui' ? 'Diproses' : 'Ditolak';

        $pengaduan->update([
            'status'        => $status,
            'catatan_kades' => $request->catatan_kades ?? $pengaduan->catatan_kades,
        ]);

        return redirect()->route('kades.pengaduan.show', $pengaduan)
            ->with('success', 'Tanggapan Kepala Desa berhasil disimpan.');
    }
}
