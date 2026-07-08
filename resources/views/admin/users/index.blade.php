@extends('layouts.app')

@section('title', 'Pengguna - Admin')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Laporan</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <h2 class="text-2xl font-light text-black">Kelola Users</h2>
        </div>

        <!-- Filters -->
        <div class="mt-6 flex flex-col sm:flex-row gap-4">
            <form method="GET" class="flex-1 flex gap-4">
                <select name="role" onchange="this.form.submit()" class="block w-full max-w-xs pl-3 pr-10 py-2 text-base font-light border border-gray-300 bg-white text-black focus:outline-none focus:border-black">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pengajar" {{ request('role') == 'pengajar' ? 'selected' : '' }}>Pengajar</option>
                    <option value="peserta" {{ request('role') == 'peserta' ? 'selected' : '' }}>Peserta</option>
                </select>

                <select name="tier" onchange="this.form.submit()" class="block w-full max-w-xs pl-3 pr-10 py-2 text-base font-light border border-gray-300 bg-white text-black focus:outline-none focus:border-black">
                    <option value="">Semua Tier</option>
                    <option value="free" {{ request('tier') == 'free' ? 'selected' : '' }}>Free</option>
                    <option value="apik" {{ request('tier') == 'apik' ? 'selected' : '' }}>Apik</option>
                    <option value="sangar" {{ request('tier') == 'sangar' ? 'selected' : '' }}>Sangar</option>
                </select>

                <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari user..." class="block w-full pl-3 pr-10 py-2 border border-gray-300 leading-5 placeholder-gray-500 text-black font-light focus:outline-none focus:border-black bg-white">

                <button type="submit" class="inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                    Filter
                </button>
            </form>
        </div>

        <!-- Users Table -->
        <div class="mt-8 bg-white border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase tracking-wider">Tier</th>
                        <th class="px-6 py-3 text-left text-xs font-light text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-light text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-light text-black">{{ $user->name }}</div>
                            <div class="text-sm font-light text-gray-600">{{ $user->email }}</div>
                        </td>
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-light {{ $user->is_active ? 'bg-black text-white' : 'border border-black text-black' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-light space-x-2">
                            <a href="{{ route('admin.users.show', $user) }}" class="text-black hover:underline">View</a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-black hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="text-black hover:underline">
                                    {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-600 font-light">Tidak ada user ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="mt-6">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
