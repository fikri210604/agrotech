@extends('admin.app')
@section('content')

<div class="p-6 space-y-6">
  <!-- Judul Halaman -->
  <div class="text-2xl font-semibold">Profil Perusahaan</div>

  <!-- Card Informasi Penting Perusahaan -->
  <div class="bg-white shadow-md rounded-lg border">
    <div class="bg-green-700 text-white font-semibold p-3 rounded-t-lg flex items-center space-x-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
      </svg>
      <span>Informasi Penting Perusahaan</span>
    </div>
    <div class="p-4">
      <!-- Konten Card -->
    </div>
  </div>

  <!-- Card Deskripsi Perusahaan -->
  <div class="bg-white shadow-md rounded-lg border">
    <div class="bg-green-700 text-white font-semibold p-3 rounded-t-lg flex items-center space-x-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13V9a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h5z"/>
      </svg>
      <span>Deskripsi Perusahaan</span>
    </div>
    <div class="p-4">
      <!-- Konten Card -->
    </div>
  </div>

  <!-- Card Promosi -->
  <div class="bg-white shadow-md rounded-lg border">
    <div class="bg-green-700 text-white font-semibold p-3 rounded-t-lg flex items-center space-x-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
      </svg>
      <span>Promosi</span>
    </div>
    <div class="p-4">
      <!-- Konten Card -->
    </div>
  </div>

  <!-- Card Foto-foto -->
  <div class="bg-white shadow-md rounded-lg border">
    <div class="bg-green-700 text-white font-semibold p-3 rounded-t-lg flex items-center space-x-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h4l3 5 4-6 5 8h4"/>
      </svg>
      <span>Foto-foto</span>
    </div>
    <div class="p-4">
      <!-- Konten Card -->
    </div>
  </div>
</div>

@endsection