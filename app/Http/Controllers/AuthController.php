<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginId = $request->username ?: $request->email;
        if ($loginId == 'admin123' && $request->password == 'admin123') {
            session(['role' => 'admin']);
            return redirect('/admin');
        } else {
            session(['role' => 'mahasiswa']);
            return redirect('/mahasiswa');
        }
    }
}
