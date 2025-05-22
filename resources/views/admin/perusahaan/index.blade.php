@extends('admin.app')

@section('content')

    @php
        $isEdit = !empty($company);
    @endphp

    <form action="{{ $isEdit ? route('perusahaan.update', $company->id) : route('perusahaan.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="container py-2">
            <div class="bg-white rounded-lg shadow p-4 mb-4">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800">{{ $isEdit ? 'Data Perusahaan' : 'Tambah Data Perusahaan' }}</h1>
                    <a href="#" class="btn btn-sm btn-outline-dark shadow-sm d-flex align-items-center" id="editBtn">
                        <i class="fas fa-pen fa-sm me-2 text-black-50"></i>
                        {{ $isEdit ? 'Edit Data' : 'Isi Data' }}
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Informasi Umum -->
                <div class="col-md-6">
                    <div class="card mb-4 border">
                        <div class="card-header bg-success text-white"><i class="fas fa-info-circle me-2"></i> Informasi
                            Umum</div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Nama Perusahaan</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $company->name ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $company->email ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Nomor Telepon</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $company->phone ?? '') }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="col-md-6">
                    <div class="card mb-4 border">
                        <div class="card-header bg-success text-white"><i class="fas fa-align-left me-2"></i> Deskripsi
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control"
                                    rows="3">{{ old('deskripsi', $company->deskripsi ?? '') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Visi</label>
                                <input type="text" name="visi" class="form-control"
                                    value="{{ old('visi', $company->visi ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Misi</label>
                                <input type="text" name="misi" class="form-control"
                                    value="{{ old('misi', $company->misi ?? '') }}" required>
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
                                    <img src="{{ asset('images/company-profile/promosi/' . $company->foto_promosi) }}"
                                        class="img-thumbnail mb-2" width="120">
                                @endif
                                <img id="preview-promosi" class="img-thumbnail d-none mb-2" width="120">
                            </div>
                            <div class="mb-3">
                                <label>Upload Gambar Promosi</label>
                                <input type="file" name="foto_promosi" class="form-control" id="input-promosi">
                            </div>
                            <div class="mb-3">
                                <label>Alasan Memilih</label>
                                <input type="text" name="alasan_memilih" class="form-control"
                                    value="{{ old('alasan_memilih', $company->alasan_memilih ?? '') }}" required>
                            </div>

                            <!-- Tambahan Alasan -->
                            <div id="tambahan-alasan-wrapper" class="mb-3">
                                <label>Alasan Tambahan</label>
                            </div>
                            <button type="button" class="btn btn-outline-primary mb-3" id="btn-tambah-alasan">+ Tambahkan
                                Alasan</button>
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
                                <input type="file" name="foto_galeri[]" class="form-control" multiple id="input-galeri">
                            </div>
                            <div class="d-flex flex-wrap gap-2 mb-2" id="galeri-preview">
                                @if($isEdit)
                                    @php
                                        $galeriImages = json_decode($company->foto_galeri, true) ?? [];
                                    @endphp
                                    @foreach($galeriImages as $foto)
                                        <img src="{{ asset('images/company-profile/galeri/' . $foto) }}" class="img-thumbnail"
                                            width="100" alt="Galeri Image">
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
        const tambahanAlasanWrapper = document.getElementById('tambahan-alasan-wrapper');
        const btnTambahAlasan = document.getElementById('btn-tambah-alasan');
        let alasanCount = 0;
    
        // Fungsi untuk mengaktifkan/nonaktifkan input
        function setInputsDisabled(state) {
            inputs.forEach(el => el.disabled = state);
            fileInputs.forEach(el => el.disabled = state);
            saveBtnWrapper.style.display = state ? 'none' : 'block';
        }
    
        // Mode awal (edit atau isi)
        let isEditMode = false;
        @if($isEdit)
            setInputsDisabled(true);
            editBtn.innerHTML = '<i class="fas fa-pen fa-sm me-2 text-black-50"></i> Edit Data';
            isEditMode = false;
        @else
            setInputsDisabled(false);
            editBtn.innerHTML = '<i class="fas fa-pen fa-sm me-2 text-black-50"></i> Isi Data';
            isEditMode = true;
        @endif
    
        // Toggle tombol edit/view
        editBtn?.addEventListener('click', function (e) {
            e.preventDefault();
            isEditMode = !isEditMode;
            setInputsDisabled(!isEditMode);
            editBtn.innerHTML = isEditMode
                ? '<i class="fas fa-user fa-sm me-2 text-black-50"></i> View Data'
                : '<i class="fas fa-pen fa-sm me-2 text-black-50"></i> Edit Data';
        });
    
        // Preview gambar promosi
        inputPromosi?.addEventListener('change', function () {
            const [file] = this.files;
            if (file) {
                if (previewPromosi.src) URL.revokeObjectURL(previewPromosi.src);
                previewPromosi.src = URL.createObjectURL(file);
                previewPromosi.classList.remove('d-none');
            } else {
                previewPromosi.src = '';
                previewPromosi.classList.add('d-none');
            }
        });
    
        // Preview galeri gambar (multiple)
        inputGaleri?.addEventListener('change', function () {
            // Hapus preview lama
            const oldImgs = galeriPreviewBaru.querySelectorAll('img');
            oldImgs.forEach(img => URL.revokeObjectURL(img.src));
            galeriPreviewBaru.innerHTML = '';
    
            Array.from(this.files).forEach(file => {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('img-thumbnail', 'me-2', 'mb-2');
                img.width = 100;
                galeriPreviewBaru.appendChild(img);
            });
        });
    
        btnTambahAlasan?.addEventListener('click', () => {
            alasanCount++;
            const alasanGroup = document.createElement('div');
            alasanGroup.classList.add('mb-3', 'border', 'p-3', 'rounded', 'position-relative', 'bg-light');
    
            const idFile = `foto-alasan-${alasanCount}`;
            const idPreview = `preview-alasan-${alasanCount}`;
    
            alasanGroup.innerHTML = `
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 btn-hapus-alasan" aria-label="Close"></button>
                <label>Alasan #${alasanCount}</label>
                <input type="text" name="alasan_tambahan[]" class="form-control mb-2" placeholder="Tuliskan alasan tambahan" required>
                <input type="file" name="foto_alasan_tambahan[]" class="form-control mb-2" accept="image/*" id="${idFile}">
                <img id="${idPreview}" class="img-thumbnail mb-2 d-none" width="100">
            `;
    
            tambahanAlasanWrapper.appendChild(alasanGroup);
    
            const fileInput = document.getElementById(idFile);
            const previewImg = document.getElementById(idPreview);
    
            // Preview untuk gambar alasan tambahan
            fileInput.addEventListener('change', function () {
                const [file] = this.files;
                if (file) {
                    if (previewImg.src) URL.revokeObjectURL(previewImg.src);
                    previewImg.src = URL.createObjectURL(file);
                    previewImg.classList.remove('d-none');
                } else {
                    previewImg.src = '';
                    previewImg.classList.add('d-none');
                }
            });
    
            // Hapus alasan tambahan
            const btnHapus = alasanGroup.querySelector('.btn-hapus-alasan');
            btnHapus.addEventListener('click', () => {
                if (previewImg?.src) URL.revokeObjectURL(previewImg.src);
                alasanGroup.remove();
            });
        });
    </script>
    
    
    

@endsection