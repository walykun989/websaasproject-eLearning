@extends('layouts.app')

@section('title', $material->title . ' - Learning')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('peserta.learning.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembelajaran Saya</a>
@endsection

@section('content')
<!-- Clean Reading Layout -->
<div class="min-h-screen bg-white py-12 transition-colors duration-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Collapsible Breadcrumb Navigation -->
        <div x-data="{ navOpen: false }" class="mb-6">
            <button @click="navOpen = !navOpen" class="flex items-center text-sm text-black hover:opacity-70 transition-opacity font-light">
                <svg :class="navOpen ? 'rotate-90' : ''" class="w-4 h-4 mr-2 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span>Navigation</span>
            </button>

            <nav x-show="navOpen" x-transition class="mt-3 pl-6 space-y-2">
                <a href="{{ route('peserta.learning.index') }}" class="block text-sm text-black hover:opacity-70 font-light">← Pembelajaran Saya</a>
                <a href="{{ route('peserta.learning.course', $course->slug) }}" class="block text-sm text-black hover:opacity-70 font-light">{{ $course->title }}</a>
            </nav>
        </div>

        <!-- Material Content Card -->
        <article class="bg-cyan-50 border-2 border-black overflow-hidden">
            <!-- Minimal Header -->
            <header class="px-6 py-5 border-b-2 border-black">
                <h1 class="text-2xl font-light text-black mb-3">{{ $material->title }}</h1>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3 text-sm font-light">
                        <span class="px-2 py-1 border border-black text-xs font-light bg-white text-black">
                            {{ ucfirst($material->tier_required) }}
                        </span>
                        @if($material->duration_minutes)
                        <span class="text-gray-600">{{ $material->duration_minutes }} min</span>
                        @endif
                    </div>

                    @if($userProgress && !$userProgress->is_completed)
                    <form method="POST" action="{{ route('peserta.learning.complete', [$course->slug, $material->id]) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm font-light text-white bg-black hover:opacity-80 transition-opacity border border-black">
                            Mark Complete
                        </button>
                    </form>
                    @elseif($userProgress && $userProgress->is_completed)
                    <span class="px-4 py-2 text-sm font-light text-black bg-white border-2 border-black">
                        ✓ Completed
                    </span>
                    @endif
                </div>
            </header>
            <!-- Clean Content Area -->
            <div class="px-6 py-8 sm:px-8 sm:py-10">
                @if($material->content_type === 'video')
                <div class="aspect-w-16 aspect-h-9 bg-black overflow-hidden border-2 border-black">
                    @php
                        $videoUrl = $material->content;
                        // Handle youtu.be short URLs
                        if (str_contains($videoUrl, 'youtu.be/')) {
                            preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $videoUrl, $matches);
                            $videoUrl = 'https://www.youtube.com/embed/' . ($matches[1] ?? '');
                        }
                        // Handle standard youtube.com URLs
                        else {
                            $videoUrl = str_replace('watch?v=', 'embed/', $videoUrl);
                        }
                    @endphp
                    <iframe
                        src="{{ $videoUrl }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        class="w-full h-96">
                    </iframe>
                </div>
                @else
                <div class="prose prose-lg max-w-none
                    prose-headings:text-black prose-headings:font-light
                    prose-p:text-gray-700 prose-p:font-light
                    prose-a:text-black prose-a:underline
                    prose-code:text-black
                    prose-pre:bg-gray-900 prose-pre:border-2 prose-pre:border-black">
                    {!! $material->content !!}
                </div>
                @endif
            </div>
        </article>

        <!-- Bottom Navigation -->
        <div class="mt-8 flex items-center justify-end px-4">
            @if($prevMaterial)
            <a href="{{ route('peserta.learning.material', [$course->slug, $prevMaterial->id]) }}"
               class="inline-flex items-center px-4 py-2 text-sm font-light text-black bg-white border-2 border-black hover:opacity-80 transition-opacity mr-4">
                <svg class="mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                </svg>
                Previous
            </a>
            @endif

            @if($nextMaterial)
            <a href="{{ route('peserta.learning.material', [$course->slug, $nextMaterial->id]) }}"
               class="inline-flex items-center px-4 py-2 text-sm font-light text-white bg-black border-2 border-black hover:opacity-80 transition-opacity">
                Next
                <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
            </a>
            @endif
        </div>

    </div>
</div>

<!-- Alpine.js for collapsible navigation -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
