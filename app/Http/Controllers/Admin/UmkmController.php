<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Display a listing of UMKM
     */
    public function index()
    {
        $umkm = Umkm::latest()->paginate(10);
        return view('CRUD.umkm.index', compact('umkm'));
    }

    /**
     * Show the form for creating a new UMKM
     */
    public function create()
    {
        return view('CRUD.umkm.create');
    }

    /**
     * Store a newly created UMKM
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Kuliner,Kerajinan',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'seller' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('umkm', 'public');
        }

        Umkm::create($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Produk UMKM berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified UMKM
     */
    public function edit(Umkm $umkm)
    {
        return view('CRUD.umkm.edit', compact('umkm'));
    }

    /**
     * Update the specified UMKM
     */
    public function update(Request $request, Umkm $umkm)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:Kuliner,Kerajinan',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'seller' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($umkm->image && Storage::disk('public')->exists($umkm->image)) {
                Storage::disk('public')->delete($umkm->image);
            }
            $validated['image'] = $request->file('image')->store('umkm', 'public');
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Produk UMKM berhasil diperbarui!');
    }

    /**
     * Remove the specified UMKM
     */
    public function destroy(Umkm $umkm)
    {
        // Delete image if exists
        if ($umkm->image && Storage::disk('public')->exists($umkm->image)) {
            Storage::disk('public')->delete($umkm->image);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Produk UMKM berhasil dihapus!');
    }
}
