<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WIB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center transition-colors duration-200">
    <div class="max-w-md w-full space-y-8 p-8 bg-white border border-gray-200">
        <div>
            <h2 class="text-center text-3xl font-light text-black">Masuk ke Akun Anda</h2>
            <p class="mt-2 text-center text-sm font-light text-gray-600">Selamat Datang Kembali di WIB</p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            @if ($errors->any())
                <div class="bg-black border border-black text-white px-4 py-3 font-light">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="bg-white border border-black text-black px-4 py-3 text-sm font-light">
                    {{ session('status') }}
                </div>
            @endif

            <div>
                <label for="email" class="block text-sm font-light text-black">Email</label>
                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black transition-colors">
            </div>

            <div>
                <label for="password" class="block text-sm font-light text-black">Password</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black transition-colors">
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 border-gray-300 focus:ring-0 focus:ring-offset-0">
                    <label for="remember" class="ml-2 block text-sm font-light text-black">Ingat saya</label>
                </div>

                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-light text-black hover:opacity-70">Lupa password?</a>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-black text-sm font-light text-black hover:bg-black hover:text-white focus:outline-none transition-colors">
                    Masuk
                </button>
            </div>

            <div class="text-center text-sm font-light">
                <span class="text-gray-600">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="font-light text-black hover:opacity-70 ml-1">Daftar</a>
            </div>
        </form>
    </div>
</body>
</html>
