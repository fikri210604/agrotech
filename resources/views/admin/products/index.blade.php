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
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Header dengan Form Pencarian -->
            <div class="card-header py-3">
                <form action="/products" method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary fa-search">Cari</button>
                </form>
            </div>

            <!-- Body -->
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Table Responsive -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>No</th>
                                <th>ID Alat</th>
                                <th>Foto</th>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Merek</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <img src="{{ asset('images/product/' . $product->foto) }}" width="50px">
                                    </td>
                                    <td>{{ $product->nama }}</td>
                                    <td>{{ $product->kategori }}</td>
                                    <td>{{ $product->jenis }}</td>
                                    <td>{{ $product->merek }}</td>
                                    <td>{{ $product->deskripsi }}</td>
                                    <td>{{ $product->harga_sewa }}</td>
                                    <td>{{ $product->stok }}</td>
                                    <td>{{ $product->status}}</td>
                                    <td class="d-flex justify-content-center gap-1">
                                        <!-- Tombol Edit -->
                                        <a href="/products/{{ $product->id }}/edit"
                                           class="btn btn-warning"
                                           data-toggle="modal"
                                           data-target="#editModal{{ $product->id }}"
                                           data-id="{{ $product->id }}"
                                           data-nama="{{ $product->nama }}"
                                           data-kategori="{{ $product->kategori }}"
                                           data-merek="{{ $product->merek }}"
                                           data-deskripsi="{{ $product->deskripsi }}"
                                           data-harga="{{ $product->harga }}"
                                           data-stok="{{ $product->stok }}">
                                            <i class="fas fa-pen fa-sm text-white-50"></i>
                                        </a>

                                        <!-- Tombol Delete -->
                                        <a href="#" class="btn btn-danger btn-sm"
                                           data-toggle="modal"
                                           data-target="#deleteModal{{ $product->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div> 
</div> >



<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Tambah Data Alat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
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
                            <option value="alat pertanian">Pompa Hidrolik</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" required>
                            <option value="alat berat">Ringan</option>
                            <option value="alat kecil">Berat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Merek</label>
                        <select name="merek" class="form-control" required>
                            <option value="Yanmar">Yanmar</option>
                            <option value="Kubota">Kubota</option>
                            <option value="Sany">Sany</option>
                            <option value="Komatsu">Komatsu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
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
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control" required>
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
            <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama Alat</label>
                        <input type="text" name="nama" value="{{ $product->nama }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori" value="{{ $product->kategori }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" name="jenis" value="{{ $product->jenis }}" class="form-control" required>
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
                        <input type="text" name="harga_sewa" value="{{ $product->harga_sewa }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" name="stok" value="{{ $product->stok }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="tersedia" {{ $product->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="tidak tersedia" {{ $product->status == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
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
                <p>Apakah Anda yakin ingin menghapus <strong>{{ $product->nama }}</strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="{{ url('/products/' . $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection
