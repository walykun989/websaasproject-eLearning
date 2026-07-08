@extends('layouts.app')

@section('title', 'Checkout - Tier {{ ucfirst($tier) }}')

@section('content')
<div class="py-12 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border border-gray-200">
            <div class="px-4 py-5 sm:p-6">
                <h2 class="text-2xl font-light text-black">Checkout - Tier {{ ucfirst($tier) }}</h2>
                <p class="mt-1 text-sm font-light text-gray-600">Selesaikan pembayaran untuk upgrade tier Anda</p>

                <div class="mt-6 border-t border-gray-200 pt-6">
                    <dl class="divide-y divide-gray-200">
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-light text-gray-600">Tier yang dipilih</dt>
                            <dd class="mt-1 text-sm text-black sm:mt-0 sm:col-span-2">
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-light border border-black text-black">
                                    {{ ucfirst($tier) }}
                                </span>
                            </dd>
                        </div>

                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-light text-gray-600">Total Pembayaran</dt>
                            <dd class="mt-1 text-2xl font-light text-black sm:mt-0 sm:col-span-2">
                                Rp {{ number_format($amount, 0, ',', '.') }}
                            </dd>
                        </div>

                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-light text-gray-600">Benefit</dt>
                            <dd class="mt-1 text-sm font-light text-black sm:mt-0 sm:col-span-2">
                                <ul class="list-disc list-inside space-y-1">
                                    @if($tier === 'apik')
                                    <li>Akses penuh semua materi tier Apik</li>
                                    <li>Sertifikat resmi setelah menyelesaikan kelas</li>
                                    <li>Custom theme & border untuk profil</li>
                                    @else
                                    <li>Semua benefit tier Apik</li>
                                    <li>Akses materi eksklusif tier Sangar</li>
                                    <li>Sesi privat dengan pengajar</li>
                                    <li>Priority support</li>
                                    @endif
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>

                <form method="POST" action="{{ route('peserta.checkout.process') }}" class="mt-6">
                    @csrf
                    <input type="hidden" name="tier" value="{{ $tier }}">

                    <div class="bg-white border border-gray-200 p-4 mb-6">
                        <div class="flex">
                            <svg class="h-5 w-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="ml-3">
                                <h3 class="text-sm font-light text-black">Informasi Pembayaran</h3>
                                <div class="mt-2 text-sm font-light text-gray-600">
                                    <p>Setelah klik "Lanjutkan ke Pembayaran", Anda akan menerima instruksi transfer bank dan nomor order. Upload bukti transfer untuk verifikasi admin.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('peserta.pricing') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-light text-black bg-white hover:bg-gray-50">
                            Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-black text-base font-light text-white bg-black hover:opacity-80 transition-opacity">
                            Lanjutkan ke Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
