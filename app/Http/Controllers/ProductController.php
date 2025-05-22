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
        $products = Product::paginate(10);
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
        return redirect()->route('products.index')->with('success','produk berhasil ditambahkan');
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
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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


        $product = Product::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($product->foto && file_exists(public_path('images/product/' . $product->foto))) {
                unlink(public_path('images/product/' . $product->foto));
            }

            // Simpan foto baru
            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images/product'), $filename);
            $product->foto = $filename;
        }

        $product->nama = $request->nama;
        $product->jenis = $request->jenis;
        $product->kategori = $request->kategori;
        $product->merek = $request->merek;
        $product->deskripsi = $request->deskripsi;
        $product->harga_sewa = $request->harga_sewa;
        $product->stok = $request->stok;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Data berhasil diupdate!');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Hapus file foto jika ada
        if ($product->foto && file_exists(public_path('images/product/' . $product->foto))) {
            unlink(public_path('images/product/' . $product->foto));
        }

        $product->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function searchProduct(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('nama', 'like', '%' . $search . '%')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    


}
