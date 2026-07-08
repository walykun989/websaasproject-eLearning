@extends('layouts.app')

@section('title', 'Kursus - Admin')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Laporan</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-light text-black">Kelola Kursus</h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center px-4 py-2 bg-black border border-black text-sm font-light text-white hover:opacity-80 transition-opacity">
                    Tambah Kursus
                </a>
            </div>
        </div>

        <div class="mt-8 bg-white border border-gray-200">
            <ul role="list" class="divide-y divide-gray-200">
                @forelse($courses as $course)
                <li>
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center">
                                    <p class="text-sm font-light text-black truncate">{{ $course->title }}</p>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-light {{ $course->is_active ? 'bg-black text-white' : 'border border-black text-black' }}">
                                        {{ $course->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="mt-2 flex items-center text-sm font-light text-gray-600">
                                    <span class="truncate">{{ $course->category->name }}</span>
                                    <span class="mx-2">•</span>
                                    <span>Pengajar: {{ $course->pengajar->name }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $course->materials->count() }} materi</span>
                                </div>
                            </div>
                            <div class="ml-2 flex-shrink-0 flex items-center space-x-2">
                                <a href="{{ route('admin.courses.show', $course) }}" class="text-sm font-light text-black hover:underline">View</a>
                                <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm font-light text-black hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-light text-black hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                @empty
                <li class="px-4 py-8 text-center text-gray-600 font-light">No courses found</li>
                @endforelse
            </ul>
        </div>

        @if($courses->hasPages())
        <div class="mt-4">
            {{ $courses->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
