@extends('layouts.app')

@section('title', 'Dashboard - Admin')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Laporan</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-light text-black">Admin Dashboard</h2>

        <!-- Stats Grid -->
        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white border-2 border-black">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 border border-black p-3">
                            <svg class="h-6 w-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-light text-gray-600 truncate">Total Pengguna</dt>
                                <dd class="text-lg font-light text-black">{{ $stats['total_users'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border-2 border-black">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 border-2 border-black p-3">
                            <svg class="h-6 w-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-light text-gray-600 truncate">Total Pendapatan</dt>
                                <dd class="text-lg font-light text-black">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border-2 border-black">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 border-2 border-black p-3">
                            <svg class="h-6 w-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-light text-gray-600 truncate">Pembayaran Tertunda</dt>
                                <dd class="text-lg font-light text-black">{{ $stats['pending_payments'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border-2 border-black">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 border-2 border-black p-3">
                            <svg class="h-6 w-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-light text-gray-600 truncate">Kursus Aktif</dt>
                                <dd class="text-lg font-light text-black">{{ $stats['active_courses'] }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="mt-8">
            <h3 class="text-lg font-light text-black">Pesanan Terbaru</h3>
            <div class="mt-4 bg-white border border-gray-200">
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse($recentOrders as $order)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-light text-black">{{ $order->order_number }}</p>
                                <div class="ml-2 flex-shrink-0">
                                    <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex">
                                    <p class="text-sm font-light text-gray-600">{{ $order->user->name }} - Tier {{ ucfirst($order->tier_purchased) }}</p>
                                </div>
                                <div class="mt-2 flex items-center text-sm font-light text-gray-600 sm:mt-0">
                                    <p>Rp {{ number_format($order->amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="px-4 py-8 text-center font-light text-gray-600">Tidak ada pesanan terbaru</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
