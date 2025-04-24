<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userRole = Auth::user()->role_id;
            if($userRole  == 1){
                return redirect()->intended('/dashboard');
            } elseif($userRole  == 2){
                return redirect()->intended('/home');
            }
        }
        return back()->withErrors([
            'email' => 'Terjadi kesalahan, silahkan coba lagi.',
        ])->onlyInput('email');

    }
}
