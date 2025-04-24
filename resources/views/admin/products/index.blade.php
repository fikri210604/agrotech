@extends('admin.app')

@section('content')

<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Alat</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
    </a>
</div>

<!-- Table -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="/products" method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary fa-search">Cari</button>
                </form>
            </div>
        </div> <!-- tutup row mb-3 -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                    <tr>
                        <th>No</th>
                        <th>ID Alat</th>
                        <th>Nama Alat</th>
                        <th>Foto</th>
                        <th>Kategori</th>
                        <th>Merek</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->id}}</td>
                            <td>{{ $product->nama }}</td>
                            <td>{{ $product->foto }}</td>
                            <td>{{ $product->kategori }}</td>
                            <td>{{ $product->merek }}</td>
                            <td>{{ $product->deskripsi }}</td>
                            <td>{{ $product->harga }}</td>
                            <td>{{ $product->stok }}</td>
                            <td class="d-flex w-full justify-content-center">
                                <a href="#editModal{{ $product->id }}" class="btn btn-warning btn-sm mr-1 w-full" data-toggle="modal">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $product->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Data Kosong</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> 
    </div> 
</div> 


<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/products" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Alat</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="jenis" class="form-control" required>
                            <option value="alat berat">Traktor</option>
                            <option value="alat kecil">Bajak</option>
                            <option value="alat listrik">Pemanen</option>
                            <option value="alat pertanian">Alat Pertanian</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Merek</label>
                        <input type="text" name="merek" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga_sewa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" name="stok" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="tidak tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($products as $product)
<div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/products" method="POST" enctype="multipart/form-data">
            @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Alat</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori" value="{{ $product->kategori }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Merek</label>
                        <input type="text" name="merek" value="{{ $product->merek }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="deskripsi" value="{{ $product->deskripsi }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" value="{{ $product->harga }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" name="stok" value="{{ $product->stok }}" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Hapus -->
@foreach ($products as $product)
<div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus <strong>{{ $product->name }}</strong>?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
