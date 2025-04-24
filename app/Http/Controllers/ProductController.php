<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

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
        $request->validate([
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

        dd($request->all());
        // Proses upload file
        $fotoName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images'), $fotoName);

        // Simpan data produk
        Product::create([
            'foto' => 'images/' . $fotoName,
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'merek' => $request->merek,
            'deskripsi' => $request->deskripsi,
            'harga_sewa' => $request->harga_sewa,
            'stok' => $request->stok,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
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
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'merek' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required',
            'harga_sewa' => 'required',
            'status' => 'required',
        ]);

        $product->nama = $request->nama;
        $product->kategori = $request->kategori;
        $product->merek = $request->merek;
        $product->deskripsi = $request->deskripsi;
        $product->stok = $request->stok;
        $product->harga_sewa = $request->harga_sewa;
        $product->status = $request->status;

        $product->save();

        return redirect('/admin/products')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/admin/products')->with('success', 'Data Berhasil Dihapus');
    }
}
