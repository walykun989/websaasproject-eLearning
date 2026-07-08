<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WIB</title>
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
            <h2 class="text-center text-3xl font-light text-black">Buat Akun Anda</h2>
            <p class="mt-2 text-center text-sm font-light text-gray-600">Bergabung dengan Waktu Informatika Belajar</p>
        </div>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
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

            <div>
                <label for="name" class="block text-sm font-light text-black">Nama Lengkap</label>
                <input id="name" name="name" type="text" required value="{{ old('name') }}"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black transition-colors">
            </div>

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

            <div>
                <label for="password_confirmation" class="block text-sm font-light text-black">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black transition-colors">
            </div>

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-black text-sm font-light text-black hover:bg-black hover:text-white focus:outline-none transition-colors">
                    Daftar
                </button>
            </div>

            <div class="text-center text-sm font-light">
                <span class="text-gray-600">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="font-light text-black hover:opacity-70 ml-1">Masuk</a>
            </div>
        </form>
    </div>
</body>
</html>
