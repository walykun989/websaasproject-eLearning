@extends('layouts.app')

@section('title', 'Reviews - ' . $course->title)

@section('nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Private Sessions</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-2xl font-light text-black">{{ $course->title }}</h2>
                <p class="mt-1 text-sm font-light text-gray-600">Ulasan untuk kelas ini</p>
            </div>
            <a href="{{ route('pengajar.reviews.index') }}" class="inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                Kembali
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3 mb-8">
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Total Ulasan</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $stats['total_reviews'] }}</dd>
            </div>
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Rata-rata Rating</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ number_format($stats['average_rating'], 1) }} / 5.0</dd>
            </div>
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Distribusi Rating</dt>
                <dd class="mt-1 space-y-1">
                    @for($i = 5; $i >= 1; $i--)
                    <div class="flex items-center text-sm">
                        <span class="font-light text-black w-8">{{ $i }}</span>
                        <div class="flex-1 mx-2 bg-gray-200 h-2">
                            @php
                            $count = $stats['rating_distribution'][$i] ?? 0;
                            $percentage = $stats['total_reviews'] > 0 ? ($count / $stats['total_reviews']) * 100 : 0;
                            @endphp
                            <div class="bg-black h-2" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="font-light text-gray-600 w-8 text-right">{{ $count }}</span>
                    </div>
                    @endfor
                </dd>
            </div>
        </div>

        <!-- Reviews List -->
        <div class="bg-white border border-gray-200">
            <div class="divide-y divide-gray-200">
                @forelse($reviews as $review)
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2">
                                <x-avatar-with-decoration :user="$review->user" size="w-5 h-5" :showBadge="false" />
                                <span class="text-sm font-light text-black">{{ $review->user->name }}</span>
                                @if($review->user->tier === 'sangar')
                                <span class="px-1 py-0.5 text-[9px] font-light bg-black text-white border border-black">SANGAR</span>
                                @endif
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-black' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-sm font-light text-gray-600">{{ $review->created_at->format('d M Y') }}</span>
                            </div>
                            <p class="mt-2 text-sm font-light text-gray-600">{{ $review->comment }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center">
                    <p class="text-gray-600 font-light">Belum ada ulasan untuk kelas ini</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($reviews->hasPages())
        <div class="mt-6">
            {{ $reviews->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
