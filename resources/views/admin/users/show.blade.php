@extends('layouts.app')

@section('title', 'Detail Pengguna - Admin')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-light text-black">Detail User</h2>
            <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                    Edit User
                </a>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                    Kembali
                </a>
            </div>
        </div>

        <!-- User Info -->
        <div class="bg-white border border-gray-200 p-6">
            <h3 class="text-lg font-light text-black mb-4">Informasi User</h3>
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-light text-gray-600">Nama</dt>
                    <dd class="mt-1 text-sm font-light text-black">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Email</dt>
                    <dd class="mt-1 text-sm font-light text-black">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Role</dt>
                    <dd class="mt-1">
                        <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                            {{ ucfirst($user->role) }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Tier</dt>
                    <dd class="mt-1">
                        <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                            {{ ucfirst($user->tier) }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Status</dt>
                    <dd class="mt-1">
                        <span class="px-2 inline-flex text-xs leading-5 font-light {{ $user->is_active ? 'bg-black text-white' : 'border border-black text-black' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Terdaftar Sejak</dt>
                    <dd class="mt-1 text-sm font-light text-black">{{ $user->created_at->format('d M Y') }}</dd>
                </div>
            </dl>
        </div>

        <!-- Stats -->
        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Total Orders</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $stats['total_orders'] }}</dd>
            </div>
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Total Spent</dt>
                <dd class="mt-1 text-2xl font-light text-black">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</dd>
            </div>
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Courses Reviewed</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $stats['courses_reviewed'] }}</dd>
            </div>
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Certificates Earned</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $stats['certificates_earned'] }}</dd>
            </div>

            @if($user->role === 'pengajar')
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Courses Taught</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $stats['courses_taught'] }}</dd>
            </div>
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Total Materials</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $stats['total_materials'] }}</dd>
            </div>
            @endif
        </div>

        <!-- Recent Orders -->
        @if($user->orders->isNotEmpty())
        <div class="mt-6 bg-white border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-light text-black mb-4">Recent Orders</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Tier</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($user->orders->take(5) as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-black">{{ ucfirst($order->tier_purchased) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-black">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
