@extends('admin.app')

@section('content')


@php
    $isEdit = !empty($company);
@endphp
<form action="{{ $isEdit ? route('perusahaan.update') : route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="container py-2">
        <div class="bg-white rounded-lg shadow p-4 mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="h3 mb-0 text-gray-800">{{ $isEdit ? 'Data Perusahaan' : 'Tambah Data Perusahaan' }}</h1>
                <a href="#" class="btn btn-sm btn-outline-dark shadow-sm d-flex align-items-center hover:bg-green-500" id="editBtn">
                    <i class="fas fa-pen fa-sm mr-2 text-black-50"></i> Edit Data
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Informasi Umum -->
            <div class="col-md-6">
                <div class="card mb-4 border">
                    <div class="card-header bg-success text-white"><i class="fas fa-info-circle me-2"></i> Informasi Umum</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Nama Perusahaan</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name ?? '') }}" {{ $isEdit ? 'disabled' : '' }} required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email ?? '') }}" {{ $isEdit ? 'disabled' : '' }} required>
                        </div>
                        <div class="mb-3">
                            <label>Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone ?? '') }}" {{ $isEdit ? 'disabled' : '' }} required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="col-md-6">
                <div class="card mb-4 border">
                    <div class="card-header bg-success text-white"><i class="fas fa-align-left me-2"></i> Deskripsi</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" {{ $isEdit ? 'disabled' : '' }}>{{ old('deskripsi', $company->deskripsi ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Visi</label>
                            <input type="text" name="visi" class="form-control" value="{{ old('visi', $company->visi ?? '') }}" {{ $isEdit ? 'disabled' : '' }} required>
                        </div>
                        <div class="mb-3">
                            <label>Misi</label>
                            <input type="text" name="misi" class="form-control" value="{{ old('misi', $company->misi ?? '') }}" {{ $isEdit ? 'disabled' : '' }} required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promosi -->
            <div class="col-md-6">
                <div class="card mb-4 border">
                    <div class="card-header bg-success text-white"><i class="fas fa-bullhorn me-2"></i> Promosi</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Gambar Promosi Saat Ini</label><br>
                            @if($isEdit && $company->foto_promosi)
                                <img src="{{ asset('images/company-profile/promosi/'.$company->foto_promosi) }}" class="img-thumbnail mb-2" width="120">
                            @endif
                            <img id="preview-promosi" class="img-thumbnail d-none mb-2" width="120">
                        </div>
                        <div class="mb-3">
                            <label>Upload Gambar Promosi</label>
                            <input type="file" name="foto_promosi" class="form-control" id="input-promosi" {{ $isEdit ? 'disabled' : '' }}>
                        </div>
                        <div class="mb-3">
                            <label>Alasan Memilih</label>
                            <input type="text" name="alasan_memilih" class="form-control" value="{{ old('alasan_memilih', $company->alasan_memilih ?? '') }}" {{ $isEdit ? 'disabled' : '' }} required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Galeri -->
            <div class="col-md-6">
                <div class="card mb-4 border">
                    <div class="card-header bg-success text-white"><i class="fas fa-images me-2"></i> Galeri</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Upload Galeri (bisa lebih dari satu)</label>
                            <input type="file" name="foto_galeri[]" class="form-control" multiple id="input-galeri" {{ $isEdit ? 'disabled' : '' }}>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mb-2" id="galeri-preview">
                            @if($isEdit && is_array(json_decode($company->foto_galeri, true)))
                                @foreach(json_decode($company->foto_galeri, true) as $foto)
                                    <img src="{{ asset('images/company-profile/galeri/'.$foto) }}" class="img-thumbnail" width="100">
                                @endforeach
                            @endif
                        </div>
                        <div class="d-flex flex-wrap gap-2" id="new-galeri-preview"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="mt-3" id="saveBtnWrapper" style="display: none;">
            <button type="submit" class="btn btn-success w-100 py-2">
                {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Perusahaan' }}
            </button>
        </div>
    </div>
</form>

<script>
    const editBtn = document.getElementById('editBtn');
    const saveBtnWrapper = document.getElementById('saveBtnWrapper');
    const inputs = document.querySelectorAll('form input:not([type="file"]), form textarea, form select');
    const fileInputs = document.querySelectorAll('input[type="file"]');
    const inputPromosi = document.getElementById('input-promosi');
    const inputGaleri = document.getElementById('input-galeri');
    const galeriPreviewBaru = document.getElementById('new-galeri-preview');
    const previewPromosi = document.getElementById('preview-promosi');

    let isEditMode = false;

    // Nonaktifkan semua input & tombol simpan saat awal
    inputs.forEach(el => el.setAttribute('disabled', 'disabled'));
    fileInputs.forEach(el => el.setAttribute('disabled', 'disabled'));
    saveBtnWrapper.style.display = 'none';
    editBtn.style.display = 'inline-flex';

    @if(!$isEdit)
        editBtn.innerHTML = '<i class="fas fa-pen fa-sm mr-2 text-black-50"></i> Isi Data';
    @else
        editBtn.innerHTML = '<i class="fas fa-pen fa-sm mr-2 text-black-50"></i> Edit Data';
    @endif

    // Saat tombol Edit ditekan
    editBtn.addEventListener('click', function(e) {
        e.preventDefault();
        isEditMode = !isEditMode;

        if (isEditMode) {
            inputs.forEach(el => el.removeAttribute('disabled'));
            fileInputs.forEach(el => el.removeAttribute('disabled'));
            saveBtnWrapper.style.display = 'block';
            editBtn.innerHTML = '<i class="fas fa-user fa-sm mr-2 text-black-50"></i> View Data';
        } else {
            inputs.forEach(el => el.setAttribute('disabled', 'disabled'));
            fileInputs.forEach(el => el.setAttribute('disabled', 'disabled'));
            saveBtnWrapper.style.display = 'none';
            @if(!$isEdit)
                editBtn.innerHTML = '<i class="fas fa-pen fa-sm mr-2 text-black-50"></i> Isi Data';
            @else
                editBtn.innerHTML = '<i class="fas fa-pen fa-sm mr-2 text-black-50"></i> Edit Data';
            @endif
        }
    });

    // Preview Gambar Promosi
    inputPromosi?.addEventListener('change', function () {
        const [file] = this.files;
        if (file) {
            previewPromosi.src = URL.createObjectURL(file);
            previewPromosi.classList.remove('d-none');
        }
    });

    // Preview Galeri Baru
    inputGaleri?.addEventListener('change', function () {
        galeriPreviewBaru.innerHTML = '';
        Array.from(this.files).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.width = 100;
            img.classList.add('img-thumbnail', 'me-2', 'mb-2');
            galeriPreviewBaru.appendChild(img);
        });
    });
</script>


@endsection
