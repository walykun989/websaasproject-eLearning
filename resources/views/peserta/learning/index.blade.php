@extends('layouts.app')

@section('title', 'Pembelajaran Saya - Peserta')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Berlangganan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('peserta.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Berlangganan</a>
@endsection

@section('content')
<div class="py-6 bg-white transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-light leading-7 text-black sm:text-3xl">
                    Kelas Saya
                </h2>
                <p class="mt-1 text-sm text-gray-600 font-light">Lanjutkan belajar dari kelas yang sedang kamu ikuti</p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('peserta.catalog.index') }}" class="inline-flex items-center px-4 py-2 border border-black text-sm font-light text-white bg-black hover:opacity-80 transition-opacity">
                    Jelajahi Kelas
                </a>
            </div>
        </div>

        @if($enrolledCourses->count() > 0)
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($enrolledCourses as $course)
            <div class="bg-white overflow-hidden shadow border border-gray-200 hover:shadow-lg transition-all duration-200">
                <a href="{{ route('peserta.catalog.show', $course->slug) }}" class="block">
                    @if($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover hover:opacity-90 transition-opacity">
                    @else
                    <div class="w-full h-48 bg-black hover:opacity-90 transition-opacity"></div>
                    @endif
                </a>
                <div class="p-5">
                    <a href="{{ route('peserta.catalog.show', $course->slug) }}" class="block hover:opacity-70 transition-opacity">
                        <h3 class="text-lg font-light text-black truncate">{{ $course->title }}</h3>
                    </a>
                    <p class="mt-1 text-sm text-gray-600 font-light">{{ $course->category->name }}</p>

                    <div class="mt-4">
                        <div class="flex items-center justify-between text-sm text-gray-600 font-light mb-2">
                            <span>Progress</span>
                            <span>{{ $course->progress_percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 h-2">
                            <div class="bg-black h-2 transition-all duration-300" style="width: {{ $course->progress_percentage }}%"></div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('peserta.learning.course', $course->slug) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-black text-sm font-light bg-black text-white hover:opacity-80 transition-opacity">
                            Lanjutkan Belajar
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="mt-8 bg-white shadow border border-gray-200 transition-colors duration-200">
            <div class="px-4 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <h3 class="mt-2 text-sm font-light text-black">Belum ada kelas</h3>
                <p class="mt-1 text-sm text-gray-600 font-light">Mulai belajar dengan memilih kelas dari katalog</p>
                <div class="mt-6">
                    <a href="{{ route('peserta.catalog.index') }}" class="inline-flex items-center px-4 py-2 border border-black text-sm font-light bg-black text-white hover:opacity-80 transition-opacity">
                        Jelajahi Katalog
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
