<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $mahasiswas = Mahasiswa::when($search, function ($query) use ($search) {
            $query->where('nama', 'like', '%' . $search . '%')
                ->orWhere('npm', 'like', '%' . $search . '%');
        })->get();
        return view('admin.mahasiswa.index', compact('mahasiswas', 'search'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|unique:mahasiswas,npm,' . $mahasiswa->id,
            'tingkat' => 'required|integer',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        $mahasiswa->update($validated);
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
