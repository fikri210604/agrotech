<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroTech - Rental Alat Pertanian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body class="bg-white">
    <!-- Navbar -->
     @include('asset.navbar')

    <section class="relative w-full min-h-screen overflow-hidden">
        <img src="{{ asset('img/tractor.jpg') }}" alt="Gambar Tractor" class="absolute inset-0 w-full h-full object-cover z-0">
        <div class="absolute inset-0 bg-black/30 z-10"></div>
        <div class="relative z-20 flex flex-col items-center justify-center min-h-screen px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight drop-shadow-md">
                Cari Rental Alat<br>Online
            </h1>

            <div class="flex w-full max-w-md overflow-hidden rounded-md bg-white shadow-md">
                <input 
                    type="text" 
                    placeholder="Cari Alat" 
                    class="w-full px-4 py-3 text-gray-700 focus:outline-none"
                >
                <button class="px-4 py-3 font-medium text-grey-700 bg-green-500 hover:bg-green-600 border border-black transition duration-300 ease-in-out">
                    CARI
                </button>
            </div>
        </div>
    </section>


    <!-- Equipment Categories -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">Pilihan Rental Beragam</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/4616/4616734.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Genset</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/2180/2180903.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Loader Lift</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/5018/5018421.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Excavator Komatsu</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/2271/2271403.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Bulldozer Komatsu</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/3127/3127288.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Compactor Bomag</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/2986/2986232.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Grader</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/1785/1785352.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Forklift</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/9221/9221799.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Container</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/1996/1996085.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Air Compressor</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/2099/2099174.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Scissor Lift</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/5514/5514990.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Traktor Kecil</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow">
                <img src="https://cdn-icons-png.flaticon.com/512/3815/3815483.png" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Motor Grader</span>
            </a>
        </div>
        <div class="flex justify-center mt-8">
            <a href="#" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition-colors">Cari Alat Lain?</a>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Mengapa Memilih Kami?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border rounded-lg p-6 flex flex-col items-center text-center">
                <div class="bg-purple-100 p-3 rounded-lg mb-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/4299/4299622.png" alt="Praktis" class="w-16 h-16">
                </div>
                <h3 class="text-lg font-semibold mb-2">Praktis</h3>
                <p class="text-gray-600">Permudahan segala dari proses mencari website.</p>
            </div>
            <div class="border rounded-lg p-6 flex flex-col items-center text-center">
                <div class="bg-blue-100 p-3 rounded-lg mb-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/1642/1642068.png" alt="Hemat Biaya" class="w-16 h-16">
                </div>
                <h3 class="text-lg font-semibold mb-2">Hemat Biaya</h3>
                <p class="text-gray-600">Penyewaan lebih murah, dibanding membeli alat sendiri.</p>
            </div>
            <div class="border rounded-lg p-6 flex flex-col items-center text-center">
                <div class="bg-green-100 p-3 rounded-lg mb-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/4149/4149883.png" alt="Alat Berkualitas" class="w-16 h-16">
                </div>
                <h3 class="text-lg font-semibold mb-2">Alat Berkualitas</h3>
                <p class="text-gray-600">Tersedia berbagai alat modern dan siap pakai.</p>
            </div>
        </div>
    </section>

    <!-- Agriculture Image Section -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
                <p class="text-gray-700 mb-4">Bergabunglah sebagai mitra AgroTech dan pastikan bagian dari inovasi pertanian digital di-C! Tingkatkan pendapatan bisnis dengan menyewakan alat pertanian Anda kepada lebih banyak petani.</p>
                <a href="#" class="inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition-colors">Bergabung Sekarang</a>
            </div>
            <div class="rounded-lg overflow-hidden">
                <img src="\img\tractor.jpg" class="w-full h-64 object-cover">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-green-800 text-white py-10 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col">
                    <h3 class="text-xl font-semibold mb-2">Pencapaian AgroTech</h3>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-3xl font-bold mb-1">50+</span>
                    <span class="text-sm">Merk Berkualitas</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-3xl font-bold mb-1">25+</span>
                    <span class="text-sm">Mitra Terpercaya</span>
                </div>
                <div class="flex flex-col items-center md:col-start-2">
                    <span class="text-3xl font-bold mb-1">150+</span>
                    <span class="text-sm">Pelanggan Tetap</span>
                </div>
            </div>
        </div>
    </section>

    <!-- About Company -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tentang Perusahaan</h2>
        <p class="text-gray-700 mb-6">
            AgroTech menjadi solusi inovatif bagi petani dalam meningkatkan produktivitas pertanian melalui pemanfaatan alat bertani berbasis digital. Dengan bantuan kami, petani dengan mudah mendapatkan akses ke peralatan pertanian modern seperti traktor, mesin panen, dan alat pengairan tanpa harus mengeluarkan biaya besar untuk pembelian.
        </p>
        <p class="text-gray-700 mb-6">
            AgroTech hadir untuk mendukung transformasi pertanian Indonesia menuju masa depan yang lebih efisien, efektif, dan berkelanjutan.
        </p>
        <a href="#" class="inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition-colors">Pelajari Lebih Lanjut</a>
    </section>

    <!-- CTA Section -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
        <div class="bg-gray-100 rounded-lg p-8">
            <p class="text-gray-800 mb-4">Siap meningkatkan produktivitas pertanian Anda? 🌾 Dengan AgroTech, Anda bisa menyewa alat pertanian modern dengan proses yang mudah dan terjangkau. Apa karena di daerah Anda sulit mencari alat pertanian?</p>
            <a href="#" class="inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition-colors">Tanya Sekarang</a>
        </div>
    </section>

    @include('asset.footer')
</body>
</html>