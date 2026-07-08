@extends('layouts.app')

@section('title', 'Detail Kursus - Admin')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-light text-black">Detail Kursus</h2>
            <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                <a href="{{ route('admin.courses.edit', $course) }}" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black hover:bg-black hover:text-white">
                    Edit Kursus
                </a>
                <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black hover:bg-black hover:text-white">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Course Info -->
        <div class="bg-white border-2 border-black p-6 mb-6">
            <h3 class="text-lg font-light text-black mb-4">Informasi Kursus</h3>

            @if($course->thumbnail)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full max-w-md border-2 border-black">
            </div>
            @endif

            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <dt class="text-sm font-light text-gray-600">Judul</dt>
                    <dd class="mt-1 text-lg font-light text-black">{{ $course->title }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Kategori</dt>
                    <dd class="mt-1 text-sm font-light text-black">{{ $course->category->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Pengajar</dt>
                    <dd class="mt-1 text-sm font-light text-black">{{ $course->pengajar->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Slug</dt>
                    <dd class="mt-1 text-sm font-light text-black">{{ $course->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Status</dt>
                    <dd class="mt-1">
                        <span class="px-2 inline-flex text-xs leading-5 font-light {{ $course->is_active ? 'bg-black text-white' : 'border border-black text-black' }}">
                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-light text-gray-600">Dibuat</dt>
                    <dd class="mt-1 text-sm font-light text-black">{{ $course->created_at->format('d M Y') }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-light text-gray-600">Deskripsi</dt>
                    <dd class="mt-1 text-sm font-light text-black">{{ $course->description }}</dd>
                </div>
            </dl>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-6">
            <div class="bg-white border-2 border-black p-5">
                <dt class="text-sm font-light text-gray-600">Total Materials</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $course->materials->count() }}</dd>
            </div>
            <div class="bg-white border-2 border-black p-5">
                <dt class="text-sm font-light text-gray-600">Total Enrollments</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $course->enrollments->count() }}</dd>
            </div>
            <div class="bg-white border-2 border-black p-5">
                <dt class="text-sm font-light text-gray-600">Average Rating</dt>
                <dd class="mt-1 text-2xl font-light text-black">
                    {{ $course->reviews->count() > 0 ? number_format($course->reviews->avg('rating'), 1) : 'N/A' }}
                </dd>
            </div>
        </div>

        <!-- Materials List -->
        @if($course->materials->isNotEmpty())
        <div class="bg-white border-2 border-black">
            <div class="p-6">
                <h3 class="text-lg font-light text-black mb-4">Materi Kursus</h3>
                <div class="space-y-2">
                    @foreach($course->materials->sortBy('order') as $material)
                    <div class="flex items-center justify-between py-3 px-4 border border-gray-200">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm font-light text-gray-600">{{ $material->order }}.</span>
                            <div>
                                <p class="text-sm font-light text-black">{{ $material->title }}</p>
                                <p class="text-xs font-light text-gray-600">{{ ucfirst($material->type) }}</p>
                            </div>
                        </div>
                        <span class="px-2 inline-flex text-xs leading-5 font-light {{ $material->is_free ? 'border border-black text-black' : 'bg-black text-white' }}">
                            {{ $material->is_free ? 'Free' : 'Premium' }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="bg-white border-2 border-black p-6 text-center">
            <p class="text-sm font-light text-gray-600">Belum ada materi untuk kursus ini</p>
        </div>
        @endif
    </div>
</div>
@endsection
