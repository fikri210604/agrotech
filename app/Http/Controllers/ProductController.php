<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required',
            'jenis' => 'required',
            'kategori' => 'required',
            'merek' => 'required',
            'deskripsi' => 'required',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|numeric',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Proses upload file
        $filename = null;
        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/product'), $filename);
        }
        // Simpan data produk
        Product::create([
            'foto' => $filename,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'merek' => $request->merek,
            'deskripsi' => $request->deskripsi,
            'harga_sewa' => $request->harga_sewa,
            'stok' => $request->stok,
            'status' => $request->status,
        ]);
        // Simpan data produk
        // dd($request->all());
        return redirect('products.store')->with('success', 'Selamat Datang ' . $request->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama' => 'required',
            'jenis' => 'required',
            'kategori' => 'required',
            'merek' => 'required',
            'deskripsi' => 'required',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|numeric',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Simpan data produk
        $product->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'merek' => $request->merek,
            'deskripsi' => $request->deskripsi,
            'harga_sewa' => $request->harga_sewa,
            'stok' => $request->stok,
            'status' => $request->status,
        ]);
        return redirect()->route('products.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $products = Product::findOrFail($id);
        $products->delete();
        return redirect('/admin/products')->with('success', 'Data Berhasil Dihapus');
    }
}
