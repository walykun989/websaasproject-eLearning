@extends('layouts.app')

@section('title', 'Kursus Saya - Pengajar')

@section('nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Private Sessions</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Private Sessions</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <h2 class="text-2xl font-light text-black">Kelas Saya</h2>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('pengajar.courses.create') }}" class="inline-flex items-center px-4 py-2 bg-black border border-black text-sm font-light text-white hover:opacity-80 transition-opacity">
                    Tambah Kelas
                </a>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($courses as $course)
            <div class="bg-white border border-gray-200 hover:border-black">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-light border border-black text-black">
                            {{ $course->category->name }}
                        </span>
                        <span class="text-sm font-light text-gray-600">{{ $course->materials_count }} materi</span>
                    </div>
                    <h3 class="text-lg font-light text-black mt-2">{{ $course->title }}</h3>
                    <p class="mt-2 text-sm font-light text-gray-600 line-clamp-3">{{ $course->description }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm font-light text-gray-600">{{ $course->reviews_count }} reviews</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-light {{ $course->is_active ? 'bg-black text-white' : 'border border-black text-black' }}">
                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="mt-4 flex flex-col sm:flex-row gap-2">
                        <a href="{{ route('pengajar.courses.materials.index', $course) }}" class="flex-1 text-center px-3 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white transition-colors">
                            Materi
                        </a>
                        <a href="{{ route('pengajar.courses.edit', $course) }}" class="flex-1 text-center px-3 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white transition-colors">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-white border border-gray-200 p-8 text-center">
                <p class="text-gray-600 font-light">Anda belum memiliki kelas</p>
                <a href="{{ route('pengajar.courses.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                    Buat Kelas Pertama
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($courses->hasPages())
        <div class="mt-6">
            {{ $courses->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
