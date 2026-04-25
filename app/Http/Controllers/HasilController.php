<?php

namespace App\Http\Controllers;

use App\Models\HasilSeleksi;
use App\Models\Mahasiswa;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    use \App\Traits\TopsisCalculator;

    public function index()
    {
        return HasilSeleksi::with('mahasiswa')->orderBy('ranking')->get();
    }

    public function calculate()
    {
        if ($this->calculateTopsis()) {
            return response()->json(['message' => 'Perhitungan TOPSIS berhasil diselesaikan']);
        }
        
        return response()->json(['message' => 'Data mahasiswa atau kriteria kosong'], 400);
    }
}
