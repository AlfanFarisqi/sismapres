<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    private function getMahasiswa()
    {
        return Mahasiswa::where('user_id', Auth::id())->first();
    }

    public function index()
    {
        $mahasiswa = $this->getMahasiswa();
        $penilaians = $mahasiswa ? Penilaian::where('mahasiswa_id', $mahasiswa->id)->pluck('nilai', 'kriteria_id') : collect();
        $kriterias = \App\Models\Kriteria::all();
        
        return view('mahasiswa.penilaian', compact('mahasiswa', 'penilaians', 'kriterias'));
    }

    public function data()
    {
        $mahasiswa = $this->getMahasiswa();

        if (!$mahasiswa) {
            return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan.']);
        }

        $penilaians = Penilaian::with('kriteria')
                                ->where('mahasiswa_id', $mahasiswa->id)
                                ->get();

        return response()->json(['success' => true, 'data' => $penilaians]);
    }

    
    public function store(Request $request)
    {
        $mahasiswa = $this->getMahasiswa();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Silakan lengkapi profil terlebih dahulu.');
        }

        // Validasi input nilai kriteria
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric',
        ]);

        foreach ($request->nilai as $kriteriaId => $nilai) {
            Penilaian::updateOrCreate(
                [
                    'mahasiswa_id' => $mahasiswa->id,
                    'kriteria_id' => $kriteriaId,
                ],
                [
                    'nilai' => $nilai,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data penilaian berhasil disimpan.');
    }
}
