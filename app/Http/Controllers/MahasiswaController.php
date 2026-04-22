<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return Mahasiswa::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|unique:mahasiswas,npm',
            'tingkat' => 'required|integer',
        ]);

        return Mahasiswa::create($validated);
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return $mahasiswa;
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'npm' => 'sometimes|string|unique:mahasiswas,npm,' . $mahasiswa->id,
            'tingkat' => 'sometimes|integer',
        ]);

        $mahasiswa->update($validated);
        return $mahasiswa;
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
