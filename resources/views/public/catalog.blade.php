@extends('layouts.app')

@section('title', 'Public Catalog - WIB')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <h2 class="text-3xl font-light text-black">Jelajahi Semua Kelas</h2>
            <p class="mt-4 text-lg font-light text-gray-600">Pilih kelas yang ingin Anda pelajari</p>
        </div>

        <!-- Filters -->
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <form method="GET" class="flex-1 max-w-xs flex gap-2">
                <select name="category" onchange="this.form.submit()" class="block flex-1 pl-3 pr-10 py-2 text-base font-light border border-gray-300 bg-white text-black focus:outline-none focus:border-black">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Courses Grid -->
        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($courses as $course)
            <div class="bg-white border border-gray-200 hover:border-black transition-colors">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="inline-flex items-center px-3 py-0.5 text-sm font-light border border-black text-black">
                            {{ $course->category->name }}
                        </span>
                        <span class="text-sm font-light text-gray-600">{{ $course->materials_count }} materi</span>
                    </div>
                    <h3 class="mt-2 text-lg font-light text-black">{{ $course->title }}</h3>
                    <p class="mt-3 text-sm font-light text-gray-600 line-clamp-3">{{ $course->description }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm font-light text-gray-600">Pengajar: <span class="font-normal text-black">{{ $course->pengajar->name }}</span></p>
                    </div>
                    @auth
                    <a href="{{ route('peserta.catalog.show', $course->slug) }}" class="mt-4 block w-full text-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white transition-colors">
                        Lihat Detail
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="mt-4 block w-full text-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white transition-colors">
                        Login untuk Lihat
                    </a>
                    @endauth
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
        <div class="mt-8">
            {{ $courses->links() }}
        </div>
    </div>
</div>
@endsection
