@extends('layouts.app')

@section('title', 'Ulasan - Pengajar')

@section('nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Private Sessions</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Private Sessions</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-light text-black">Reviews Kelas Saya</h2>

        <!-- Courses with Reviews -->
        <div class="mt-8 space-y-6">
            @forelse($courses as $course)
            <div class="bg-white border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-light text-black">{{ $course->title }}</h3>
                        <p class="mt-1 text-sm font-light text-gray-600">{{ $course->reviews_count }} ulasan</p>
                    </div>
                    <a href="{{ route('pengajar.reviews.show', $course) }}" class="inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                        Lihat Semua Ulasan
                    </a>
                </div>

                <!-- Recent Reviews -->
                @if($course->reviews->isNotEmpty())
                <div class="mt-4 space-y-4">
                    @foreach($course->reviews->take(3) as $review)
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    <x-avatar-with-decoration :user="$review->user" size="w-5 h-5" :showBadge="false" />
                                    <span class="text-sm font-light text-black">{{ $review->user->name }}</span>
                                    @if($review->user->tier === 'sangar')
                                    <span class="px-1 py-0.5 text-[9px] font-light bg-black text-white border border-black">SANGAR</span>
                                    @endif
                                    <span class="text-sm font-light text-gray-600">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="mt-1 flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-black' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <p class="mt-2 text-sm font-light text-gray-600">{{ $review->comment }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-sm font-light text-gray-600">Belum ada ulasan untuk kelas ini</p>
                @endif
            </div>
            @empty
            <div class="bg-white border border-gray-200 p-8 text-center">
                <p class="text-gray-600 font-light">Anda belum memiliki kelas</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
