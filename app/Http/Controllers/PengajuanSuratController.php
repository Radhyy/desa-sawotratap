<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\PengajuanSuratDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengajuan-surat.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'no_kk' => 'required|string|size:16',
            'no_whatsapp' => 'required|string|max:15',
            'jenis_surat' => 'required|string',
            'tanggal_pengambilan' => 'required|date|after:today',
            'keperluan' => 'required|string',
            'dokumen.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nik.required' => 'NIK harus diisi',
            'nik.size' => 'NIK harus 16 digit',
            'no_kk.required' => 'No. KK harus diisi',
            'no_kk.size' => 'No. KK harus 16 digit',
            'no_whatsapp.required' => 'No. WhatsApp harus diisi',
            'jenis_surat.required' => 'Jenis surat harus dipilih',
            'tanggal_pengambilan.required' => 'Tanggal pengambilan harus diisi',
            'tanggal_pengambilan.after' => 'Tanggal pengambilan harus setelah hari ini',
            'keperluan.required' => 'Keperluan harus diisi',
            'dokumen.*.mimes' => 'Dokumen harus berformat PDF, JPG, JPEG, atau PNG',
            'dokumen.*.max' => 'Ukuran dokumen maksimal 2MB'
        ]);

        DB::beginTransaction();
        try {
            // Simpan data pengajuan surat
            $pengajuan = PengajuanSurat::create([
                'nama_lengkap' => $validated['nama_lengkap'],
                'nik' => $validated['nik'],
                'no_kk' => $validated['no_kk'],
                'no_whatsapp' => $validated['no_whatsapp'],
                'jenis_surat' => $validated['jenis_surat'],
                'tanggal_pengambilan' => $validated['tanggal_pengambilan'],
                'keperluan' => $validated['keperluan'],
                'status' => 'pending',
                'user_id' => auth()->id()
            ]);

            // Simpan dokumen pendukung jika ada
            if ($request->hasFile('dokumen')) {
                foreach ($request->file('dokumen') as $file) {
                    $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $filepath = $file->storeAs('pengajuan-surat', $filename, 'public');

                    PengajuanSuratDokumen::create([
                        'pengajuan_surat_id' => $pengajuan->id,
                        'filename' => $file->getClientOriginalName(),
                        'filepath' => $filepath,
                        'file_type' => $file->getClientMimeType(),
                        'file_size' => $file->getSize()
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('pengajuan-surat.index')
                ->with('success', 'Pengajuan surat berhasil dikirim. Kami akan segera memprosesnya.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanSurat $pengajuanSurat)
    {
        $pengajuanSurat->load('dokumen');
        return view('pengajuan-surat.show', compact('pengajuanSurat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanSurat $pengajuanSurat)
    {
        return view('pengajuan-surat.edit', compact('pengajuanSurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanSurat $pengajuanSurat)
    {
        // Only allow update if status is still pending
        if ($pengajuanSurat->status !== 'pending') {
            return redirect()->back()->with('error', 'Pengajuan yang sudah diproses tidak dapat diubah.');
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'no_kk' => 'required|string|size:16',
            'no_whatsapp' => 'required|string|max:15',
            'jenis_surat' => 'required|string',
            'tanggal_pengambilan' => 'required|date|after:today',
            'keperluan' => 'required|string',
        ]);

        $pengajuanSurat->update($validated);

        return redirect()->route('pengajuan-surat.show', $pengajuanSurat)
            ->with('success', 'Pengajuan surat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanSurat $pengajuanSurat)
    {
        // Only allow delete if status is pending
        if ($pengajuanSurat->status !== 'pending') {
            return redirect()->back()->with('error', 'Pengajuan yang sudah diproses tidak dapat dihapus.');
        }

        // Delete dokumen files
        foreach ($pengajuanSurat->dokumen as $dokumen) {
            Storage::disk('public')->delete($dokumen->filepath);
        }

        $pengajuanSurat->delete();

        return redirect()->route('pengajuan-surat.index')
            ->with('success', 'Pengajuan surat berhasil dihapus.');
    }

    /**
     * Delete dokumen
     */
    public function deleteDokumen(PengajuanSuratDokumen $dokumen)
    {
        Storage::disk('public')->delete($dokumen->filepath);
        $dokumen->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
