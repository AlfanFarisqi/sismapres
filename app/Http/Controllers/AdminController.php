<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        // Stats
        $countMahasiswa = Mahasiswa::count();
        $countKriteria = \App\Models\Kriteria::count();
        $countPenilaian = \App\Models\Penilaian::distinct('mahasiswa_id')->count();
        $countUser = \App\Models\User::count();
        $countLolosVerif = Mahasiswa::where('status_berkas', 'lolos')->count();
        $countSudahDinilai = Mahasiswa::whereHas('penilaians')->count();

        // Top 3 Ranking
        $topRankings = \App\Models\HasilSeleksi::with('mahasiswa')
            ->orderBy('ranking')
            ->take(3)
            ->get();

        // Chart Data (Average Score per Criteria)
        $kriterias = \App\Models\Kriteria::all();
        $chartData = [];
        foreach ($kriterias as $index => $k) {
            $avg = \App\Models\Penilaian::where('kriteria_id', $k->id)->avg('nilai') ?: 0;
            // Assuming max score is 5, convert to percentage
            $percentage = ($avg / 5) * 100;
            $chartData[] = [
                'label' => 'C' . ($index + 1),
                'name' => $k->nama,
                'percentage' => round($percentage),
                'avg' => round($avg, 2)
            ];
        }

        // Logika untuk mengisi konten sidebar secara dinamis
        $sidebarData = [
            'name' => $user->name,
            'role' => strtoupper($user->role),
            'avatar' => "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&background=355872&color=fff"
        ];

        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
            if ($mahasiswa) {
                $sidebarData['name'] = $mahasiswa->nama;
                $sidebarData['npm'] = $mahasiswa->npm;
            }
        }

        return view('admin.dashboard', compact(
            'sidebarData', 
            'countMahasiswa', 
            'countKriteria', 
            'countPenilaian', 
            'countUser', 
            'countLolosVerif', 
            'countSudahDinilai',
            'topRankings',
            'chartData'
        ));
    }

    public function mahasiswa()
    {
        $mahasiswas = Mahasiswa::all();
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function uploadBerkas(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $mahasiswas = Mahasiswa::with('berkas')
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('npm', 'like', '%' . $search . '%');
            })
            ->when($status, function ($query) use ($status) {
                if ($status === 'pending') {
                    $query->whereNotIn('status_berkas', ['lolos', 'tidak_lolos'])
                          ->orWhereNull('status_berkas');
                } else {
                    $query->where('status_berkas', $status);
                }
            })
            ->get();

        return view('admin.upload-berkas.index', compact('mahasiswas', 'search', 'status'));
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

    public function hasilSeleksi(Request $request)
    {
        $search = $request->search;

        $hasilSeleksi = \App\Models\HasilSeleksi::with('mahasiswa')
            ->whereHas('mahasiswa', function($query) use ($search) {
                if ($search) {
                    $query->where('nama', 'like', '%' . $search . '%')
                          ->orWhere('npm', 'like', '%' . $search . '%');
                }
            })
            ->orderBy('ranking')
            ->get();

        $tidakLolos = Mahasiswa::where('status_berkas', 'tidak_lolos')
            ->when($search, function($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('npm', 'like', '%' . $search . '%');
                });
            })
            ->get();
        
        return view('admin.hasil-seleksi.index', compact('hasilSeleksi', 'tidakLolos', 'search'));
    }

    public function manajemenUser(Request $request)
    {
        $search = $request->search;
        $role = $request->role;

        $users = \App\Models\User::when($search, function($query) use ($search) {
                $query->where('email', 'like', '%' . $search . '%')
                      ->orWhere('name', 'like', '%' . $search . '%')
                      ->orWhere('username', 'like', '%' . $search . '%');
            })
            ->when($role, function($query) use ($role) {
                $query->where('role', $role);
            })
            ->get();

        return view('admin.manajemen-user.index', compact('users', 'search', 'role'));
    }

    public function updateUser(Request $request, \App\Models\User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,mahasiswa',
            'password' => 'nullable|string|min:8'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.manajemen-user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser(\App\Models\User $user)
    {
        // Jangan biarkan admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.manajemen-user.index')->with('success', 'User berhasil dihapus.');
    }
}
