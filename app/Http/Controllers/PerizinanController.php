<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PerizinanController extends Controller
{
    public function index()
    {
        return view('perizinan.index');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengajukan perizinan.');
        }

        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik'          => 'required|string|size:16',
            'jenis_izin'   => 'required|string|max:255',
            'keterangan'   => 'required|string',
            'lampiran'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'nama_pemohon.required' => 'Nama pemohon wajib diisi.',
            'nik.required'          => 'NIK wajib diisi.',
            'nik.size'              => 'NIK harus berisi tepat 16 digit angka.',
            'jenis_izin.required'   => 'Jenis izin wajib dipilih.',
            'keterangan.required'   => 'Keterangan/keperluan wajib diisi secara detail.',
            'lampiran.mimes'        => 'Format lampiran harus berupa PDF, JPG, atau PNG.',
            'lampiran.max'          => 'Ukuran maksimal lampiran adalah 5 MB.',
        ]);

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('perizinan', 'public');
        }

        $nomor_izin = 'IZIN-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        Perizinan::create([
            'user_id'       => Auth::id(),
            'nomor_izin'    => $nomor_izin,
            'nama_pemohon'  => $validated['nama_pemohon'],
            'nik'           => $validated['nik'],
            'jenis_izin'    => $validated['jenis_izin'],
            'keterangan'    => $validated['keterangan'],
            'lampiran_path' => $lampiranPath,
            'status'        => 'menunggu_admin',
        ]);

        return redirect()->route('perizinan.index')->with('success', 'Pengajuan perizinan berhasil dikirim. Nomor tiket Anda: ' . $nomor_izin);
    }
}
