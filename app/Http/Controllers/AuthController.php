<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // Specific logic to strictly allow email: admin123 and pass: admin123 as the ONLY way for admin
        if ($request->login === 'admin123' && $request->password === 'admin123') {
            if (Auth::attempt(['email' => 'admin123', 'password' => 'admin123'])) {
                $request->session()->regenerate();
                
                // Ensure role is admin
                if (Auth::user()->role !== 'admin') {
                    Auth::user()->update(['role' => 'admin']);
                }
                
                return redirect()->intended('/admin/dashboard');
            }
        }

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Block anyone else from being admin
            if (Auth::user()->role === 'admin' && Auth::user()->email !== 'admin123') {
                Auth::logout();
                return back()->withErrors([
                    'login' => 'Akses ditolak. Anda tidak berhak login sebagai admin.',
                ])->onlyInput('login');
            }

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                $lastPage = Auth::user()->last_page;
                return $lastPage ? redirect($lastPage) : redirect()->intended('/mahasiswa/informasi');
            }
        }

        return back()->withErrors([
            'login' => 'Email/Username atau password salah.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        if ((isset(Auth::user()->role) && Auth::user()->role === 'admin') || Auth::user()->username === 'admin123') {
            return redirect()->intended('/admin/dashboard');
        } else {
            $lastPage = Auth::user()->last_page;
            return $lastPage ? redirect($lastPage) : redirect()->intended('/mahasiswa/informasi');
        }
    }
}
