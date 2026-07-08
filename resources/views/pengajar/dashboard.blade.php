@extends('layouts.app')

@section('title', 'Dashboard - Pengajar')

@section('nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Private Sessions</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Private Sessions</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-light text-black">Dashboard Pengajar</h2>

        <!-- Stats Grid -->
        <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Total Courses</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $stats['total_courses'] }}</dd>
            </div>

            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Total Materials</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $stats['total_materials'] }}</dd>
            </div>

            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Total Ulasan</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ $stats['total_reviews'] }}</dd>
            </div>

            <div class="bg-white border border-gray-200 p-5">
                <dt class="text-sm font-light text-gray-600">Avg Rating</dt>
                <dd class="mt-1 text-2xl font-light text-black">{{ number_format($stats['average_rating'], 1) }}</dd>
            </div>
        </div>

        <!-- Recent Courses -->
        <div class="mt-8">
            <h3 class="text-lg font-light text-black">Kelas Terbaru</h3>
            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($recentCourses as $course)
                <div class="bg-white border border-gray-200 p-6">
                    <h4 class="text-sm font-light text-black">{{ $course->title }}</h4>
                    <p class="mt-1 text-xs font-light text-gray-600">{{ $course->materials_count }} materi</p>
                    <p class="mt-1 text-xs font-light text-gray-600">{{ $course->reviews_count }} ulasan</p>
                    <a href="{{ route('pengajar.courses.edit', $course) }}" class="mt-3 block text-center text-sm font-light text-black hover:opacity-70">
                        Edit Kelas
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
