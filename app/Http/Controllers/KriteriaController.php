<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $kriterias = Kriteria::when($search, function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%');
        })->get();

        return view('admin.kriteria.index', compact('kriterias', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:100',
            'jenis' => 'required|in:benefit,cost',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:100',
            'jenis' => 'required|in:benefit,cost',
        ]);

        $kriteria->update($request->all());

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
