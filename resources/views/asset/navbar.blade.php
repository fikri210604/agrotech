<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="#" class="text-xl font-bold text-gray-800">AgroTech</a>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="md:hidden flex items-center">
                <button id="menu-toggle" class="text-gray-800 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Menu Items -->
            <div class="hidden md:flex space-x-6 items-center">
                <a href="#" class="text-sm text-gray-700 hover:text-green-500">Katalog Produk</a>
                <a href="#" class="text-sm text-gray-700 hover:text-green-500">Mengapa Kami</a>
                <a href="#" class="text-sm text-gray-700 hover:text-green-500">Perusahaan</a>
                <a href="#" class="text-gray-700 hover:text-green-500"><i class="fa fa-phone"></i></a>
                <a href="#" class="text-gray-700 hover:text-green-500"><i class="fa fa-bell"></i></a>
                <a href="/login" class="text-gray-700 hover:text-green-500"><i class="fa fa-user"></i></a>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="menu" class="md:hidden hidden px-4 pb-4">
        <a href="#" class="block py-2 text-sm text-gray-700 hover:text-green-500">Katalog Produk</a>
        <a href="#" class="block py-2 text-sm text-gray-700 hover:text-green-500">Mengapa Kami</a>
        <a href="#" class="block py-2 text-sm text-gray-700 hover:text-green-500">Perusahaan</a>
        <div class="flex space-x-4 pt-2">
            <a href="#" class="text-gray-700 hover:text-green-500"><i class="fa fa-phone"></i></a>
            <a href="#" class="text-gray-700 hover:text-green-500"><i class="fa fa-bell"></i></a>
            <a href="#" class="text-gray-700 hover:text-green-500"><i class="fa fa-user"></i></a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleBtn = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        toggleBtn?.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    });
</script>
