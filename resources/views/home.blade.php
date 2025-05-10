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
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/awp.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">AWP</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/boom-lift.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Boom Lift</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/breaker.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Breaker Excavator</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/bucket.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Bucket Excavator</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/concrete.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Concrete Screed</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/dozer.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Dozer</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/forklift.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Forklift</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/genset.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Genset</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/plate.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Plate Compactor</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/scissor.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Scissor Lift</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/tandem.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Tandem Roller</span>
            </a>
            <a href="#" class="flex flex-col items-center p-4 border rounded-md hover:shadow-md transition-shadow shadow-xl">
                <img src="foto/vibro.jpg" alt="Alat" class="w-16 h-16 mb-2">
                <span class="text-sm text-gray-700 text-center">Vibro Roller</span>
            </a>
        </div>
        <div class="flex justify-center mt-8">
            <a href="/cari" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition-colors font-semibold">Cari Alat Lain?</a>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Mengapa Memilih Kami?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border rounded-lg p-6 flex flex-col items-center text-center shadow-lg">
                <div class= "mb-4">
                    <img src="foto/1.jpg" alt="Praktis" class="w-16 h-16">
                </div>
                <h3 class="text-lg font-semibold mb-2">Praktis</h3>
                <p class="text-gray-600">Permudahan segala dari proses mencari website.</p>
            </div>
            <div class="border rounded-lg p-6 flex flex-col items-center text-center shadow-lg">
                <div class=" rounded-lg mb-4">
                    <img src="foto/2.jpg" alt="Hemat Biaya" class="w-16 h-16">
                </div>
                <h3 class="text-lg font-semibold mb-2">Hemat Biaya</h3>
                <p class="text-gray-600">Penyewaan lebih murah, dibanding membeli alat sendiri.</p>
            </div>
            <div class="border rounded-lg p-6 flex flex-col items-center text-center shadow-lg">
                <div class="rounded-lg mb-4">
                    <img src="foto/3.jpg" alt="Alat Berkualitas" class="w-16 h-16">
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
                <a href="#" class="inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition-colors shadow-xl font-semibold">Bergabung Sekarang</a>
            </div>
            <div class="rounded-lg overflow-hidden">
                <img src="\img\tractor.jpg" class="w-full h-64 object-cover">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-[#1B7037] text-white py-10 px-6">
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
        <a href="#" class="inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition-colors font-semibold">Pelajari Lebih Lanjut</a>
    </section>

    <!-- CTA Section -->
    <section class="py-12 px-6 max-w-6xl mx-auto">
    <div class="relative bg-gray-100 rounded-lg p-8 overflow-hidden">
        <img src="foto/sawag.jpg" alt="Gambar Tractor" class="absolute inset-0 w-full h-full object-cover z-0">
        <div class="absolute inset-0 bg-white/60 z-10"></div>
        <div class="relative z-20">
            <p class="text-gray-800 mb-4">
                Siap meningkatkan produktivitas pertanian Anda? 🌾 Dengan AgroTech, Anda bisa menyewa alat pertanian modern dengan proses yang mudah dan terjangkau. Apa karena di daerah Anda sulit mencari alat pertanian?
            </p>
            <a href="#" class="inline-block bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 transition-colors font-semibold shadow-inner">
                Tanya Sekarang
            </a>
        </div>
    </div>
</section>


    @include('asset.footer')
</body>
</html>