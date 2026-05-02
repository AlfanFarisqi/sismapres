<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private function getMahasiswa()
    {
        return Mahasiswa::where('user_id', Auth::id())->first();
    }

    public function index()
    {
        $mahasiswa = Mahasiswa::with('berkas')->where('user_id', Auth::id())->first();
        return view('mahasiswa.profile', compact('mahasiswa'));
    }

    public function update(Request $request)
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
            $mahasiswa = Mahasiswa::create([
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'npm' => $request->npm,
                'tingkat' => $request->tingkat,
                'email' => Auth::user()->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'status_berkas' => 'belum',
            ]);
        } else {
            $mahasiswa->update($request->only(['nama', 'npm', 'tingkat', 'no_hp', 'alamat']));
        }

        return redirect()->route('mahasiswa.berkas.index')->with('success', 'Profil berhasil diperbarui. Silakan lanjut mengunggah berkas.');
    }

    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        
        // Cari atau buat record mahasiswa (sekarang aman karena fields sudah nullable)
        $mahasiswa = Mahasiswa::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama' => $user->name,
                'email' => $user->email,
                'status_berkas' => 'belum',
            ]
        );

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($mahasiswa->foto)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($mahasiswa->foto);
            }

            $path = $request->file('foto')->store('fotos', 'public');
            $mahasiswa->foto = $path;
            $mahasiswa->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diunggah.');
    }
}
