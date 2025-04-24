@extends('admin.app')

@section('content')
<div class="container">
    <div class="bg-white shadow-md rounded p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Profil Perusahaan</h2>
            <a href="{{ route('perusahaan.index') }}" class="btn btn-outline-secondary">👤 View Data</a>
        </div>

        <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Informasi Penting --}}
            <div class="border rounded mb-4">
                <div class="bg-green-600 text-white px-4 py-2 rounded-t">Informasi Penting Perusahaan</div>
                <div class="p-4">
                    <input type="text" name="nama_perusahaan" class="form-control mb-2" placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan', $data->nama_perusahaan ?? '') }}">
                    <input type="email" name="email_perusahaan" class="form-control mb-2" placeholder="Email Perusahaan" value="{{ old('email_perusahaan', $data->email_perusahaan ?? '') }}">
                    <input type="text" name="nomor_telpon" class="form-control" placeholder="Nomor Telpon" value="{{ old('nomor_telpon', $data->nomor_telpon ?? '') }}">
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="border rounded mb-4">
                <div class="bg-green-600 text-white px-4 py-2 rounded-t">Deskripsi Perusahaan</div>
                <div class="p-4">
                    <textarea name="deskripsi_layanan" class="form-control mb-2" placeholder="Deskripsi Layanan">{{ old('deskripsi_layanan', $data->deskripsi_layanan ?? '') }}</textarea>
                    <input type="text" name="visi" class="form-control mb-2" placeholder="Visi" value="{{ old('visi', $data->visi ?? '') }}">
                    <input type="text" name="misi" class="form-control" placeholder="Misi" value="{{ old('misi', $data->misi ?? '') }}">
                </div>
            </div>

            {{-- Promosi --}}
            <div class="border rounded mb-4">
                <div class="bg-green-600 text-white px-4 py-2 rounded-t">Promosi</div>
                <div class="p-4">
                    @if($data && $data->foto_promosi)
                        <img src="{{ asset('image/company-profile/'.$data->foto_promosi) }}" width="100" class="mb-2">
                    @endif
                    <input type="file" name="foto_promosi" class="form-control mb-2">

                    <input type="text" name="alasan_memilih" class="form-control mb-2" placeholder="Alasan Memilih" value="{{ old('alasan_memilih', $data->alasan_memilih ?? '') }}">
                    <input type="text" disabled value="+ Tambah Alasan Memilih" class="form-control text-center bg-gray-100 text-gray-500">
                </div>
            </div>

            {{-- Foto Galeri --}}
            <div class="border rounded mb-4">
                <div class="bg-green-600 text-white px-4 py-2 rounded-t">Foto-foto</div>
                <div class="p-4">
                    <input type="file" name="foto_galeri[]" multiple class="form-control mb-2">
                    <div class="flex flex-wrap gap-2">
                        @if($data && $data->foto_galeri)
                            @foreach($data->foto_galeri as $foto)
                                <img src="{{ asset('storage/'.$foto) }}" width="100">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            {{-- Save Button --}}
            <div class="text-center">
                <button class="w-full bg-lime-500 hover:bg-lime-600 text-white font-semibold py-3 rounded transition">
                    Save All Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
