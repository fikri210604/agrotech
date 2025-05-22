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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'deskripsi' => 'nullable',
            'visi' => 'required',
            'misi' => 'required',
            'alasan_memilih' => 'required',
            'foto_promosi.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'foto_galeri.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'foto_alasan_tambahan.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'deskripsi', 'visi', 'misi', 'alasan_memilih']);

        // Upload banyak foto promosi
        if ($request->hasFile('foto_promosi')) {
            $promosiNames = [];
            foreach ($request->file('foto_promosi') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/company-profile/promosi'), $fileName);
                $promosiNames[] = $fileName;
            }
            $data['foto_promosi'] = json_encode($promosiNames);
        }


        // Upload galeri
        if ($request->hasFile('foto_galeri')) {
            $galeriNames = [];
            foreach ($request->file('foto_galeri') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/company-profile/galeri'), $fileName);
                $galeriNames[] = $fileName;
            }
            $data['foto_galeri'] = json_encode($galeriNames);
        }

        // Proses alasan tambahan
        $alasanTambahan = [];
        if ($request->has('alasan_tambahan')) {
            foreach ($request->alasan_tambahan as $index => $alasan) {
                $foto = null;
                if ($request->hasFile('foto_alasan_tambahan') && isset($request->foto_alasan_tambahan[$index])) {
                    $file = $request->foto_alasan_tambahan[$index];
                    $fotoName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/company-profile/alasan'), $fotoName);
                    $foto = $fotoName;
                }

                $alasanTambahan[] = [
                    'alasan' => $alasan,
                    'foto' => $foto
                ];
            }
        }
        $data['alasan_tambahan'] = json_encode($alasanTambahan);

        Company::create($data);

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil ditambahkan.');
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
        $company = Company::first();
        if (!$company)
            return redirect()->back()->with('error', 'Data tidak ditemukan.');

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'deskripsi' => 'nullable',
            'visi' => 'required',
            'misi' => 'required',
            'alasan_memilih' => 'required',
            'foto_promosi.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'foto_galeri.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'foto_alasan_tambahan.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'deskripsi', 'visi', 'misi', 'alasan_memilih']);

        // Update banyak foto promosi
        if ($request->hasFile('foto_promosi')) {
            // Hapus file lama
            if ($company->foto_promosi) {
                $oldPromosi = json_decode($company->foto_promosi, true);
                if (is_array($oldPromosi)) {
                    foreach ($oldPromosi as $oldFoto) {
                        $oldPath = public_path('images/company-profile/promosi/' . $oldFoto);
                        if (file_exists($oldPath))
                            unlink($oldPath);
                    }
                }
            }

            $promosiNames = [];
            dd($request->file('foto_promosi'));
            foreach ($request->file('foto_promosi') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/company-profile/promosi'), $fileName);
                $promosiNames[] = $fileName;
            }

            $data['foto_promosi'] = json_encode($promosiNames);
        }

        // Update galeri
        if ($request->hasFile('foto_galeri')) {
            if ($company->foto_galeri) {
                $oldGaleri = json_decode($company->foto_galeri, true);
                if (is_array($oldGaleri)) {
                    foreach ($oldGaleri as $oldFoto) {
                        $oldPath = public_path('images/company-profile/galeri/' . $oldFoto);
                        if (file_exists($oldPath))
                            unlink($oldPath);
                    }
                }
            }

            $galeriNames = [];
            foreach ($request->file('foto_galeri') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images/company-profile/galeri'), $fileName);
                $galeriNames[] = $fileName;
            }
            $data['foto_galeri'] = json_encode($galeriNames);
        }

        // Update alasan tambahan
        $alasanTambahan = [];
        if ($request->has('alasan_tambahan')) {
            foreach ($request->alasan_tambahan as $index => $alasan) {
                $foto = null;
                if ($request->hasFile('foto_alasan_tambahan') && isset($request->foto_alasan_tambahan[$index])) {
                    $file = $request->foto_alasan_tambahan[$index];
                    $fotoName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/company-profile/alasan'), $fotoName);
                    $foto = $fotoName;
                }
                $alasanTambahan[] = [
                    'alasan' => $alasan,
                    'foto' => $foto
                ];
            }
        }
        $data['alasan_tambahan'] = json_encode($alasanTambahan);

        $company->update($data);

        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy()
    {
        //
    }
}
