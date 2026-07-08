@extends('layouts.app')

@section('title', 'Buat Materi - Pengajar')

@section('nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Private Sessions</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-light text-black">Tambah Materi</h2>
                <p class="mt-1 text-sm font-light text-gray-600">{{ $course->title }}</p>
            </div>
        </div>

        <div class="bg-white border border-gray-200 p-6">
            <form method="POST" action="{{ route('pengajar.courses.materials.store', $course) }}">
                @csrf

                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-light text-black">Judul Materi</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('title') border-red-500 @enderror">
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Type -->
                    <div>
                        <label for="content_type" class="block text-sm font-light text-black">Tipe Konten</label>
                        <select name="content_type" id="content_type" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('content_type') border-red-500 @enderror">
                            <option value="">Pilih Tipe</option>
                            <option value="video" {{ old('content_type') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="text" {{ old('content_type') == 'text' ? 'selected' : '' }}>Text</option>
                        </select>
                        @error('content_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-light text-black">Konten (URL untuk video, atau teks untuk text)</label>
                        <textarea name="content" id="content" rows="5" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                        @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tier Required -->
                    <div>
                        <label for="tier_required" class="block text-sm font-light text-black">Tier yang Dibutuhkan</label>
                        <select name="tier_required" id="tier_required" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('tier_required') border-red-500 @enderror">
                            <option value="">Pilih Tier</option>
                            <option value="free" {{ old('tier_required') == 'free' ? 'selected' : '' }}>Free</option>
                            <option value="apik" {{ old('tier_required') == 'apik' ? 'selected' : '' }}>Apik</option>
                            <option value="sangar" {{ old('tier_required') == 'sangar' ? 'selected' : '' }}>Sangar</option>
                        </select>
                        @error('tier_required')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration_minutes" class="block text-sm font-light text-black">Durasi (menit) - Optional</label>
                        <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes') }}" min="1" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('duration_minutes') border-red-500 @enderror">
                        @error('duration_minutes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Is Published -->
                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="h-4 w-4 border-gray-300 bg-white focus:ring-0 focus:ring-offset-0">
                        <label for="is_published" class="ml-2 block text-sm font-light text-black">Publish Materi</label>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-4">
                        <a href="{{ route('pengajar.courses.materials.index', $course) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-light text-black hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-black border border-black text-sm font-light text-white hover:opacity-80 transition-opacity">
                            Buat Materi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
