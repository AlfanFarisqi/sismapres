<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        $kriterias = Kriteria::all();
        
        // Ambil data penilaian yang dikelompokkan berdasarkan mahasiswa
        $penilaians = Penilaian::with(['mahasiswa', 'kriteria'])->get()->groupBy('mahasiswa_id');

        return view('admin.data-penilaian.input', compact('mahasiswas', 'kriterias', 'penilaians'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'nilai' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

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

            DB::commit();
            return redirect()->back()->with('success', 'Penilaian berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
