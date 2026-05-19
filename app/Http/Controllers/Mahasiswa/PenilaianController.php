<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use App\Models\DetailPenilaian;
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
        if ($mahasiswa && $mahasiswa->is_dinilai) {
            $penilaians = Penilaian::where('mahasiswa_id', $mahasiswa->id)->pluck('nilai', 'kriteria_id');
        } elseif ($mahasiswa) {
            $penilaians = DetailPenilaian::where('mahasiswa_id', $mahasiswa->id)->pluck('nilai', 'kriteria_id');
        } else {
            $penilaians = collect();
        }
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

        // Validasi input
        $request->validate([
            'ipk' => 'required|numeric|min:0|max:4',
            'jenis_prestasi' => 'required|string',
            'tingkat_prestasi' => 'required|numeric',
            'nama_lomba' => 'required|string',
            'tahun_prestasi' => 'required|numeric',
            'file_prestasi' => 'required|file|mimes:pdf|max:2048',
            'nama_organisasi' => 'required|string',
            'jabatan_organisasi' => 'required|numeric',
            'lama_aktif' => 'required|string',
            'file_organisasi' => 'required|file|mimes:pdf|max:2048',
            'pengalaman_komunikasi' => 'required|string',
            'judul_inovasi' => 'required|string',
            'deskripsi_inovasi' => 'required|string',
            'jenis_inovasi' => 'required|numeric',
            'file_inovasi' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Simpan Berkas
        $files = [
            'Sertifikat Prestasi - ' . $request->nama_lomba => $request->file('file_prestasi'),
            'Surat Organisasi - ' . $request->nama_organisasi => $request->file('file_organisasi'),
            'Proposal Inovasi - ' . $request->judul_inovasi => $request->file('file_inovasi'),
        ];

        foreach ($files as $namaBerkas => $file) {
            if ($file) {
                $filename = $mahasiswa->npm . '_' . time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('berkas', $filename, 'public');

                \App\Models\Berkas::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'nama_berkas' => $namaBerkas,
                    'file_path' => $path,
                ]);
            }
        }

        // Mapping nilai ke skor
        $ipk = $request->ipk;
        if ($ipk > 3.75) $skorIpk = 5;
        elseif ($ipk >= 3.50) $skorIpk = 4;
        elseif ($ipk >= 3.25) $skorIpk = 3;
        elseif ($ipk >= 3.00) $skorIpk = 2;
        else $skorIpk = 1;

        $nilaiArray = [
            1 => [
                'skor' => $skorIpk,
                'ket' => 'IPK: ' . $request->ipk
            ],
            2 => [
                'skor' => $request->tingkat_prestasi,
                'ket' => 'Jenis: ' . $request->jenis_prestasi . ', Nama Lomba: ' . $request->nama_lomba . ', Tahun: ' . $request->tahun_prestasi
            ],
            3 => [
                'skor' => $request->jabatan_organisasi,
                'ket' => 'Nama Organisasi: ' . $request->nama_organisasi . ', Jabatan: ' . ($request->jabatan_organisasi == 5 ? 'Ketua' : ($request->jabatan_organisasi == 4 ? 'Pengurus' : 'Anggota')) . ', Lama Aktif: ' . $request->lama_aktif
            ],
            4 => [
                'skor' => 3,
                'ket' => 'Pengalaman: ' . $request->pengalaman_komunikasi
            ],
            5 => [
                'skor' => $request->jenis_inovasi,
                'ket' => 'Judul: ' . $request->judul_inovasi . ', Deskripsi: ' . $request->deskripsi_inovasi . ', Jenis: ' . ($request->jenis_inovasi == 5 ? 'Produk' : ($request->jenis_inovasi == 4 ? 'Proposal' : 'Ide'))
            ],
        ];

        foreach ($nilaiArray as $kriteriaId => $data) {
            DetailPenilaian::updateOrCreate(
                [
                    'mahasiswa_id' => $mahasiswa->id,
                    'kriteria_id' => $kriteriaId,
                ],
                [
                    'nilai' => $data['skor'],
                    'keterangan' => $data['ket'],
                ]
            );
        }

        return redirect()->route('mahasiswa.pengumuman')->with('success', 'Data penilaian dan berkas berhasil disimpan.');
    }
}
