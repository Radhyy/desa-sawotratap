<?php

namespace App\Http\Controllers\Kades;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        // Only show surat that are 'menunggu_kades' or have been processed by kades ('selesai', 'ditolak')
        $pengajuanSurats = PengajuanSurat::whereIn('status', ['menunggu_kades', 'selesai', 'ditolak'])
            ->latest()
            ->paginate(10);
            
        return view('CRUD.kades.pengajuan-surat.index', compact('pengajuanSurats'));
    }

    public function show(PengajuanSurat $pengajuanSurat)
    {
        $pengajuanSurat->load(['user', 'dokumen']);
        return view('CRUD.kades.pengajuan-surat.show', compact('pengajuanSurat'));
    }

    public function updateStatus(Request $request, PengajuanSurat $pengajuanSurat)
    {
        $request->validate([
            'action' => 'required|in:setujui,tolak',
            'catatan_kades' => 'nullable|string'
        ]);

        if ($request->action === 'tolak') {
            $status = 'ditolak';
            $msg = 'Pengajuan ditolak.';
        } else {
            // Jika disetujui, maka status langsung selesai (karena sudah ditandatangani elektronik)
            $status = 'selesai';
            $msg = 'Pengajuan disetujui (TTE berhasil diterbitkan).';
        }

        $pengajuanSurat->update([
            'status' => $status,
            'catatan_kades' => $request->catatan_kades
        ]);

        return redirect()->route('kades.pengajuan-surat.show', $pengajuanSurat)
            ->with('success', $msg);
    }
}
