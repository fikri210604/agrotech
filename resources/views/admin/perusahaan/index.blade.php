@extends('admin.app')

@section('content')
<div class="container">
    <div class="bg-white shadow-md rounded p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Profil Perusahaan</h2>
            <a href="{{ route('company.create') }}" class="btn btn-outline-secondary">✏️ Edit Data</a>
        </div>

        {{-- Informasi Penting --}}
        <div class="border rounded mb-4">
            <div class="bg-green-600 text-white px-4 py-2 rounded-t">Informasi Penting Perusahaan</div>
            <div class="p-4">
                <input type="text" readonly class="form-control mb-2" value="{{ $data->name ?? '' }}" placeholder="Nama">
                <input type="text" readonly class="form-control mb-2" value="{{ $data->email ?? '' }}" placeholder="Email">
                <input type="text" readonly class="form-control" value="{{ $data->phone ?? '' }}" placeholder="Nomor Telpon">
            </div>
        </div>

        {{-- Deskripsi Perusahaan --}}
        <div class="border rounded mb-4">
            <div class="bg-green-600 text-white px-4 py-2 rounded-t">Deskripsi Perusahaan</div>
            <div class="p-4">
                <textarea readonly class="form-control mb-2" placeholder="Deskripsi Layanan">{{ $data->deskripsi_layanan ?? '' }}</textarea>
                <input type="text" readonly class="form-control mb-2" value="{{ $data->visi ?? '' }}" placeholder="Visi">
                <input type="text" readonly class="form-control" value="{{ $data->misi ?? '' }}" placeholder="Misi">
            </div>
        </div>

        {{-- Promosi --}}
        <div class="border rounded mb-4">
            <div class="bg-green-600 text-white px-4 py-2 rounded-t">Promosi</div>
            <div class="p-4">
                @if(!empty($data->foto_promosi))
                    <img src="{{ asset('images/company-profile/'.$data->foto_promosi) }}" width="100" class="mb-2">
                @endif
                <input type="text" readonly class="form-control mb-2" value="{{ $data->alasan_memilih ?? '' }}" placeholder="Alasan Memilih">
                <input type="text" readonly class="form-control text-center bg-gray-100 text-gray-500" value="+ Tambah Alasan Memilih">
            </div>
        </div>

        {{-- Foto Galeri --}}
        <div class="border rounded mb-4">
            <div class="bg-green-600 text-white px-4 py-2 rounded-t">Foto-foto</div>
            <div class="p-4 flex flex-wrap gap-2">
                @if(is_array($data->foto_galeri))
                    @foreach($data->foto_galeri as $foto)
                        <img src="{{ asset('images/company-profile/'.$foto) }}" width="100">
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
