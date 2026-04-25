<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        // Logika untuk mengisi konten sidebar secara dinamis
        $sidebarData = [
            'name' => $user->name,
            'role' => strtoupper($user->role),
            'avatar' => "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=355872&color=fff"
        ];

        // Jika role adalah mahasiswa, kita bisa mengambil data tambahan dari tabel mahasiswas
        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            if ($mahasiswa) {
                $sidebarData['name'] = $mahasiswa->nama;
                $sidebarData['npm'] = $mahasiswa->npm;
            }
        }

        return view('admin.dashboard', compact('sidebarData'));
    }

    public function mahasiswa()
    {
        $mahasiswas = Mahasiswa::all();
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function uploadBerkas()
    {
        $mahasiswas = Mahasiswa::with('berkas')->get();
        return view('admin.upload-berkas.index', compact('mahasiswas'));
    }

    public function verifikasiBerkas(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'status' => 'required|in:lolos,tidak_lolos'
        ]);

        $mahasiswa->update([
            'status_berkas' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status berkas berhasil diperbarui.');
    }

    public function hasilSeleksi()
    {
        $hasilSeleksi = \App\Models\HasilSeleksi::with('mahasiswa')->orderBy('ranking')->get();
        $tidakLolos = Mahasiswa::where('status_berkas', 'tidak_lolos')->get();
        
        return view('admin.hasil-seleksi.index', compact('hasilSeleksi', 'tidakLolos'));
    }

    public function manajemenUser()
    {
        return view('admin.manajemen-user.index');
    }
}
