<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perusahaans = Perusahaan::all();
        return view('admin.perusahaan.index', compact('perusahaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi' => 'required|string|max:500',
            'misi' => 'required|string|max:500',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images');
        }
        Perusahaan::create($validated);
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan created successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Perusahaan $perusahaan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi' => 'required|string|max:500',
            'misi' => 'required|string|max:500',
        ]);
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images');
        }
        $perusahaan->update($validated);
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perusahaan $perusahaan)
    {
        //
    }
}
