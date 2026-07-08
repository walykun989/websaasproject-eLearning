@extends('layouts.app')

@section('title', 'Pesanan Saya - Peserta')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Berlangganan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('peserta.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Berlangganan</a>
@endsection

@section('content')
<div class="py-6 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-light text-black">Riwayat Pesanan</h2>

        <div class="mt-8 flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-light text-black uppercase">Nomor Pesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-light text-black uppercase">Tier</th>
                                    <th class="px-6 py-3 text-left text-xs font-light text-black uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-light text-black uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-light text-black uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-light text-black uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($orders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-black">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                            {{ ucfirst($order->tier_purchased) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-light">
                                        Rp {{ number_format($order->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-light border
                                            @if($order->status === 'accepted') border-black bg-black text-white
                                            @else border-gray-300 text-black
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-light">
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($order->status === 'pending_payment' && !$order->payment_proof)
                                        <form method="POST" action="{{ route('peserta.orders.upload-proof', $order) }}" enctype="multipart/form-data" class="inline">
                                            @csrf
                                            <input type="file" name="payment_proof" accept="image/*" required class="text-xs">
                                            <button type="submit" class="ml-2 text-black hover:opacity-70 font-light">Upload</button>
                                        </form>
                                        @elseif($order->status === 'rejected')
                                        <p class="text-xs text-gray-600 font-light">{{ $order->rejection_reason }}</p>
                                        @else
                                        <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-600 font-light">
                                        Belum ada pesanan. <a href="{{ route('peserta.pricing') }}" class="text-black hover:opacity-70 underline">Berlangganan sekarang!</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
