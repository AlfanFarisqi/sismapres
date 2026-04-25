<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    use \App\Traits\TopsisCalculator;

    public function index()
    {
        $mahasiswas = Mahasiswa::with('berkas')->where('status_berkas', 'lolos')->get();
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

        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        if ($mahasiswa->status_berkas !== 'lolos') {
            return redirect()->back()->with('error', 'Penilaian gagal: Mahasiswa ini belum lolos verifikasi administrasi/berkas.');
        }

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

            // Jalankan perhitungan TOPSIS secara otomatis
            $this->calculateTopsis();

            DB::commit();
            return redirect()->back()->with('success', 'Penilaian berhasil disimpan dan peringkat telah diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
