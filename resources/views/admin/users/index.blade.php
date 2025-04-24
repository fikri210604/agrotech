@extends('admin.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-2kk0f9elzL6zJ6+cxR6zzkG8yT1SP1V4TpaXUsW/ixY9xFwBaZNg1VblHhr4v6Zy/YptZInV4wlbK1eZqGLwYg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!--Table-->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Penyewa</h1>
    <a href="/users/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addModal">
    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
    </a>
</div>

<!--Table-->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="/users" method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control mr-2" placeholder="Cari...">
                    <button type="submit" class="btn btn-primary fa-search">Cari</button>
                </form>
            </div>
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
                <div class="table-responsive">
                <table class="table table-bordered table-hovered" id="dataTable" width="100%" cellspacing="0">
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
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('images/'.$user->foto) }}" width="50px"></td>
                                <td>{{ $user->nik }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->alamat }}</td>
                                <td>{{ $user->status }}</td>
                                <td class="text-center d-flex w-full justify-content-center">
                                    <a href="/users/{{ $user->id }}" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $user->id }}" data-id="{{ $user->id }}" data-nik="{{ $user->nik }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-phone="{{ $user->phone }}" data-alamat="{{ $user->alamat }}" data-status="{{ $user->status }}">
                                        <i class="fas fa-pen fa-sm text-white-50"></i>
                                    </a>
                                    <a href="/users/{{ $user->id }}" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                                        <i class="fas fa-trash fa-sm text-white-50"></i>
                                    </a>
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


<!-- Modal Tambah User -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Penyewa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">No HP</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@foreach ($users as $user)
<!-- Modal Edit User -->
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Penyewa</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
          </div>
          <div class="form-group">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ $user->nik }}" required>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
          </div>
          <div class="form-group">
            <label>No HP</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ $user->alamat }}</textarea>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="aktif" {{ $user->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
              <option value="nonaktif" {{ $user->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach

<!--Modal Hapus-->
<div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form action="/users/{{ $user->id }}" method="POST">
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
