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
        return view('admin.mahasiswa.index');
    }

    public function dataPenilaian()
    {
        return view('admin.data-penilaian.input');
    }

    public function uploadBerkas()
    {
        return view('admin.upload-berkas.index');
    }

    public function hasilSeleksi()
    {
        return view('admin.hasil-seleksi.index');
    }

    public function manajemenUser()
    {
        return view('admin.manajemen-user.index');
    }
}
