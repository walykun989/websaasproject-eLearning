@extends('layouts.app')

@section('title', 'Katalog Kelas - Peserta')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Berlangganan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('peserta.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Berlangganan</a>
@endsection

@section('content')
<div class="py-6 bg-white transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <h2 class="text-2xl font-light text-black">Katalog Kelas</h2>
        </div>

        <!-- Filters -->
        <div class="mt-4 flex flex-col sm:flex-row gap-4">
            <form method="GET" class="flex-1 flex flex-col sm:flex-row gap-4">
                <select name="category" onchange="this.form.submit()" class="block w-full sm:max-w-xs pl-3 pr-10 py-2 text-base font-light border border-gray-300 bg-white text-black focus:outline-none focus:border-black transition-colors">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>

                <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari kelas..." class="block w-full pl-3 pr-10 py-2 border border-gray-300 leading-5 placeholder-gray-500 text-black font-light focus:outline-none focus:placeholder-gray-400 focus:border-black transition-colors" style="background-color: #E0F2F1 !important;">

                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white transition-colors whitespace-nowrap">
                    Filter
                </button>
            </form>
        </div>

        <!-- Courses Grid -->
        <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($courses as $course)
            <div class="bg-white border border-gray-200 hover:border-black transition-colors duration-200">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-light border border-black text-black">
                            {{ $course->category->name }}
                        </span>
                        <span class="text-sm font-light text-gray-600">{{ $course->materials_count }} materi</span>
                    </div>
                    <h3 class="text-lg font-light text-black mt-2">{{ $course->title }}</h3>
                    <p class="mt-2 text-sm font-light text-gray-600 line-clamp-3">{{ $course->description }}</p>
                    <div class="mt-4">
                        <p class="text-sm font-light text-gray-600">Pengajar: {{ $course->pengajar->name }}</p>
                    </div>
                    <a href="{{ route('peserta.catalog.show', $course->slug) }}" class="mt-4 block w-full text-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="mt-2 text-sm font-light text-gray-600">Tidak ada kelas ditemukan</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection
