<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest('published_at')->paginate(10);
        return view('CRUD.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('CRUD.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'author'       => 'nullable|string|max:100',
            'published_at' => 'required|date',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'image_url'    => 'nullable|url',
        ]);

        // Handle image: uploaded file takes priority over URL
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('galeri', 'public');
        } elseif (!empty($request->image_url)) {
            $validated['image'] = $request->image_url;
        } else {
            unset($validated['image']);
        }
        unset($validated['image_url']);

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function edit(Galeri $galeri)
    {
        return view('CRUD.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'author'       => 'nullable|string|max:100',
            'published_at' => 'required|date',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'image_url'    => 'nullable|url',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old local file if exists
            if ($galeri->image && !str_starts_with($galeri->image, 'http')) {
                Storage::disk('public')->delete($galeri->image);
            }
            $validated['image'] = $request->file('image')->store('galeri', 'public');
        } elseif (!empty($request->image_url)) {
            if ($galeri->image && !str_starts_with($galeri->image, 'http')) {
                Storage::disk('public')->delete($galeri->image);
            }
            $validated['image'] = $request->image_url;
        } else {
            // Keep existing image
            unset($validated['image']);
        }
        unset($validated['image_url']);

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->image && !str_starts_with($galeri->image, 'http')) {
            Storage::disk('public')->delete($galeri->image);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus!');
    }
}
