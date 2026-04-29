<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Berkas;
use App\Models\HasilSeleksi;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaDashboardController extends Controller
{
    /**
     * Dapatkan data mahasiswa yang sedang login.
     */
    private function getMahasiswa()
    {
        return Mahasiswa::where('user_id', Auth::id())->first();
    }

    /**
     * Tampilkan halaman profil mahasiswa.
     */
    public function showProfile()
    {
        $mahasiswa = Mahasiswa::with('berkas')->where('user_id', Auth::id())->first();
        return view('mahasiswa.profile', compact('mahasiswa'));
    }

    /**
     * Tampilkan halaman daftar berkas yang sudah diunggah.
     */
    public function showBerkas()
    {
        $mahasiswa = $this->getMahasiswa();
        $berkas = $mahasiswa ? $mahasiswa->berkas : [];
        
        return view('mahasiswa.berkas', compact('mahasiswa', 'berkas'));
    }

    /**
     * Update profil mahasiswa (Tingkat, NPM, No HP, Alamat, dll).
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:50',
            'tingkat' => 'required|integer|min:1',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $mahasiswa = $this->getMahasiswa();

        if (!$mahasiswa) {
            // Jika data mahasiswa belum ada, buat baru
            $mahasiswa = Mahasiswa::create([
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'email' => Auth::user()->email,
                'status_berkas' => 'belum',
            ]);
        }

        $mahasiswa->update($request->only(['nama', 'npm', 'tingkat', 'no_hp', 'alamat']));

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Upload berkas administrasi dan portofolio.
     */
    public function storeBerkas(Request $request)
    {
        $request->validate([
            'nama_berkas' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048', // Maksimal 2MB
        ]);

        $mahasiswa = $this->getMahasiswa();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Silakan lengkapi profil terlebih dahulu.');
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Format nama file agar rapi: npm_nama_berkas.pdf
            $filename = $mahasiswa->npm . '_' . str_replace(' ', '_', $request->nama_berkas) . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Simpan ke storage public/berkas
            $path = $file->storeAs('berkas', $filename, 'public');

            // Cek apakah berkas dengan nama yang sama sudah ada (jika ingin mereplace)
            $existingBerkas = Berkas::where('mahasiswa_id', $mahasiswa->id)
                                    ->where('nama_berkas', $request->nama_berkas)
                                    ->first();

            if ($existingBerkas) {
                // Hapus file lama fisik
                if (Storage::disk('public')->exists($existingBerkas->file_path)) {
                    Storage::disk('public')->delete($existingBerkas->file_path);
                }
                // Update record database
                $existingBerkas->update(['file_path' => $path]);
            } else {
                // Buat record baru
                Berkas::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'nama_berkas' => $request->nama_berkas,
                    'file_path' => $path,
                ]);
            }

            return redirect()->back()->with('success', 'Berkas ' . $request->nama_berkas . ' berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah berkas.');
    }

    /**
     * Tampilkan halaman penilaian (skor dari admin).
     */
    public function showPenilaian()
    {
        $mahasiswa = $this->getMahasiswa();
        $penilaians = $mahasiswa ? Penilaian::with('kriteria')->where('mahasiswa_id', $mahasiswa->id)->get() : [];
        
        return view('mahasiswa.penilaian', compact('mahasiswa', 'penilaians'));
    }

    /**
     * Dapatkan detail penilaian dari admin (JSON).
     */
    public function getPenilaian()
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

    /**
     * Tampilkan halaman hasil seleksi.
     */
    public function showHasil()
    {
        $mahasiswa = $this->getMahasiswa();
        $hasil = $mahasiswa ? HasilSeleksi::where('mahasiswa_id', $mahasiswa->id)->first() : null;
        
        return view('mahasiswa.hasil', compact('mahasiswa', 'hasil'));
    }

    /**
     * Dapatkan hasil seleksi akhir (JSON).
     */
    public function getHasilSeleksi()
    {
        $mahasiswa = $this->getMahasiswa();

        if (!$mahasiswa) {
            return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan.']);
        }

        $hasil = HasilSeleksi::where('mahasiswa_id', $mahasiswa->id)->first();

        return response()->json(['success' => true, 'data' => $hasil]);
    }
}
