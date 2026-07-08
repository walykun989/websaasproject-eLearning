@extends('layouts.app')

@section('title', 'Laporan - Admin')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50">Laporan</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-light text-black">Reports</h2>
        <p class="mt-2 text-sm font-light text-gray-600">Pilih jenis report yang ingin dilihat</p>

        <!-- Reports Grid -->
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Sales Reports -->
            <div class="bg-white border border-gray-200 p-6">
                <h3 class="text-lg font-light text-black mb-4">Sales Reports</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.reports.daily') }}" class="block w-full text-left px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                        Daily Sales
                    </a>
                    <a href="{{ route('admin.reports.monthly') }}" class="block w-full text-left px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                        Monthly Sales
                    </a>
                    <a href="{{ route('admin.reports.yearly') }}" class="block w-full text-left px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                        Yearly Sales
                    </a>
                </div>
            </div>

            <!-- Customer Reports -->
            <div class="bg-white border border-gray-200 p-6">
                <h3 class="text-lg font-light text-black mb-4">Customer Reports</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.reports.customers') }}" class="block w-full text-left px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                        Customer Data
                    </a>
                </div>
            </div>

            <!-- Revenue Reports -->
            <div class="bg-white border border-gray-200 p-6">
                <h3 class="text-lg font-light text-black mb-4">Revenue Reports</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.reports.revenue') }}" class="block w-full text-left px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                        Total Revenue
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
