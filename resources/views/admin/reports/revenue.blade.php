@extends('layouts.app')

@section('title', 'Laporan Total Pendapatan - Admin')

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
            <h2 class="text-2xl font-light text-black">Total Revenue Report</h2>
            <a href="{{ route('admin.reports.index') }}" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black hover:bg-black hover:text-white">
                ← Back to Reports
            </a>
        </div>

        <!-- All Time Revenue -->
        <div class="mb-6 bg-white border-2 border-black p-6">
            <h3 class="text-lg font-light text-black mb-2">All Time Revenue</h3>
            <p class="text-4xl font-light text-black">Rp {{ number_format($allTimeRevenue, 0, ',', '.') }}</p>
        </div>

        <!-- Time Period Revenue -->
        <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="bg-white border-2 border-black p-5">
                <dt class="text-sm font-light text-gray-600">This Year ({{ now()->year }})</dt>
                <dd class="mt-1 text-2xl font-light text-black">Rp {{ number_format($thisYearRevenue, 0, ',', '.') }}</dd>
            </div>
            <div class="bg-white border-2 border-black p-5">
                <dt class="text-sm font-light text-gray-600">This Month ({{ now()->format('F Y') }})</dt>
                <dd class="mt-1 text-2xl font-light text-black">Rp {{ number_format($thisMonthRevenue, 0, ',', '.') }}</dd>
            </div>
        </div>

        <!-- Revenue by Tier -->
        <div class="bg-white border-2 border-black">
            <div class="p-6">
                <h3 class="text-lg font-light text-black mb-4">Revenue Breakdown by Tier</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-4 border-b-2 border-black">
                        <div>
                            <span class="text-lg font-light text-black">Free Tier</span>
                            <p class="text-sm font-light text-gray-600">Total sales from free tier upgrades</p>
                        </div>
                        <span class="text-2xl font-light text-black">Rp {{ number_format($revenueByTier->get('free', 0), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-4 border-b-2 border-black">
                        <div>
                            <span class="text-lg font-light text-black">Apik Tier</span>
                            <p class="text-sm font-light text-gray-600">Total sales from W.I.B Apik subscriptions</p>
                        </div>
                        <span class="text-2xl font-light text-black">Rp {{ number_format($revenueByTier->get('apik', 0), 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-4">
                        <div>
                            <span class="text-lg font-light text-black">Sangar Tier</span>
                            <p class="text-sm font-light text-gray-600">Total sales from W.I.B Sangar subscriptions</p>
                        </div>
                        <span class="text-2xl font-light text-black">Rp {{ number_format($revenueByTier->get('sangar', 0), 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Tier Percentage -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-light text-gray-600 mb-3">Revenue Distribution</h4>
                    <div class="space-y-2">
                        @php
                            $total = $revenueByTier->sum();
                        @endphp
                        @if($total > 0)
                            <div class="flex items-center">
                                <span class="text-sm font-light text-black w-20">Free:</span>
                                <div class="flex-1 bg-gray-200 h-6 border border-black">
                                    <div class="bg-black h-full" style="width: {{ ($revenueByTier->get('free', 0) / $total) * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-light text-gray-600 w-16 text-right">{{ number_format(($revenueByTier->get('free', 0) / $total) * 100, 1) }}%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm font-light text-black w-20">Apik:</span>
                                <div class="flex-1 bg-gray-200 h-6 border border-black">
                                    <div class="bg-black h-full" style="width: {{ ($revenueByTier->get('apik', 0) / $total) * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-light text-gray-600 w-16 text-right">{{ number_format(($revenueByTier->get('apik', 0) / $total) * 100, 1) }}%</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm font-light text-black w-20">Sangar:</span>
                                <div class="flex-1 bg-gray-200 h-6 border border-black">
                                    <div class="bg-black h-full" style="width: {{ ($revenueByTier->get('sangar', 0) / $total) * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-light text-gray-600 w-16 text-right">{{ number_format(($revenueByTier->get('sangar', 0) / $total) * 100, 1) }}%</span>
                            </div>
                        @else
                            <p class="text-sm font-light text-gray-600">No revenue data available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
