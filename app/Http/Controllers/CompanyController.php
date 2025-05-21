<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi' => 'required|string|max:500',
            'misi' => 'required|string|max:500',
            'alasan_memilih' => 'required|string|max:500',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $filename = null;
        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $filename);
        }
        Perusahaan::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'deskripsi' => $request->deskripsi,
            'foto' => $filename,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'alasan_memilih' => $request->alasan_memilih,
        ]);
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi' => 'required|string|max:500',
            'misi' => 'required|string|max:500',
            'alasan_memilih' => 'required|string|max:500',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $perusahaan->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'deskripsi' => $request->deskripsi,
            'foto' => $request->hasFile('foto') ? $request->file('foto')->store('images') : $perusahaan->foto,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'alasan_memilih' => $request->alasan_memilih,
        ]);
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
