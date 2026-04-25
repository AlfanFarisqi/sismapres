<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        
        // Find or create Mahasiswa record for this user
        $mahasiswa = Mahasiswa::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama' => $user->name,
                'email' => $user->email,
                'status_berkas' => 'belum',
            ]
        );

        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }

            $path = $request->file('foto')->store('fotos', 'public');
            $mahasiswa->foto = $path;
            $mahasiswa->save();
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diunggah.');
    }
}
