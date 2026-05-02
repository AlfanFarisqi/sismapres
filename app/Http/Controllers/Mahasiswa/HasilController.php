<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\HasilSeleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilController extends Controller
{
    /**
     * Tanggal pengumuman hasil seleksi (Sama dengan di PengumumanController).
     */
    const TANGGAL_PENGUMUMAN = '2026-06-30';

    private function getMahasiswa()
    {
        return Mahasiswa::where('user_id', Auth::id())->first();
    }

    public function index()
    {
        $sekarang = date('Y-m-d');
        if ($sekarang < self::TANGGAL_PENGUMUMAN) {
            return redirect()->route('mahasiswa.pengumuman')->with('warning', 'Hasil seleksi belum diumumkan.');
        }

        $mahasiswa = $this->getMahasiswa();
        $hasil = $mahasiswa ? HasilSeleksi::where('mahasiswa_id', $mahasiswa->id)->first() : null;
        $hasilSeleksi = HasilSeleksi::with('mahasiswa')->orderBy('ranking')->get();
        
        return view('mahasiswa.hasil', compact('mahasiswa', 'hasil', 'hasilSeleksi'));
    }

    public function data()
    {
        $mahasiswa = $this->getMahasiswa();

        if (!$mahasiswa) {
            return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan.']);
        }

        $hasil = HasilSeleksi::where('mahasiswa_id', $mahasiswa->id)->first();

        return response()->json(['success' => true, 'data' => $hasil]);
    }
}
