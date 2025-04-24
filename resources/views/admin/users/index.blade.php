@extends('admin.app')

@section('content')

<!--Table-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Penyewa</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addModal">
    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
    </a>
</div>

<!--Table-->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="{{ url('/products') }}" method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary fa-search">Cari</button>
                </form>
            </div>
            <div class="card-body table-hovered">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @if (count($users) == 0)
                        <tbody>
                            <tr>
                                <td class="pt-10 pb-10 text-center" colspan="9">Data Kosong</td>
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td><img src="{{ asset('foto/'.$user->foto) }}" width="100px"></td>
                                <td>{{ $user->nik }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->alamat }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                <a href="#" class="btn btn-warning fa-solid fa-pen" data-toggle="modal" data-target="#editModal{{ $user->id }}" data-id="{{ $user->id }}" data-nik="{{ $user->nik }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-phone="{{ $user->phone }}" data-alamat="{{ $user->alamat }}" data-status="{{ $user->status }}"></a>
                                <form action="{{ url('/users/'.$user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger fa-trash"></button>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach($users as $user)
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Penyewa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="/users" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{ $user->nik }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">No HP</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $user->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ $user->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="/users" method="POST" enctype="multipart/form-data"> <!-- form buka DI SINI -->
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Penyewa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto">
          </div>
          <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" required>
          </div>
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="phone">No HP</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
              <option value="aktif">Aktif</option>
              <option value="tidak aktif">Tidak Aktif</option>
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


<!--Modal Hapus-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Penyewa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah anda yakin ingin menghapus data penyewa ini?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk isi form edit -->
<script>
    function editUser(id, nik, name, email, phone, alamat, status) {
        $('#editForm').attr('action', '/users/' + id);
        $('#edit_nik').val(nik);
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_phone').val(phone);
        $('#edit_alamat').val(alamat);
        $('#edit_status').val(status);
    }
</script>
@endsection
