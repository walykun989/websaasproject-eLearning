@extends('layouts.app')

@section('title', 'Sertifikat - ' . $certificate->course->title)

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
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('peserta.certificates.index') }}" class="text-sm font-light text-black hover:opacity-70">
                ← Kembali ke Sertifikat
            </a>
        </div>

        <div class="bg-cyan-50 border-2 border-black overflow-hidden transition-colors duration-200">
            <div class="px-4 py-5 sm:px-6 border-b-2 border-black">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg leading-6 font-light text-black">Sertifikat Kelulusan</h3>
                        <p class="mt-1 max-w-2xl text-sm font-light text-gray-600">{{ $certificate->course->title }}</p>
                    </div>
                    <div>
                        <a href="{{ route('peserta.certificates.download', $certificate->certificate_number) }}" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80 transition-opacity">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t-2 border-black px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-light text-gray-600">Nama Peserta</dt>
                        <dd class="mt-1 text-sm font-light text-black sm:mt-0 sm:col-span-2">{{ $certificate->user->name }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-light text-gray-600">Kelas</dt>
                        <dd class="mt-1 text-sm font-light text-black sm:mt-0 sm:col-span-2">{{ $certificate->course->title }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-light text-gray-600">Pengajar</dt>
                        <dd class="mt-1 text-sm font-light text-black sm:mt-0 sm:col-span-2">{{ $certificate->course->pengajar->name }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-light text-gray-600">Nomor Sertifikat</dt>
                        <dd class="mt-1 text-sm font-light text-black sm:mt-0 sm:col-span-2 font-mono">{{ $certificate->certificate_number }}</dd>
                    </div>
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-light text-gray-600">Tanggal Terbit</dt>
                        <dd class="mt-1 text-sm font-light text-black sm:mt-0 sm:col-span-2">{{ $certificate->issued_at->format('d F Y') }}</dd>
                    </div>
                </dl>
            </div>

            @if($certificate->file_path)
            <div class="border-t-2 border-black px-4 py-5 sm:px-6">
                <div class="border-2 border-black bg-white p-8 text-center transition-colors duration-200">
                    <svg class="mx-auto h-12 w-12 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-light text-black">Sertifikat PDF</h3>
                    <p class="mt-1 text-sm font-light text-gray-600">Klik tombol download di atas untuk mendapatkan sertifikat dalam format PDF</p>
                </div>
            </div>
            @endif
        </div>

        <div class="mt-6 bg-white border-2 border-black p-4 transition-colors duration-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-light text-black">
                        Sertifikat ini dapat diverifikasi keasliannya dengan menggunakan nomor sertifikat di atas.
                        Simpan sertifikat ini dengan baik sebagai bukti pencapaian pembelajaran Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
