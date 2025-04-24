<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
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
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nik' => 'required|unique:users,nik',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);

        $user = new User();
        
        // Handle file upload for foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto'), $fileName);
            $user->foto = $fileName;
        }

        $user->nik = $request->nik;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->alamat = $request->alamat;
        $user->status = $request->status;

        // Default password handling
        $user->password = Hash::make('passworddefault123');
    
        $user->save();
    
        return redirect('/admin/users')->with('success', 'Data Berhasil Ditambahkan');
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
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nik' => ['required', 'size:16'],
            'phone' => 'required',
            'alamat' => 'required',
        ]);

        if($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images');
        }
        if($request->filled('password')) {
            $validated['password'] = Hash::make($validated->password);
        }
        User::findOrFail($id)->update($validated);
        return redirect('/admin/users')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('/admin/users')->with('success', 'Data Berhasil Dihapus');
    }
}
