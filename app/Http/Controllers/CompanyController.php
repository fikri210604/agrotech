<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::first(); // hanya satu data profil
        return view('admin.perusahaan.index', compact('company'));
    }

    public function create()
    {
        return view('admin.perusahaan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'deskripsi' => 'nullable|string',
            'visi' => 'required|string|max:500',
            'misi' => 'required|string|max:500',
            'alasan_memilih' => 'required|string|max:500',
            'foto_promosi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_galeri' => 'nullable|array',
            'foto_galeri.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $promosiFilename = null;
        if ($request->hasFile('foto_promosi')) {
            $promosiFilename = time() . '_promosi.' . $request->file('foto_promosi')->extension();
            $request->file('foto_promosi')->move(public_path('images/company-profile/promosi'), $promosiFilename);
        }

        $galeriFilenames = [];
        if ($request->hasFile('foto_galeri')) {
            foreach ($request->file('foto_galeri') as $file) {
                $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/company-profile/galeri'), $namaFile);
                $galeriFilenames[] = $namaFile;
            }
        }

        Company::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'deskripsi' => $request->deskripsi,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'alasan_memilih' => $request->alasan_memilih,
            'foto_promosi' => $promosiFilename,
            'foto_galeri' => !empty($galeriFilenames) ? json_encode($galeriFilenames) : null,
        ]);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan created successfully.');
    }


    public function show()
    {
        $company = Company::first();
        return view('admin.perusahaan.show', compact('company'));
    }

    public function edit()
    {
        $company = Company::first();
        return view('admin.perusahaan.index', compact('company'));
    }

    public function update(Request $request)
    {
        $company = Company::first() ?? new Company();
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'deskripsi' => 'nullable|string',
            'visi' => 'required|string|max:500',
            'misi' => 'required|string|max:500',
            'alasan_memilih' => 'required|string|max:500',
            'foto_promosi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_galeri' => 'nullable|array',
            'foto_galeri.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // SIMPAN FOTO PROMOSI
        if ($request->hasFile('foto_promosi')) {
            $promosiFilename = time() . '_promosi.' . $request->file('foto_promosi')->extension();
            $request->file('foto_promosi')->move(public_path('images/company-profile/promosi'), $promosiFilename);
            $company->foto_promosi = $promosiFilename;
        }
    
        // SIMPAN FOTO GALERI
        if ($request->hasFile('foto_galeri')) {
            $fotoBaru = [];
    
            foreach ($request->file('foto_galeri') as $file) {
                $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/company-profile/galeri'), $namaFile);
                $fotoBaru[] = $namaFile;
            }
    
            $fotoLama = json_decode($company->foto_galeri, true) ?? [];
            $company->foto_galeri = json_encode(array_merge($fotoLama, $fotoBaru));
        }
    
        // UPDATE FIELD LAIN
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->deskripsi = $request->deskripsi;
        $company->visi = $request->visi;
        $company->misi = $request->misi;
        $company->alasan_memilih = $request->alasan_memilih;
    
        $company->save();
    
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan updated successfully.');
    }
    

    public function destroy()
    {
        //
    }
}
