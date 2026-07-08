@extends('layouts.app')

@section('title', 'Edit Kursus - Admin')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('content')
<div class="py-12 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.courses.index') }}" class="text-sm text-black hover:opacity-70 font-light">
                ← Kembali ke Kursus
            </a>
        </div>

        <div class="bg-cyan-50 border-2 border-black">
            <div class="px-6 py-8">
                <h3 class="text-lg leading-6 font-light text-black">Edit Kursus</h3>

                <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="category_id" class="block text-sm font-light text-black">Kategori</label>
                        <select name="category_id" id="category_id" required class="mt-1 block w-full border-2 border-black px-3 py-2 bg-white text-black font-light focus:outline-none focus:border-black">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pengajar_id" class="block text-sm font-light text-black">Pengajar</label>
                        <select name="pengajar_id" id="pengajar_id" required class="mt-1 block w-full border-2 border-black px-3 py-2 bg-white text-black font-light focus:outline-none focus:border-black">
                            <option value="">Pilih Pengajar</option>
                            @foreach($pengajars as $pengajar)
                            <option value="{{ $pengajar->id }}" {{ old('pengajar_id', $course->pengajar_id) == $pengajar->id ? 'selected' : '' }}>{{ $pengajar->name }}</option>
                            @endforeach
                        </select>
                        @error('pengajar_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-light text-black">Judul Kursus</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" required
                               class="mt-1 block w-full border-2 border-black px-3 py-2 bg-white text-black font-light focus:outline-none focus:border-black">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-light text-black">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $course->slug) }}"
                               class="mt-1 block w-full border-2 border-black px-3 py-2 bg-white text-black font-light focus:outline-none focus:border-black">
                        <p class="mt-1 text-sm text-gray-600 font-light">Kosongkan untuk generate otomatis dari judul</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-light text-black">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" required
                                  class="mt-1 block w-full border-2 border-black px-3 py-2 bg-white text-black font-light focus:outline-none focus:border-black">{{ old('description', $course->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($course->thumbnail)
                    <div>
                        <label class="block text-sm font-light text-black">Current Thumbnail</label>
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Current thumbnail" class="mt-2 max-w-xs border-2 border-black">
                    </div>
                    @endif

                    <div>
                        <label for="thumbnail" class="block text-sm font-light text-black">Thumbnail {{ $course->thumbnail ? '(Upload new to replace)' : '' }}</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                               class="mt-1 block w-full text-sm text-black font-light file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black file:text-sm file:font-light file:bg-white file:text-black hover:file:bg-black hover:file:text-white">
                        @error('thumbnail')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $course->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 border-2 border-black focus:ring-0">
                        <label for="is_active" class="ml-2 block text-sm font-light text-black">Active</label>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black bg-white hover:opacity-80">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
