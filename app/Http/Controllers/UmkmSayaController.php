<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Umkm;
use App\Models\KategoriUmkm;

class UmkmSayaController extends Controller
{
    /**
     * Menampilkan daftar UMKM milik pengguna yang sedang login.
     */
    public function index()
    {
        $userId = Auth::id();
        $umkmSaya = Umkm::with('kategori')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('umkm-saya.index', compact('umkmSaya'));
    }

    /**
     * Menampilkan form untuk mengedit produk UMKM.
     */
    public function edit($id)
    {
        $umkm = Umkm::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $kategori_umkms = KategoriUmkm::all();
        
        return view('umkm-saya.edit', compact('umkm', 'kategori_umkms'));
    }

    /**
     * Memperbarui data UMKM milik pengguna.
     */
    public function update(Request $request, $id)
    {
        $umkm = Umkm::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'kategori_umkm_id' => 'required|exists:kategori_umkms,id',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'seller' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($umkm->image && !str_starts_with($umkm->image, 'http')) {
                Storage::disk('public')->delete($umkm->image);
            }
            $validated['image'] = $request->file('image')->store('umkm', 'public');
        }

        // Set status kembali ke pending setelah diperbarui agar admin bisa me-review ulang
        $validated['approval_status'] = 'pending';

        $umkm->update($validated);

        return redirect()->route('umkm-saya.index')->with('success', 'Produk UMKM berhasil diperbarui dan sedang menunggu peninjauan ulang oleh admin.');
    }

    /**
     * Menghapus produk UMKM milik pengguna.
     */
    public function destroy($id)
    {
        $umkm = Umkm::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Hapus gambar dari storage
        if ($umkm->image && !str_starts_with($umkm->image, 'http')) {
            Storage::disk('public')->delete($umkm->image);
        }

        $umkm->delete();

        return redirect()->route('umkm-saya.index')->with('success', 'Produk UMKM berhasil dihapus.');
    }
}
