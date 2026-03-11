<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profil.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama harus berupa teks',
            'name.max' => 'Nama maksimal 255 karakter',
        ]);

        $user = Auth::user();
        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }

    public function showResetPassword()
    {
        return view('profil.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini harus diisi',
            'new_password.required' => 'Password baru harus diisi',
            'new_password.min' => 'Password minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak sesuai',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        $user->update(['password' => Hash::make($validated['new_password'])]);

        return redirect()->route('profile.index')->with('success', 'Password berhasil direset!');
    }
}
