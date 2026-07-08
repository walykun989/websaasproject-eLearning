@extends('layouts.app')

@section('title', 'Berlangganan - Peserta')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Berlangganan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('peserta.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50">Berlangganan</a>
@endsection

@section('content')
<style>
    /* Premium Sangar Glow Animation - Luxury Gold Theme */
    /* Only triggers on HOVER */
    @keyframes sangarGlow {
        0%, 100% {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3),
                        0 0 20px rgba(255, 183, 0, 0.5),
                        0 0 30px rgba(218, 165, 32, 0.4),
                        inset 0 0 15px rgba(255, 215, 0, 0.2);
        }
        50% {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.4),
                        0 0 30px rgba(255, 191, 0, 0.7),
                        0 0 45px rgba(255, 140, 0, 0.5),
                        inset 0 0 20px rgba(255, 165, 0, 0.25);
        }
    }

    /* Particle Animation */
    @keyframes particle {
        0% {
            transform: translateY(0) translateX(0) scale(0);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-80px) translateX(var(--x-offset, 0)) scale(1);
            opacity: 0;
        }
    }

    /* Base state - no animation, keep overflow hidden to contain shine */
    .sangar-premium {
        position: relative;
        overflow: hidden !important;
        transition: box-shadow 0.3s ease;
    }

    /* Hover state - trigger animations but keep overflow hidden */
    .sangar-premium:hover {
        animation: sangarGlow 3s ease-in-out infinite;
    }

    /* Particle container */
    .sangar-premium::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        pointer-events: none;
        z-index: -1;
    }

    /* Create particles - only animate on hover */
    .sangar-premium::after {
        content: '';
        position: absolute;
        width: 3px;
        height: 3px;
        background: radial-gradient(circle, #ffb700 0%, transparent 70%);
        border-radius: 50%;
        top: 100%;
        left: 10%;
        opacity: 0;
        pointer-events: none;
        box-shadow:
            30px 0 0 0 #ffd700,
            60px -15px 0 0 #ffbf00,
            90px 10px 0 0 #ff9500,
            120px -20px 0 0 #daa520,
            150px 15px 0 0 #ff8c00,
            180px -10px 0 0 #ff7f00,
            210px 20px 0 0 #b8860b,
            240px 0 0 0 #ffa500;
    }

    .sangar-premium:hover::after {
        animation: particle 3s infinite;
    }

    /* Shine effect - constrained within card boundaries */
    .sangar-premium .shine-effect {
        position: absolute;
        top: 0;
        left: -50%;
        width: 30%;
        height: 100%;
        background: linear-gradient(90deg,
            transparent,
            rgba(255, 215, 0, 0.4),
            rgba(255, 191, 0, 0.3),
            transparent);
        pointer-events: none;
        z-index: 10;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sangar-premium:hover .shine-effect {
        opacity: 1;
        animation: shine 2.5s ease-in-out infinite;
    }

    /* Shine animation - complete sweep with full exit */
    @keyframes shine {
        0% {
            left: -50%;
        }
        100% {
            left: 110%;
        }
    }

    /* Additional floating particles - contained within card */
    @keyframes float1 {
        0%, 100% { transform: translate(0, 0) scale(0.8); opacity: 0.5; }
        50% { transform: translate(15px, -30px) scale(1); opacity: 0.8; }
    }

    @keyframes float2 {
        0%, 100% { transform: translate(0, 0) scale(0.6); opacity: 0.4; }
        50% { transform: translate(-20px, -35px) scale(1); opacity: 0.8; }
    }

    @keyframes float3 {
        0%, 100% { transform: translate(0, 0) scale(0.7); opacity: 0.5; }
        50% { transform: translate(10px, -30px) scale(1); opacity: 0.8; }
    }

    .sangar-particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: radial-gradient(circle, #ffd700, #ff9500);
        border-radius: 50%;
        pointer-events: none;
        filter: blur(1px);
        box-shadow: 0 0 6px rgba(255, 191, 0, 0.7);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    /* Only animate particles on hover */
    .sangar-premium:hover .sangar-particle {
        opacity: 1;
    }

    .sangar-premium:hover .sangar-particle:nth-child(1) {
        animation: float1 4s ease-in-out infinite;
    }

    .sangar-premium:hover .sangar-particle:nth-child(2) {
        animation: float2 5s ease-in-out infinite 0.5s;
    }

    .sangar-premium:hover .sangar-particle:nth-child(3) {
        animation: float3 4.5s ease-in-out infinite 1s;
    }

    .sangar-premium:hover .sangar-particle:nth-child(4) {
        animation: float1 5.5s ease-in-out infinite 1.5s;
    }

    .sangar-premium:hover .sangar-particle:nth-child(5) {
        animation: float2 4s ease-in-out infinite 2s;
    }

    .sangar-premium:hover .sangar-particle:nth-child(6) {
        animation: float3 5s ease-in-out infinite 0.8s;
    }

    .sangar-particle:nth-child(1) {
        top: 20%;
        left: 10%;
        background: radial-gradient(circle, #ffbf00, #daa520);
    }

    .sangar-particle:nth-child(2) {
        top: 40%;
        right: 15%;
        background: radial-gradient(circle, #ff8c00, #b8860b);
    }

    .sangar-particle:nth-child(3) {
        bottom: 30%;
        left: 20%;
        background: radial-gradient(circle, #ffd700, #ffa500);
    }

    .sangar-particle:nth-child(4) {
        bottom: 50%;
        right: 10%;
        background: radial-gradient(circle, #ff9500, #ff7f00);
    }

    .sangar-particle:nth-child(5) {
        top: 60%;
        left: 50%;
        background: radial-gradient(circle, #daa520, #ffbf00);
    }

    .sangar-particle:nth-child(6) {
        top: 10%;
        right: 30%;
        background: radial-gradient(circle, #b8860b, #ff8c00);
    }

    /* Always-on animation for Sangar subscribers (no hover required) */
    .sangar-premium-active {
        position: relative;
        overflow: hidden !important;
        animation: sangarGlow 3s ease-in-out infinite;
    }

    .sangar-premium-active::after {
        animation: particle 3s infinite;
    }

    .sangar-premium-active .shine-effect {
        opacity: 1;
        animation: shine 2.5s ease-in-out infinite;
    }

    .sangar-premium-active .sangar-particle {
        opacity: 1;
    }

    .sangar-premium-active .sangar-particle:nth-child(1) {
        animation: float1 4s ease-in-out infinite;
    }

    .sangar-premium-active .sangar-particle:nth-child(2) {
        animation: float2 5s ease-in-out infinite 0.5s;
    }

    .sangar-premium-active .sangar-particle:nth-child(3) {
        animation: float3 4.5s ease-in-out infinite 1s;
    }

    .sangar-premium-active .sangar-particle:nth-child(4) {
        animation: float1 5.5s ease-in-out infinite 1.5s;
    }

    .sangar-premium-active .sangar-particle:nth-child(5) {
        animation: float2 4s ease-in-out infinite 2s;
    }

    .sangar-premium-active .sangar-particle:nth-child(6) {
        animation: float3 5s ease-in-out infinite 0.8s;
    }
</style>

<div class="py-12 bg-white transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        @if(auth()->user()->tier === 'free')
        <div class="text-center">
            <h2 class="text-3xl font-light text-black sm:text-4xl">
                Pilih Tier yang Sesuai
            </h2>
            <p class="mt-4 text-xl text-gray-600 font-light">
                Berlangganan untuk akses penuh ke semua materi pembelajaran
            </p>
        </div>
        @endif

        @if(session('paywall'))
        <div class="mt-8 max-w-2xl mx-auto bg-white border border-black p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-light text-black">
                        Materi Terkunci
                    </h3>
                    <p class="mt-1 text-sm text-gray-600 font-light">
                        Anda telah mencapai batas materi gratis. Berlangganan untuk melanjutkan pembelajaran.
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Check if user is already subscribed -->
        @if(auth()->user()->tier === 'sangar')
        <!-- Sangar Subscription Status with Always-On Premium Effects -->
        <div class="mt-12 max-w-3xl mx-auto">
            <div class="bg-white border-2 border-black p-8 shadow-lg sangar-premium-active" style="position: relative;">
                <div class="shine-effect"></div>
                <!-- Floating particles -->
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>

                <div class="text-center mb-6" style="position: relative; z-index: 20;">
                    <h3 class="text-2xl font-light text-black">Anda Berlangganan W. I. B Sangar</h3>
                    <p class="mt-2 text-gray-600 font-light">Nikmati akses penuh dengan fitur premium terbaik</p>
                </div>

                <div class="mt-6" style="position: relative; z-index: 20;">
                    <h4 class="text-lg font-light text-black mb-4">Benefit yang Anda Dapatkan:</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <svg class="flex-shrink-0 h-6 w-6 text-black mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 font-light">Akses penuh ke semua materi pembelajaran</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="flex-shrink-0 h-6 w-6 text-black mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 font-light">Sertifikat resmi untuk semua kelas</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="flex-shrink-0 h-6 w-6 text-black mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 font-light">Custom border style untuk profil</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="flex-shrink-0 h-6 w-6 text-black mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 font-light">Sesi privat dengan pengajar</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="flex-shrink-0 h-6 w-6 text-black mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 font-light">Priority support</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @elseif(auth()->user()->tier === 'apik')
        <!-- Apik Subscription Status -->
        <div class="mt-12 max-w-3xl mx-auto space-y-6">
            <div class="bg-white border-2 border-black p-8 shadow-lg">
                <div class="text-center mb-6">
                    <h3 class="text-2xl font-light text-black">Anda Berlangganan W. I. B Apik</h3>
                    <p class="mt-2 text-gray-600 font-light">Nikmati akses penuh ke semua kelas</p>
                </div>

                <div class="mt-6">
                    <h4 class="text-lg font-light text-black mb-4">Benefit yang Anda Dapatkan:</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <svg class="flex-shrink-0 h-6 w-6 text-black mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 font-light">Akses penuh ke semua materi pembelajaran</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="flex-shrink-0 h-6 w-6 text-black mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-600 font-light">Sertifikat resmi untuk semua kelas</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Upgrade to Sangar Option with Hover Premium Effects -->
            <div class="bg-white border-2 border-black p-6 shadow-lg sangar-premium" style="position: relative;">
                <div class="shine-effect"></div>
                <!-- Floating particles -->
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>

                <div style="position: relative; z-index: 20;">
                    <h4 class="text-lg font-light text-black mb-2">Tingkatkan ke W. I. B Sangar</h4>
                    <p class="text-gray-600 font-light mb-4">Dapatkan fitur eksklusif dan sesi privat dengan pengajar</p>
                    <a href="{{ route('peserta.checkout', 'sangar') }}" class="inline-block px-6 py-2 bg-black text-white font-light hover:opacity-80 transition-opacity">
                        Upgrade ke W. I. B Sangar
                    </a>
                </div>
            </div>
        </div>

        @else
        <!-- Free tier - show all pricing options -->
        <!-- Pricing Cards -->
        <div class="mt-12 space-y-4 sm:mt-16 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-6 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 xl:grid-cols-3">
            <!-- Free Tier -->
            <div class="border border-gray-300 shadow-sm divide-y divide-gray-200 bg-white transition-colors duration-200">
                <div class="p-6">
                    <h2 class="text-lg leading-6 font-light text-black">Gratisan</h2>
                    <p class="mt-4 text-sm text-gray-600 font-light">Akses terbatas untuk mencoba</p>
                    <p class="mt-8">
                        <span class="text-4xl font-light text-black">Rp 0</span>
                    </p>
                    <a href="#" class="mt-8 block w-full bg-gray-200 border border-gray-300 py-2 text-sm font-light text-gray-600 text-center cursor-not-allowed">
                        Tier Anda Saat Ini
                    </a>
                </div>
                <div class="pt-6 pb-8 px-6">
                    <h3 class="text-xs font-light text-black tracking-wide uppercase">Yang Termasuk</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li class="flex space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-light">3 materi gratis per kelas</span>
                        </li>
                        <li class="flex space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-light">Akses semua kategori</span>
                        </li>
                        <li class="flex space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-light">Tidak ada sertifikat</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Apik Tier -->
            <div class="border-2 border-black shadow-lg divide-y divide-gray-200 bg-white relative transform hover:scale-105 transition-all duration-200">
                <div class="absolute top-0 left-0 right-0 bg-black text-white text-xs font-light uppercase py-1 text-center">
                    Populer
                </div>
                <div class="p-6 pt-10">
                    <h2 class="text-lg leading-6 font-light text-black">W. I. B Apik</h2>
                    <p class="mt-4 text-sm text-gray-600 font-light">Akses penuh ke semua kelas</p>
                    <p class="mt-8">
                        <span class="text-4xl font-light text-black">Rp 12.345</span>
                        <span class="text-base font-light text-gray-600">/bulan</span>
                    </p>
                    <a href="{{ route('peserta.checkout', 'apik') }}" class="mt-8 block w-full bg-black border border-black py-2 text-sm font-light text-white text-center hover:opacity-80 transition-opacity">
                        Pilih Tier W. I. B Apik
                    </a>
                </div>
                <div class="pt-6 pb-8 px-6">
                    <h3 class="text-xs font-light text-black tracking-wide uppercase">Yang Termasuk</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li class="flex space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-light">Akses penuh semua materi</span>
                        </li>
                        <li class="flex space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-light">Sertifikat resmi</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Sangar Tier - Premium with Hover Effects -->
            <div class="border-2 border-black shadow-2xl divide-y divide-gray-200 bg-white relative transform hover:scale-105 transition-transform duration-200 sangar-premium">
                <div class="shine-effect"></div>
                <!-- Floating particles -->
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>
                <div class="sangar-particle"></div>

                <div class="absolute top-0 left-0 right-0 bg-black text-white text-xs font-light uppercase py-2 text-center" style="z-index: 20;">
                    Most Premium
                </div>
                <div class="p-6 pt-12" style="position: relative; z-index: 20;">
                    <h2 class="text-lg leading-6 font-light text-black">W. I. B Sangar</h2>
                    <p class="mt-4 text-sm text-gray-600 font-light">Pengalaman belajar premium terbaik</p>
                    <p class="mt-8">
                        <span class="text-5xl font-light text-black">Rp 67.891</span>
                        <span class="text-base font-light text-gray-600">/bulan</span>
                    </p>
                    <a href="{{ route('peserta.checkout', 'sangar') }}" class="mt-8 block w-full bg-black border border-black py-3 text-sm font-light text-white text-center hover:opacity-80 transition-opacity">
                        Pilih Tier W. I. B Sangar
                    </a>
                </div>
                <div class="pt-6 pb-8 px-6">
                    <h3 class="text-xs font-light text-black tracking-wide uppercase">Yang Termasuk</h3>
                    <ul role="list" class="mt-6 space-y-4">
                        <li class="flex space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-light">Semua fitur Tier W. I. B Apik</span>
                        </li>
                        <li class="flex space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-light">Custom border style profil</span>
                        </li>
                        <li class="flex space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-light">Sesi privat dengan pengajar</span>
                        </li>
                        <li class="flex space-x-3">
                            <svg class="flex-shrink-0 h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-light">Priority support</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
