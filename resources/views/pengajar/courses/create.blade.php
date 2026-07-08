@extends('layouts.app')

@section('title', 'Buat Kursus - Pengajar')

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
            <h2 class="text-2xl font-light text-black">Buat Kelas Baru</h2>
        </div>

        <div class="bg-white border border-gray-200 p-6">
            <form method="POST" action="{{ route('pengajar.courses.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-light text-black">Judul Kelas</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('title') border-red-500 @enderror">
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-light text-black">Kategori</label>
                        <select name="category_id" id="category_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('category_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-light text-black">Deskripsi</label>
                        <textarea name="description" id="description" rows="5" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Thumbnail -->
                    <div>
                        <label for="thumbnail" class="block text-sm font-light text-black">Thumbnail (Optional)</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="mt-1 block w-full text-sm font-light text-black file:mr-4 file:py-2 file:px-4 file:border file:border-black file:text-sm file:font-light file:bg-white file:text-black hover:file:bg-black hover:file:text-white @error('thumbnail') border-red-500 @enderror">
                        @error('thumbnail')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Is Active -->
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="h-4 w-4 border-gray-300 bg-white focus:ring-0 focus:ring-offset-0">
                        <label for="is_active" class="ml-2 block text-sm font-light text-black">Kelas Aktif</label>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-4">
                        <a href="{{ route('pengajar.courses.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-light text-black hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-black border border-black text-sm font-light text-white hover:opacity-80 transition-opacity">
                            Buat Kelas
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
