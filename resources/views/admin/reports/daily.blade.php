@extends('layouts.app')

@section('title', 'Laporan Penjualan Harian - Admin')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-light text-black">Daily Sales Report</h2>
            <a href="{{ route('admin.reports.index') }}" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black hover:bg-black hover:text-white">
                ← Back to Reports
            </a>
        </div>

        <!-- Date Filter -->
        <div class="mb-6 bg-white border-2 border-black p-4">
            <form method="GET" action="{{ route('admin.reports.daily') }}" class="flex items-end gap-4">
                <div class="flex-1">
                    <label for="date" class="block text-sm font-light text-black mb-2">Select Date</label>
                    <input type="date" name="date" id="date" value="{{ $date }}"
                           class="block w-full border-2 border-black px-3 py-2 bg-white text-black font-light focus:outline-none focus:border-black">
                </div>
                <button type="submit" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80">
                    Filter
                </button>
            </form>
        </div>

        <!-- Revenue Summary -->
        <div class="mb-6 bg-white border-2 border-black p-6">
            <h3 class="text-lg font-light text-black mb-4">Total Revenue for {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h3>
            <p class="text-3xl font-light text-black">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="mt-2 text-sm font-light text-gray-600">{{ $sales->count() }} transaction(s)</p>
        </div>

        <!-- Sales Table -->
        <div class="bg-white border-2 border-black">
            <div class="p-6">
                <h3 class="text-lg font-light text-black mb-4">Transactions</h3>
                @if($sales->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Order Number</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">User</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Tier</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Time</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($sales as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-black">{{ $order->order_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-black">{{ $order->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                        {{ ucfirst($order->tier_purchased) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-black">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-gray-600">{{ $order->verified_at->format('H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-center py-8 text-sm font-light text-gray-600">No sales for this date</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
