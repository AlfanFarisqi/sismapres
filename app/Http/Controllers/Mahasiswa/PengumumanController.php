<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Tanggal pengumuman hasil seleksi.
     */
    const TANGGAL_PENGUMUMAN = '2026-06-03';

    public function index()
    {
        $sekarang = date('Y-m-d');
        $sudahDiumumkan = $sekarang >= self::TANGGAL_PENGUMUMAN;
        $tanggalPengumuman = self::TANGGAL_PENGUMUMAN;

        if ($sudahDiumumkan) {
            session()->reflash();
            return redirect()->route('mahasiswa.hasil.index');
        }

        return view('mahasiswa.pengumuman', compact('sudahDiumumkan', 'tanggalPengumuman'));
    }
}
