<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Register</title>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    @include('asset.navbar')

    <div class="min-h-screen flex items-center justify-center mt-10 mb-10">
        <div class="bg-gray-50 p-8 rounded-2xl shadow-md w-[400px]">
            <h1 class="text-center font-bold text-lg mb-1">AgroTech</h1>
            <p class="text-center text-sm text-gray-500 mb-6">Selamat Datang!</p>

            <!-- Avatar Preview -->
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <img id="avatarPreview" src="https://via.placeholder.com/80x80.png?text=👤"
                         class="rounded-full w-20 h-20 border mx-auto object-cover" alt="Foto Profil">
                    <span class="absolute bottom-0 right-0 bg-gray-300 p-1 rounded-full text-xs">
                        <svg class="w-4 h-4 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 00-2 2v2h2V5h2V3H4zm10 0v2h2v2h2V5a2 2 0 00-2-2h-2zM4 13H2v2a2 2 0 002 2h2v-2H4v-2zm12 2h-2v2h2a2 2 0 002-2v-2h-2v2z"/>
                        </svg>
                    </span>
                </div>
            </div>

            <!-- Form -->
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <label for="foto" class="text-sm text-gray-500 mb-2">Upload Foto Profil</label>
                <label for="name" class="text-sm text-gray-500 mb-2">Nama</label>
                <input type="text" name="name" placeholder="Nama"
                    class="w-full border px-4 py-2 rounded-3xl focus:ring-2 focus:ring-green-400 outline-none" required>

                <label for="email" class="text-sm text-gray-500 mb-2">Email</label>
                <input type="email" name="email" placeholder="Email"
                    class="w-full border px-4 py-2 rounded-3xl focus:ring-2 focus:ring-green-400 outline-none" required>

                <label for="phone" class="text-sm text-gray-500 mb-2">Nomor Telepon</label>
                <input type="text" name="phone" placeholder="Nomor Telepon"
                    class="w-full border px-4 py-2 rounded-3xl focus:ring-2 focus:ring-green-400 outline-none" required>

                <label for="nik" class="text-sm text-gray-500 mb-2">NIK</label>
                <input type="text" name="nik" placeholder="NIK"
                    class="w-full border px-4 py-2 rounded-3xl focus:ring-2 focus:ring-green-400 outline-none" required>

                <label for="alamat" class="text-sm text-gray-500 mb-2">Alamat</label>
                <input type="text" name="alamat" placeholder="Alamat"
                    class="w-full border px-4 py-2 rounded-3xl focus:ring-2 focus:ring-green-400 outline-none" required>

                <label for="password" class="text-sm text-gray-500 mb-2">Password</label>
                <input type="password" name="password" placeholder="Password"
                    class="w-full border px-4 py-2 rounded-3xl focus:ring-2 focus:ring-green-400 outline-none" required>

                <label for="password_confirmation" class="text-sm text-gray-500 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password"
                    class="w-full border px-4 py-2 rounded-3xl focus:ring-2 focus:ring-green-400 outline-none" required>

                <label for="upload-foto" class="text-sm text-gray-500 mb-2">Upload Foto</label>
                <!-- file upload (as fallback too) -->
                <!-- File input untuk foto -->
                <input id="fotoInput" type="file" name="foto" accept="image/*"
                    class="w-full border px-4 py-2 rounded-3xl bg-white file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-gray-200 file:text-gray-700">

                <div class="text-right text-sm">
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-green-600">Sudah Punya Akun?</a>
                </div>

                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded transition">
                    Sign Up
                </button>
            </form>
        </div>
    </div>

    <!-- Script Avatar Preview -->
    <script>
        const fotoInput = document.getElementById('fotoInput');
        const avatarPreview = document.getElementById('avatarPreview');

        fotoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                avatarPreview.src = URL.createObjectURL(file);
            }
        });
    </script>

    @include('asset.footer')

</body>
</html>
