<?php

namespace App\Http\Controllers\Kades;

use App\Http\Controllers\Controller;
use App\Models\Perizinan;
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    public function index()
    {
        $perizinans = Perizinan::whereIn('status', ['menunggu_kades', 'selesai', 'ditolak'])
            ->latest()
            ->paginate(10);
            
        return view('CRUD.kades.perizinan.index', compact('perizinans'));
    }

    public function show(Perizinan $perizinan)
    {
        if (!in_array($perizinan->status, ['menunggu_kades', 'selesai', 'ditolak'])) {
            abort(404);
        }
        return view('CRUD.kades.perizinan.show', compact('perizinan'));
    }

    public function updateStatus(Request $request, Perizinan $perizinan)
    {
        if (!in_array($perizinan->status, ['menunggu_kades', 'selesai', 'ditolak'])) {
            abort(404);
        }

        $request->validate([
            'action'        => 'required|in:selesai,tolak',
            'catatan_kades' => 'nullable|string',
        ]);

        $status = $request->action === 'selesai' ? 'selesai' : 'ditolak';

        $perizinan->update([
            'status'        => $status,
            'catatan_kades' => $request->catatan_kades ?? $perizinan->catatan_kades,
        ]);

        return redirect()->route('kades.perizinan.show', $perizinan)
            ->with('success', 'Status perizinan berhasil diperbarui oleh Kepala Desa.');
    }
}
