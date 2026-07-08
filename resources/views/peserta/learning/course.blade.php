@extends('layouts.app')

@section('title', $course->title . ' - Pembelajaran Saya')

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
<div class="py-12 bg-white transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('peserta.learning.index') }}" class="text-sm text-black hover:opacity-70 font-light">
                ← Kembali ke Pembelajaran Saya
            </a>
        </div>

        <div class="bg-cyan-50 border-2 border-black transition-colors duration-200">
            <div class="px-4 py-6 sm:px-6 sm:py-8">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <h3 class="text-xl sm:text-2xl leading-6 font-light text-black">{{ $course->title }}</h3>
                        <p class="mt-2 text-sm text-gray-600 font-light">{{ $course->category->name }}</p>
                        <p class="mt-3 text-sm text-gray-600 font-light">{{ $course->description }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-gray-600 font-light">
                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Pengajar: {{ $course->pengajar->name }}
                </div>
            </div>

            <div class="border-t-2 border-black px-4 py-6 sm:px-6">
                <h4 class="text-lg font-light text-black mb-6">Materi Kelas</h4>

                @if($materials->count() > 0)
                <ul role="list" class="space-y-3">
                    @foreach($materials as $index => $material)
                    <li class="bg-white border border-black p-3 sm:p-4">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center justify-center h-10 w-10 border border-black
                                        @if($material->user_progress && $material->user_progress->is_completed)
                                            bg-black text-white
                                        @else
                                            bg-white text-black
                                        @endif">
                                        @if($material->user_progress && $material->user_progress->is_completed)
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @else
                                            <span class="text-sm font-light">{{ $index + 1 }}</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-light text-black">{{ $material->title }}</p>
                                    <div class="flex flex-wrap items-center gap-2 mt-1 text-sm text-gray-600 font-light">
                                        <div class="flex items-center">
                                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $material->duration_minutes }} menit
                                        </div>
                                        @if($material->tier_required !== 'free')
                                            <span class="inline-flex items-center px-2 py-0.5 border border-black text-xs font-light bg-white text-black">
                                                Tier {{ ucfirst($material->tier_required) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                @if($material->is_accessible)
                                    <a href="{{ route('peserta.learning.material', ['slug' => $course->slug, 'material' => $material->id]) }}"
                                       class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 border border-black text-sm font-light text-white bg-black hover:opacity-80 transition-opacity">
                                        @if($material->user_progress && $material->user_progress->is_completed)
                                            Ulangi
                                        @else
                                            Mulai
                                        @endif
                                    </a>
                                @else
                                    <button type="button" disabled class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 border border-gray-300 text-sm font-light text-gray-400 bg-gray-100 cursor-not-allowed">
                                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        Terkunci
                                    </button>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-sm text-gray-600 font-light">Belum ada materi tersedia untuk kelas ini.</p>
                @endif

                @php
                    $hasCompleted = auth()->user()->hasCompletedCourse($course);
                    $hasReviewed = auth()->user()->hasReviewedCourse($course);
                    $hasCertificate = auth()->user()->certificates()->where('course_id', $course->id)->exists();
                @endphp

                @if($hasCompleted)
                <div class="mt-6 pt-6 border-t-2 border-black">
                    <div class="bg-white border border-black p-4 sm:p-6">
                        <div class="flex flex-col sm:flex-row items-start gap-4">
                            <div class="flex-shrink-0">
                                <svg class="h-10 w-10 sm:h-12 sm:w-12 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-base sm:text-lg font-light text-black mb-2">Selamat! Anda telah menyelesaikan kelas ini</h4>
                                <p class="text-sm text-gray-600 font-light mb-4">
                                    Anda telah menyelesaikan semua materi yang dapat diakses.
                                    @if(!$hasReviewed)
                                    Berikan review untuk mendapatkan sertifikat Anda.
                                    @elseif(!$hasCertificate)
                                    Klaim sertifikat Anda sekarang!
                                    @else
                                    Sertifikat Anda sudah dibuat.
                                    @endif
                                </p>
                                <div class="flex flex-col sm:flex-row gap-3">
                                    @if(!$hasReviewed)
                                    <a href="{{ route('peserta.review.create', $course->slug) }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80 transition-opacity">
                                        Berikan Review
                                    </a>
                                    @elseif(!$hasCertificate)
                                    <a href="{{ route('peserta.certificates.generate', $course->slug) }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80 transition-opacity">
                                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                        Klaim Sertifikat
                                    </a>
                                    @else
                                    <a href="{{ route('peserta.certificates.index') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-black text-sm font-light text-black bg-white hover:bg-black hover:text-white transition-colors">
                                        Lihat Sertifikat Saya
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
