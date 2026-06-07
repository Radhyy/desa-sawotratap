<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest('date')->paginate(10);
        return view('CRUD.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('CRUD.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'author'   => 'required|string|max:100',
            'date'     => 'required|date',
            'excerpt'  => 'required|string',
            'content'  => 'nullable|string',
            'read_time'=> 'nullable|string|max:50',
            'trending' => 'nullable|boolean',
            'tags'     => 'nullable|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle tags (comma-separated -> array)
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $validated['trending'] = $request->has('trending') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(Berita $beritum)
    {
        return view('CRUD.berita.edit', ['berita' => $beritum]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'author'   => 'required|string|max:100',
            'date'     => 'required|date',
            'excerpt'  => 'required|string',
            'content'  => 'nullable|string',
            'read_time'=> 'nullable|string|max:50',
            'trending' => 'nullable|boolean',
            'tags'     => 'nullable|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $validated['trending'] = $request->has('trending') ? true : false;

        if ($request->hasFile('image')) {
            if ($beritum->image) {
                Storage::disk('public')->delete($beritum->image);
            }
            $validated['image'] = $request->file('image')->store('berita', 'public');
        }

        $beritum->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->image) {
            Storage::disk('public')->delete($beritum->image);
        }

        $beritum->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
