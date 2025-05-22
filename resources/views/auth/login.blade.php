<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <!-- Navbar -->
    @include('asset.navbar')

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-[500px] text-center">
            <h1 class="text-lg font-bold mb-4">AgroTech</h1>
            <h2 class="text-sm font-semibold mb-6">Login</h2>
            <form action="/login" method="POST" class="space-y-4">
                @csrf
                @method('POST')
                <div class="flex flex-col items-center">
                    <input type="email" name="email" placeholder="Email" required
                        class="border border-gray-300 rounded-lg p-2 w-full mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="relative w-full mb-4">
                        <input id="password" type="password" name="password" placeholder="Password" required
                            class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10">
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                            <i id="passwordIcon" class="fas fa-lock"></i>
                        </button>
                    </div>
                    @if ($errors->has('email'))
                        <div class="mt-4 text-red-500 text-sm">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <div class="flex justify-between mt-4 gap-[200px]">
                        <a href="/forgot-pass" class="text-sm text-gray-800 hover:underline">Lupa Kata Sandi?</a>
                        <a href="/register" class="text-sm text-gray-800 hover:underline">Belum Punya Akun?</a>
                    </div>
                </div>
                <button type="submit"
                    class="bg-green-500 text-white font-semibold py-2 px-4 rounded-xl w-[50%] hover:bg-green-600">Login</button>
        </div>
        </form>

        @if (session('status'))
            <div class="mt-4 text-green-500">
                {{ session('status') }}
            </div>
        @endif
    </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-lock');
                passwordIcon.classList.add('fa-lock-open');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-lock-open');
                passwordIcon.classList.add('fa-lock');
            }
        });
    </script>

    <!-- Footer -->
    @include('asset.footer')
</body>

</html>