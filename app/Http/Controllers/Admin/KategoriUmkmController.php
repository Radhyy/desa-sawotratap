<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriUmkmController extends Controller
{
    public function index()
    {
        $categories = KategoriUmkm::withCount('umkm')->latest()->get();
        return view('CRUD.kategori-umkm.index', compact('categories'));
    }

    public function create()
    {
        return view('CRUD.kategori-umkm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:kategori_umkms,name'
        ]);

        KategoriUmkm::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.kategori-umkm.index')
            ->with('success', 'Kategori UMKM berhasil ditambahkan!');
    }

    public function edit(KategoriUmkm $kategori_umkm)
    {
        return view('CRUD.kategori-umkm.edit', compact('kategori_umkm'));
    }

    public function update(Request $request, KategoriUmkm $kategori_umkm)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:kategori_umkms,name,' . $kategori_umkm->id
        ]);

        $kategori_umkm->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('admin.kategori-umkm.index')
            ->with('success', 'Kategori UMKM berhasil diperbarui!');
    }

    public function destroy(KategoriUmkm $kategori_umkm)
    {
        if ($kategori_umkm->umkm()->count() > 0) {
            return redirect()->route('admin.kategori-umkm.index')
                ->with('error', 'Kategori ini tidak bisa dihapus karena masih memiliki produk UMKM terkait.');
        }

        $kategori_umkm->delete();

        return redirect()->route('admin.kategori-umkm.index')
            ->with('success', 'Kategori UMKM berhasil dihapus!');
    }
}
