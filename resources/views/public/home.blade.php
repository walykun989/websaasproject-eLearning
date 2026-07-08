@extends('layouts.app')

@section('title', 'Home - WIB')

@section('nav-links')
@auth
    @if(auth()->user()->role === 'peserta')
    <a href="{{ route('peserta.dashboard') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Dashboard</a>
    <a href="{{ route('peserta.catalog.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Katalog</a>
    <a href="{{ route('peserta.learning.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pembelajaran Saya</a>
    <a href="{{ route('peserta.orders.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pesanan</a>
    <a href="{{ route('peserta.pricing') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Berlangganan</a>
    @elseif(auth()->user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Dasbor</a>
    <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Kategori</a>
    <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Kelas</a>
    <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pengguna</a>
    <a href="{{ route('admin.payments.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pembayaran</a>
    <a href="{{ route('admin.reports.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Laporan</a>
    @elseif(auth()->user()->role === 'pengajar')
    <a href="{{ route('pengajar.dashboard') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Dashboard</a>
    <a href="{{ route('pengajar.courses.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Kelola Kelas</a>
    <a href="{{ route('pengajar.reviews.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Ulasan</a>
    <a href="{{ route('pengajar.private-sessions.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Sesi Privat</a>
    @endif
@endauth
@endsection

@section('mobile-nav-links')
@auth
    @if(auth()->user()->role === 'peserta')
    <a href="{{ route('peserta.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
    <a href="{{ route('peserta.catalog.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Katalog</a>
    <a href="{{ route('peserta.learning.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembelajaran Saya</a>
    <a href="{{ route('peserta.orders.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pesanan</a>
    <a href="{{ route('peserta.pricing') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Berlangganan</a>
    @elseif(auth()->user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dasbor</a>
    <a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kategori</a>
    <a href="{{ route('admin.courses.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kelas</a>
    <a href="{{ route('admin.users.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pengguna</a>
    <a href="{{ route('admin.payments.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembayaran</a>
    <a href="{{ route('admin.reports.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Laporan</a>
    @elseif(auth()->user()->role === 'pengajar')
    <a href="{{ route('pengajar.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
    <a href="{{ route('pengajar.courses.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kelola Kelas</a>
    <a href="{{ route('pengajar.reviews.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Ulasan</a>
    <a href="{{ route('pengajar.private-sessions.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Sesi Privat</a>
    @endif
@else
    <a href="{{ route('login') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Login</a>
    <a href="{{ route('register') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Daftar</a>
@endauth
@endsection

@section('content')
<div class="relative bg-white overflow-hidden border-b border-gray-200">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32">
            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                <div class="text-center">
                    <h1 class="text-4xl tracking-tight font-light text-black sm:text-5xl md:text-6xl">
                        <span class="block">Waktu Informatika</span>
                        <span class="block">Belajar</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base font-light text-gray-600 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        Platform e-learning terbaik untuk menguasai teknologi informatika. Belajar dari pengajar berpengalaman dengan metode yang praktis dan efektif.
                    </p>
                    <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8 gap-3">
                        <a href="{{ route('catalog') }}" class="w-full flex items-center justify-center px-8 py-3 border border-black text-base font-light text-black hover:bg-black hover:text-white transition-colors md:py-4 md:text-lg md:px-10">
                            Lihat Katalog
                        </a>
                        @guest
                        <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 text-base font-light text-white bg-black hover:bg-gray-800 transition-colors md:py-4 md:text-lg md:px-10 mt-3 sm:mt-0">
                            Daftar Gratis
                        </a>
                        @endguest
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-white py-12 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
            <div class="bg-white border border-gray-200">
                <div class="px-4 py-5 sm:p-6 text-center">
                    <dt class="text-sm font-light text-gray-600 truncate">Total Kelas</dt>
                    <dd class="mt-1 text-3xl font-light text-black">{{ $stats['total_courses'] }}</dd>
                </div>
            </div>
            <div class="bg-white border border-gray-200">
                <div class="px-4 py-5 sm:p-6 text-center">
                    <dt class="text-sm font-light text-gray-600 truncate">Kategori</dt>
                    <dd class="mt-1 text-3xl font-light text-black">{{ $stats['total_categories'] }}</dd>
                </div>
            </div>
            <div class="bg-white border border-gray-200">
                <div class="px-4 py-5 sm:p-6 text-center">
                    <dt class="text-sm font-light text-gray-600 truncate">Total Materi</dt>
                    <dd class="mt-1 text-3xl font-light text-black">{{ $stats['total_materials'] }}</dd>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Section -->
<div class="bg-white py-12 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-light text-black">Kategori Kelas</h2>
            <p class="mt-4 text-lg font-light text-gray-600">Pilih kategori yang sesuai dengan minat Anda</p>
        </div>
        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($categories as $category)
            <div class="bg-white border border-gray-200 hover:border-black transition-colors">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-light text-black">{{ $category->name }}</h3>
                    <p class="mt-2 text-sm font-light text-gray-600">{{ $category->courses_count }} kelas</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Featured Courses Section -->
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-light text-black">Kelas Terbaru</h2>
            <p class="mt-4 text-lg font-light text-gray-600">Mulai belajar dari kelas-kelas terbaik kami</p>
        </div>
        <div class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($featuredCourses as $course)
            <div class="bg-white border border-gray-200 hover:border-black transition-colors">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-light text-black">{{ $course->title }}</h3>
                    <p class="mt-2 text-sm font-light text-gray-600">{{ Str::limit($course->description, 100) }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm font-light text-black">{{ $course->category->name }}</span>
                        <span class="text-sm font-light text-gray-600">{{ $course->materials_count }} materi</span>
                    </div>
                    <a href="{{ auth()->check() ? route('peserta.catalog.show', $course->slug) : route('login') }}" class="mt-4 block w-full text-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
