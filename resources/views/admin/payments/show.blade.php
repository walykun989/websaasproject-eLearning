@extends('layouts.app')

@section('title', 'Verifikasi Bukti Pembayaran')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border-2 border-black overflow-hidden">
            <!-- Header -->
            <div class="px-4 py-5 sm:p-6 border-b-2 border-black">
                <h2 class="text-2xl font-light text-black">Verifikasi Bukti Transfer</h2>
                <p class="mt-1 text-sm font-light text-gray-600">Order: {{ $order->order_number }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                <!-- Order Details -->
                <div>
                    <h3 class="text-lg font-light text-black mb-4">Informasi Pesanan</h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-light text-gray-600">Pengguna</dt>
                            <dd class="mt-1 text-sm font-light text-black">{{ $order->user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-light text-gray-600">Email</dt>
                            <dd class="mt-1 text-sm font-light text-black">{{ $order->user->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-light text-gray-600">Tier yang Dibeli</dt>
                            <dd class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                    {{ ucfirst($order->tier_purchased) }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-light text-gray-600">Jumlah</dt>
                            <dd class="mt-1 text-2xl font-light text-black">Rp {{ number_format($order->amount, 0, ',', '.') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-light text-gray-600">Tanggal Pesanan</dt>
                            <dd class="mt-1 text-sm font-light text-black">{{ $order->created_at->format('d M Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Payment Proof -->
                <div>
                    <h3 class="text-lg font-light text-black mb-4">Bukti Transfer</h3>
                    @if($order->payment_proof)
                    <div class="bg-white border-2 border-black p-4 mb-4">
                        <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Payment Proof" class="max-w-full h-auto border border-gray-200">
                    </div>
                    @else
                    <p class="text-sm font-light text-gray-600">Belum ada bukti transfer</p>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="px-4 py-4 sm:px-6 bg-white border-t-2 border-black flex justify-end gap-3">
                <form method="POST" action="{{ route('admin.payments.reject', $order) }}" class="inline">
                    @csrf
                    <input type="hidden" name="rejection_reason" value="Bukti transfer tidak valid">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black bg-white hover:opacity-80">
                        Tolak
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.payments.verify', $order) }}" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-6 py-2 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80">
                        Verifikasi & Aktifkan Tier
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
