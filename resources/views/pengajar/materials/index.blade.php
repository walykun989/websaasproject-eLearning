@extends('layouts.app')

@section('title', 'Materials - ' . $course->title)

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
        <div class="md:flex md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-light text-black">Materi: {{ $course->title }}</h2>
                <p class="mt-1 text-sm font-light text-gray-600">{{ $materials->count() }} materi</p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                <a href="{{ route('pengajar.courses.materials.create', $course) }}" class="inline-flex items-center px-4 py-2 bg-black border border-black text-sm font-light text-white hover:opacity-80 transition-opacity">
                    Tambah Materi
                </a>
                <a href="{{ route('pengajar.courses.index') }}" class="inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                    Kembali ke Courses
                </a>
            </div>
        </div>

        <!-- Materials List -->
        <div class="bg-white border border-gray-200">
            @forelse($materials as $material)
            <div class="border-b border-gray-200 last:border-b-0 p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-light text-gray-600">#{{ $material->order }}</span>
                            <h3 class="text-lg font-light text-black">{{ $material->title }}</h3>
                            <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                {{ ucfirst($material->content_type) }}
                            </span>
                            <span class="px-2 inline-flex text-xs leading-5 font-light border border-black text-black">
                                {{ ucfirst($material->tier_required) }}
                            </span>
                            <span class="px-2 inline-flex text-xs leading-5 font-light {{ $material->is_published ? 'bg-black text-white' : 'border border-black text-black' }}">
                                {{ $material->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                        @if($material->duration_minutes)
                        <p class="mt-1 text-sm font-light text-gray-600">Duration: {{ $material->duration_minutes }} menit</p>
                        @endif
                    </div>
                    <div class="ml-4 flex space-x-2">
                        <a href="{{ route('pengajar.courses.materials.edit', [$course, $material]) }}" class="inline-flex items-center px-3 py-1 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('pengajar.courses.materials.destroy', [$course, $material]) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-red-600 text-sm font-light text-red-600 hover:bg-red-600 hover:text-white">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <p class="text-gray-600 font-light">Belum ada materi untuk kelas ini</p>
                <a href="{{ route('pengajar.courses.materials.create', $course) }}" class="mt-4 inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                    Tambah Materi Pertama
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
