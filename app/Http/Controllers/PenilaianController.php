<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:5',
        ]);

        foreach ($request->nilai as $kriteria_id => $skor) {
            Penilaian::updateOrCreate(
                [
                    'mahasiswa_id' => $request->mahasiswa_id,
                    'kriteria_id' => $kriteria_id,
                ],
                [
                    'nilai' => $skor,
                ]
            );
        }

        return response()->json(['message' => 'Penilaian saved successfully']);
    }
}
