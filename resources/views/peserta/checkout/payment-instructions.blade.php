@extends('layouts.app')

@section('title', 'Instruksi Pembayaran')

@section('content')
<div class="py-6 bg-white min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-cyan-50 border-2 border-black">
            <div class="px-4 py-5 sm:p-6">
                <div class="text-center mb-6">
                    <svg class="mx-auto h-12 w-12 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h2 class="mt-2 text-2xl font-light text-black">Order Berhasil Dibuat!</h2>
                    <p class="mt-1 text-sm font-light text-gray-600">Order Number: <span class="font-light">{{ $order->order_number }}</span></p>
                </div>

                <div class="border-t-2 border-b-2 border-black py-6">
                    <h3 class="text-lg font-light text-black mb-4">Instruksi Pembayaran</h3>

                    <div class="bg-white border-2 border-black p-4 mb-4">
                        <p class="text-sm font-light text-gray-600">Total Pembayaran</p>
                        <p class="text-3xl font-light text-black">Rp {{ number_format($order->amount, 0, ',', '.') }}</p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h4 class="text-sm font-light text-black">Transfer ke Rekening:</h4>
                            <div class="mt-2 bg-white border-2 border-black p-4">
                                <p class="text-sm font-light text-gray-600"><span class="font-light text-black">Bank:</span> BCA</p>
                                <p class="text-sm font-light text-gray-600"><span class="font-light text-black">No. Rekening:</span> 1234567890</p>
                                <p class="text-sm font-light text-gray-600"><span class="font-light text-black">Atas Nama:</span> PT Waktu Informatika Belajar</p>
                            </div>
                        </div>

                        <div class="bg-white border-2 border-black p-4">
                            <h4 class="text-sm font-light text-black">⚠️ Penting:</h4>
                            <ul class="mt-2 text-sm font-light text-gray-600 list-disc list-inside space-y-1">
                                <li>Transfer sejumlah TEPAT Rp {{ number_format($order->amount, 0, ',', '.') }}</li>
                                <li>Simpan bukti transfer Anda</li>
                                <li>Upload bukti transfer di halaman Pesanan</li>
                                <li>Pesanan akan diverifikasi dalam 1x24 jam</li>
                                <li>Tier akan otomatis aktif setelah verifikasi</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-lg font-light text-black mb-4">Upload Bukti Transfer</h3>
                    <form method="POST" action="{{ route('peserta.orders.upload-proof', $order) }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label class="block text-sm font-light text-gray-600">
                                Upload foto/screenshot bukti transfer (JPG, PNG, max 2MB)
                            </label>
                            <input type="file" name="payment_proof" accept="image/jpeg,image/png" required
                                class="mt-1 block w-full text-sm text-gray-600 font-light file:mr-4 file:py-2 file:px-4 file:border file:border-gray-300 file:text-sm file:font-light file:bg-white file:text-black hover:file:bg-gray-50">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('peserta.orders.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-light text-gray-600 bg-white hover:text-black transition-colors">
                                Upload Nanti
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 border border-black text-sm font-light text-white bg-black hover:opacity-70 transition-opacity">
                                Upload Bukti Transfer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
