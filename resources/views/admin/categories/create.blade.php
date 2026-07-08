@extends('layouts.app')

@section('title', 'Tambah Kategori - Admin')

@section('nav-links')
<a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dasbor</a>
<a href="{{ route('admin.categories.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kategori</a>
<a href="{{ route('admin.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Kursus</a>
<a href="{{ route('admin.users.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pengguna</a>
<a href="{{ route('admin.payments.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembayaran</a>
<a href="{{ route('admin.reports.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Laporan</a>
@endsection

@section('content')
<div class="py-12 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-black hover:opacity-70 font-light">
                ← Kembali ke Kategori
            </a>
        </div>

        <div class="bg-cyan-50 border-2 border-black">
            <div class="px-6 py-8">
                <h3 class="text-lg leading-6 font-light text-black">Tambah Kategori Baru</h3>

                <form method="POST" action="{{ route('admin.categories.store') }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-light text-black">Nama Kategori</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full border-2 border-black px-3 py-2 bg-white text-black font-light focus:outline-none focus:border-black">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-light text-black">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                               class="mt-1 block w-full border-2 border-black px-3 py-2 bg-white text-black font-light focus:outline-none focus:border-black">
                        <p class="mt-1 text-sm text-gray-600 font-light">Kosongkan untuk generate otomatis dari nama</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-light text-black">Deskripsi</label>
                        <textarea name="description" id="description" rows="3"
                                  class="mt-1 block w-full border-2 border-black px-3 py-2 bg-white text-black font-light focus:outline-none focus:border-black">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="h-4 w-4 border-2 border-black focus:ring-0">
                        <label for="is_active" class="ml-2 block text-sm font-light text-black">Active</label>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black bg-white hover:opacity-80">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
