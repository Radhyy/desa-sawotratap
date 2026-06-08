<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class PengajuanSuratController extends Controller
{
    private const REQUIRES_KADES = [
        'Surat Pengantar Nikah',
        'Surat Keterangan Ahli Waris',
        'Surat Keterangan Tanah',
        'Surat Hibah Tanah',
        'Surat Pernyataan Penguasaan Fisik Tanah',
        'Surat Rekomendasi tertentu'
    ];

    public function index()
    {
        $pengajuanSurats = PengajuanSurat::latest()->paginate(10);
        return view('CRUD.pengajuan-surat.index', compact('pengajuanSurats'));
    }

    public function show(PengajuanSurat $pengajuanSurat)
    {
        $pengajuanSurat->load(['user', 'dokumen']);
        return view('CRUD.pengajuan-surat.show', compact('pengajuanSurat'));
    }

    public function updateStatus(Request $request, PengajuanSurat $pengajuanSurat)
    {
        $request->validate([
            'action' => 'required|in:proses,selesai,tolak',
            'catatan_admin' => 'nullable|string'
        ]);

        $action = $request->action;
        $status = $pengajuanSurat->status;

        if ($action === 'tolak') {
            $status = 'ditolak';
        } elseif ($action === 'selesai') {
            $status = 'selesai';
        } elseif ($action === 'proses') {
            // Check if it needs kades approval
            if (in_array($pengajuanSurat->jenis_surat, self::REQUIRES_KADES)) {
                $status = 'menunggu_kades';
            } else {
                $status = 'diproses'; // Or 'selesai' depending on flow, let's keep 'diproses' and they can manually 'selesai' it
            }
        }

        $pengajuanSurat->update([
            'status' => $status,
            'catatan_admin' => $request->catatan_admin ?? $pengajuanSurat->catatan_admin
        ]);

        return redirect()->route('admin.pengajuan-surat.show', $pengajuanSurat)
            ->with('success', 'Status pengajuan berhasil diperbarui menjadi: ' . $pengajuanSurat->status_label);
    }
}
