<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $filename = null;
        // Jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $filename);
        }
        // // Menyimpan data ke dalam database menggunakan User::create()
        User::create([
            'role_id' => 1,
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,       
            'status' => $request->status,
            'foto' => $filename,
        ]);
        return redirect('users.store')->with('success', 'Selamat Datang ' . $request->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:users,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'status' => 'required|in:aktif,tidak aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // if($request->hasFile('foto')) {
        //     $validated['foto'] = $request->file('foto')->store('images');
        // }
        // if($request->filled('password')) {
        //     $validated['password'] = Hash::make($validated->password);
        // }

        User::findOrFail($id)->update([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,       
            'status' => $request->status,
            // 'foto' => $filename,
        ]);

        return redirect()->route('users.index')->with('success', 'Selamat Datang ' . $request->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->route('users.index')->with('success', 'Data Penyewa berhasil ditambahkan');
    }
}
