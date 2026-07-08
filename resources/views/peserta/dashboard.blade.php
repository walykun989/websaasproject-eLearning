@extends('layouts.app')

@section('title', 'Dashboard - Peserta')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="text-gray-600 hover:text-black inline-flex items-center px-3 py-2 text-sm font-light transition-colors">Berlangganan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('peserta.dashboard') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Berlangganan</a>
@endsection

@section('content')
<div class="py-6 bg-white transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-light leading-7 text-black sm:text-3xl sm:truncate">
                    Dashboard Peserta
                </h2>
                <p class="mt-1 text-sm font-light text-gray-600">Selamat datang kembali, {{ auth()->user()->name }}!</p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                @if(auth()->user()->tier === 'free')
                <a href="{{ route('peserta.pricing') }}" class="inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white transition-colors">
                    Upgrade Tier
                </a>
                @else
                <span class="inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black bg-white">
                    Tier: {{ ucfirst(auth()->user()->tier) }}
                </span>
                @endif
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white border border-gray-200 transition-colors duration-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-light text-gray-600 truncate">Kelas Diikuti</dt>
                                <dd class="text-lg font-light text-black">{{ $stats['courses_enrolled'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 transition-colors duration-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-light text-gray-600 truncate">Materi Selesai</dt>
                                <dd class="text-lg font-light text-black">{{ $stats['materials_completed'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 transition-colors duration-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-light text-gray-600 truncate">Sertifikat</dt>
                                <dd class="text-lg font-light text-black">{{ $stats['certificates_earned'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 transition-colors duration-200">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-light text-gray-600 truncate">Review Diberikan</dt>
                                <dd class="text-lg font-light text-black">{{ $stats['reviews_submitted'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Progress -->
        <div class="mt-8">
            <h3 class="text-lg leading-6 font-light text-black">Aktivitas Terakhir</h3>
            <div class="mt-4 bg-white border border-gray-200 transition-colors duration-200">
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse($recentProgress as $progress)
                    <li>
                        <a href="{{ route('peserta.learning.course', $progress->material->course->slug) }}" class="block hover:bg-gray-50 transition-colors duration-150">
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-light text-black truncate">
                                        {{ $progress->material->course->title }}
                                    </p>
                                    <div class="ml-2 flex-shrink-0 flex">
                                        <p class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                            {{ $progress->is_completed ? 'Selesai' : 'Berlangsung' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-2 sm:flex sm:justify-between">
                                    <div class="sm:flex">
                                        <p class="text-sm font-light text-gray-600">
                                            {{ $progress->material->title }}
                                        </p>
                                    </div>
                                    <div class="mt-2 flex items-center text-sm font-light text-gray-600 sm:mt-0">
                                        <p>
                                            Terakhir diakses: {{ $progress->last_accessed_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    @empty
                    <li class="px-4 py-8 text-center font-light text-gray-600">
                        <p>Belum ada aktivitas. <a href="{{ route('peserta.catalog.index') }}" class="text-black hover:opacity-70">Mulai belajar sekarang!</a></p>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Certificates -->
        @if($certificates->count() > 0)
        <div class="mt-8">
            <h3 class="text-lg leading-6 font-light text-black">Sertifikat Terbaru</h3>
            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($certificates as $certificate)
                <div class="bg-white border border-gray-200 transition-colors duration-200">
                    <div class="px-4 py-5 sm:p-6">
                        <h4 class="text-sm font-light text-black">{{ $certificate->course->title }}</h4>
                        <p class="mt-1 text-sm font-light text-gray-600">{{ $certificate->certificate_number }}</p>
                        <p class="mt-1 text-xs font-light text-gray-600">Diterbitkan: {{ $certificate->issued_at->format('d M Y') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
