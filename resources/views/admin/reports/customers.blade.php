@extends('layouts.app')

@section('title', 'Laporan Data Pelanggan - Admin')

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
            <h2 class="text-2xl font-light text-black">Customer Data Report</h2>
            <a href="{{ route('admin.reports.index') }}" class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black hover:bg-black hover:text-white">
                ← Back to Reports
            </a>
        </div>

        <!-- Total Users -->
        <div class="mb-6 bg-white border-2 border-black p-6">
            <h3 class="text-lg font-light text-black mb-2">Total Users</h3>
            <p class="text-3xl font-light text-black">{{ number_format($userData['total_users']) }}</p>
        </div>

        <!-- User Distribution -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- By Role -->
            <div class="bg-white border-2 border-black p-6">
                <h3 class="text-lg font-light text-black mb-4">Users by Role</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-sm font-light text-gray-600">Admin</span>
                        <span class="text-lg font-light text-black">{{ $userData['by_role']['admin'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-sm font-light text-gray-600">Pengajar</span>
                        <span class="text-lg font-light text-black">{{ $userData['by_role']['pengajar'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-sm font-light text-gray-600">Peserta</span>
                        <span class="text-lg font-light text-black">{{ $userData['by_role']['peserta'] }}</span>
                    </div>
                </div>
            </div>

            <!-- By Tier -->
            <div class="bg-white border-2 border-black p-6">
                <h3 class="text-lg font-light text-black mb-4">Users by Tier</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-sm font-light text-gray-600">Free</span>
                        <span class="text-lg font-light text-black">{{ $userData['by_tier']['free'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-sm font-light text-gray-600">Apik</span>
                        <span class="text-lg font-light text-black">{{ $userData['by_tier']['apik'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="text-sm font-light text-gray-600">Sangar</span>
                        <span class="text-lg font-light text-black">{{ $userData['by_tier']['sangar'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active/Inactive -->
        <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="bg-white border-2 border-black p-5">
                <dt class="text-sm font-light text-gray-600">Active Users</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $userData['active_users'] }}</dd>
            </div>
            <div class="bg-white border-2 border-black p-5">
                <dt class="text-sm font-light text-gray-600">Inactive Users</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $userData['inactive_users'] }}</dd>
            </div>
        </div>

        <!-- Recent Registrations -->
        <div class="bg-white border-2 border-black">
            <div class="p-6">
                <h3 class="text-lg font-light text-black mb-4">Recent Registrations</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Tier</th>
                                <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase">Registered</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($recentRegistrations as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-black">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-black">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                        {{ ucfirst($user->tier) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-light text-gray-600">{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
