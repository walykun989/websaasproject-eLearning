@extends('layouts.app')

@section('title', 'Review - ' . $course->title)

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('peserta.learning.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembelajaran Saya</a>
@endsection

@section('content')
<div class="py-6 bg-white transition-colors duration-200">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-cyan-50 border-2 border-black transition-colors duration-200">
            <div class="px-6 py-8">
                <h2 class="text-2xl font-light text-black">Berikan Review untuk Kelas Ini</h2>
                <p class="mt-1 text-sm font-light text-gray-600">Review Anda sangat membantu kami meningkatkan kualitas kelas</p>

                <form method="POST" action="{{ route('peserta.review.store', $course->slug) }}" class="mt-6 space-y-6">
                    @csrf

                    <div>
                        <label for="rating" class="block text-sm font-light text-black">Rating</label>
                        <div class="mt-2 flex items-center space-x-2">
                            @for($i = 1; $i <= 5; $i++)
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" required class="sr-only star-input">
                                <svg class="h-8 w-8 text-gray-300 hover:text-black transition star-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </label>
                            @endfor
                        </div>
                        @error('rating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="comment" class="block text-sm font-light text-black">Komentar</label>
                        <textarea id="comment" name="comment" rows="5" required class="mt-1 block w-full border-2 border-black px-3 py-2 bg-white text-black font-light placeholder-gray-500 focus:outline-none focus:border-black transition-colors"></textarea>
                        <p class="mt-1 text-xs font-light text-gray-600">Minimum 10 karakter</p>
                        @error('comment')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-white border-2 border-black p-4 transition-colors duration-200">
                        <p class="text-sm font-light text-black">
                            <strong class="font-light">Catatan:</strong> Review Anda diperlukan untuk mendapatkan sertifikat kelulusan. Setelah mengirim review, Anda dapat langsung generate sertifikat Anda.
                        </p>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('peserta.learning.course', $course->slug) }}" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black bg-white hover:opacity-80 transition-opacity">
                            Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80 transition-opacity">
                            Kirim Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const stars = document.querySelectorAll('.star-input');
        const icons = document.querySelectorAll('.star-icon');

        stars.forEach((star, index) => {
            star.addEventListener('change', () => {
                icons.forEach((icon, iconIndex) => {
                    if (iconIndex <= index) {
                        icon.classList.remove('text-gray-300');
                        icon.classList.add('text-black');
                    } else {
                        icon.classList.remove('text-black');
                        icon.classList.add('text-gray-300');
                    }
                });
            });
        });
    });
</script>
@endsection
