<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apbdes;
use Illuminate\Http\Request;

class ApbdesController extends Controller
{
    public function index()
    {
        $apbdesList = Apbdes::latest()->paginate(10);
        return view('CRUD.apbdes.index', compact('apbdesList'));
    }

    public function create()
    {
        return view('CRUD.apbdes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|string|max:4',
            'target_amount' => 'required|numeric|min:0',
            'realization_amount' => 'required|numeric|min:0',
            'pie_belanja' => 'required|integer|min:0|max:100',
            'pie_pendapatan' => 'required|integer|min:0|max:100',
            'pie_pembiayaan' => 'required|integer|min:0|max:100',
            'chart_months' => 'required|string', // comma separated
            'chart_pendapatan' => 'required|string', // comma separated
            'chart_belanja' => 'required|string', // comma separated
            'chart_surplus' => 'required|string', // comma separated
        ]);

        $validated['chart_months'] = array_map('trim', explode(',', $validated['chart_months']));
        $validated['chart_pendapatan'] = array_map('intval', explode(',', $validated['chart_pendapatan']));
        $validated['chart_belanja'] = array_map('intval', explode(',', $validated['chart_belanja']));
        $validated['chart_surplus'] = array_map('intval', explode(',', $validated['chart_surplus']));

        // If no active apbdes exists, make this active
        if (!Apbdes::where('is_active', true)->exists()) {
            $validated['is_active'] = true;
        }

        Apbdes::create($validated);

        return redirect()->route('admin.apbdes.index')->with('success', 'Data APBDes berhasil ditambahkan');
    }

    public function edit(Apbdes $apbde)
    {
        return view('CRUD.apbdes.edit', compact('apbde'));
    }

    public function update(Request $request, Apbdes $apbde)
    {
        $validated = $request->validate([
            'year' => 'required|string|max:4',
            'target_amount' => 'required|numeric|min:0',
            'realization_amount' => 'required|numeric|min:0',
            'pie_belanja' => 'required|integer|min:0|max:100',
            'pie_pendapatan' => 'required|integer|min:0|max:100',
            'pie_pembiayaan' => 'required|integer|min:0|max:100',
            'chart_months' => 'required|string',
            'chart_pendapatan' => 'required|string',
            'chart_belanja' => 'required|string',
            'chart_surplus' => 'required|string',
        ]);

        $validated['chart_months'] = array_map('trim', explode(',', $validated['chart_months']));
        $validated['chart_pendapatan'] = array_map('intval', explode(',', $validated['chart_pendapatan']));
        $validated['chart_belanja'] = array_map('intval', explode(',', $validated['chart_belanja']));
        $validated['chart_surplus'] = array_map('intval', explode(',', $validated['chart_surplus']));

        $apbde->update($validated);

        return redirect()->route('admin.apbdes.index')->with('success', 'Data APBDes berhasil diperbarui');
    }

    public function destroy(Apbdes $apbde)
    {
        if ($apbde->is_active) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus APBDes yang sedang aktif. Set aktifkan APBDes lain terlebih dahulu.');
        }

        $apbde->delete();
        return redirect()->route('admin.apbdes.index')->with('success', 'Data APBDes berhasil dihapus');
    }

    public function activate(Apbdes $apbde)
    {
        Apbdes::where('is_active', true)->update(['is_active' => false]);
        $apbde->update(['is_active' => true]);

        return redirect()->back()->with('success', 'APBDes ' . $apbde->year . ' berhasil diaktifkan');
    }
}
