@extends('admin.app')

@section('content')

<!-- Header -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
</div>

<!-- Table -->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <!-- Header dengan Form Pencarian -->
            <div class="card-header py-3">
                <form action="/transactions" method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>

            <!-- Body -->
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Table Responsive -->
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>No</th>
                                <th>ID User</th>
                                <th>Foto</th>
                                <th>Nama Penyewa</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>ID Produk</th>
                                <th>Nama Produk</th>
                                <th>Jumlah Pemesanan</th>
                                <th>Tanggal Awal</th>
                                <th>Tanggal Akhir</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->user->user_id }}</td>
                                    <td>
                                        <img src="{{ asset('images/product/' . $transaction->product->foto) }}" width="50px">
                                    </td>
                                    <td>{{ $transaction->nama_penyewa }}</td>
                                    <td>{{ $transaction->no_hp_penyewa }}</td>
                                    <td>{{ $transaction->email_penyewa }}</td>
                                    <td>{{ $transaction->alamat_penyewa }}</td>
                                    <td>{{ $transaction->product->id }}</td>
                                    <td>{{ $transaction->product->name }}</td>
                                    <td>{{ $transaction->jumlah }}</td>
                                    <td>{{ $transaction->tanggal_awal_sewa }}</td>
                                    <td>{{ $transaction->tanggal_akhir_sewa }}</td>
                                    <td>{{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>
                                        <!-- Tombol Edit Status -->
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editStatusModal{{ $transaction->id }}">
                                            <i class="fas fa-pen fa-sm text-white-50"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $transaction->id }}">
                                            <i class="fas fa-trash fa-sm text-white-50"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Edit Status -->
                                <div class="modal fade" id="editStatusModal{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="editStatusModalLabel{{ $transaction->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editStatusModalLabel{{ $transaction->id }}">Ubah Status Transaksi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select name="status" class="form-control" required>
                                                            <option value="Diproses" {{ $transaction->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                                            <option value="Selesai" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Dibatalkan" {{ $transaction->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                                        </select>
                                                        @error('status')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="15" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end mt-3">
                        {{ $transactions->links() }}
                    </div>
                </div> 
            </div>
        </div>
    </div> 
</div>
@endsection
