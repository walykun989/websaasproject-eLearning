@extends('layouts.app')

@section('title', 'Sertifikat - Peserta')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pesanan</a>
<a href="{{ route('peserta.certificates.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Sertifikat</a>
<a href="{{ route('peserta.pricing') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Berlangganan</a>
@endsection

@section('content')
<div class="py-6 bg-white transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-light text-black">Sertifikat Saya</h2>
        <p class="mt-1 text-sm text-gray-600 font-light">Sertifikat resmi dari kelas yang telah Anda selesaikan</p>

        <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($certificates as $certificate)
            <div class="bg-white border-2 border-black overflow-hidden hover:shadow-lg transition-all duration-200">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <svg class="h-10 w-10 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-light text-black">{{ $certificate->course->title }}</h3>
                    <p class="mt-2 text-sm text-gray-600 font-light">{{ $certificate->certificate_number }}</p>
                    <p class="mt-3 text-xs text-gray-600 font-light">Diterbitkan: {{ $certificate->issued_at->format('d F Y') }}</p>
                    <a href="{{ route('peserta.certificates.show', $certificate->id) }}" class="mt-4 block text-center px-4 py-2 bg-black text-white text-sm font-light hover:opacity-80 transition-opacity">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="mt-2 text-sm text-gray-600 font-light">Belum ada sertifikat. Selesaikan kelas dan submit review untuk mendapatkan sertifikat!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
