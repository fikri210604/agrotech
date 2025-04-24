<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;


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

    public function registerIndex(){
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'nik' => 'required|unique:users,nik',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'phone' => 'required|string|max:15',
        //     'alamat' => 'required|string|max:255',
        //     'status' => 'required|in:aktif,tidak aktif',
        //     'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        
        $filename = null;
        // Jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $filename);
        }

        User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'password' => $request->password_confirmation,    
            'foto' => $filename,
            'role_id' => 2,
        ]);
        return redirect('/login')->with('success', 'Pendaftaran berhasil, silahkan login.');
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

    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nik' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $filename = $user->foto; // default: gunakan foto lama

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && file_exists(public_path('images/' . $user->foto))) {
                unlink(public_path('images/' . $user->foto));
            }

            // Simpan foto baru
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $filename);
        }

        $user->update([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'foto' => $filename,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

}
