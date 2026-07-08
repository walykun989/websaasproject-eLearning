@extends('layouts.app')

@section('title', $category->name . ' - Katalog')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Berlangganan</a>
@endsection

@section('content')
<div class="py-6 bg-white transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('peserta.catalog.index') }}" class="text-sm font-light text-black hover:opacity-70">
                ← Kembali ke Katalog
            </a>
        </div>

        <div class="md:flex md:items-center md:justify-between">
            <h2 class="text-2xl font-light text-black">Kategori: {{ $category->name }}</h2>
        </div>

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
                <p class="mt-2 text-sm font-light text-gray-600">Tidak ada kelas dalam kategori ini</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection
