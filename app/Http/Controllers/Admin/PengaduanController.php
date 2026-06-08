<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::latest()->paginate(10);
        return view('CRUD.pengaduan.index', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('CRUD.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'action'        => 'required|in:teruskan_kades,selesai,tolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $status = $pengaduan->status;

        if ($request->action === 'teruskan_kades') {
            $status = 'Menunggu Kades';
        } elseif ($request->action === 'selesai') {
            $status = 'Selesai';
        } elseif ($request->action === 'tolak') {
            $status = 'Ditolak';
        }

        $pengaduan->update([
            'status'        => $status,
            'catatan_admin' => $request->catatan_admin ?? $pengaduan->catatan_admin,
        ]);

        return redirect()->route('admin.pengaduan.show', $pengaduan)
            ->with('success', 'Status pengaduan berhasil diperbarui menjadi: ' . $status);
    }
}
