@extends('layouts.app')

@section('title', 'Sesi Privat - Pengajar')

@section('nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Private Sessions</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50">Private Sessions</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <h2 class="text-2xl font-light text-black">Private Sessions</h2>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('pengajar.private-sessions.create') }}" class="inline-flex items-center px-4 py-2 bg-black border border-black text-sm font-light text-white hover:opacity-80 transition-opacity">
                    Jadwalkan Session
                </a>
            </div>
        </div>

        <!-- Sessions List -->
        <div class="mt-8 bg-white border border-gray-200">
            @forelse($sessions as $session)
            <div class="border-b border-gray-200 last:border-b-0 p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3">
                            <h3 class="text-lg font-light text-black">{{ $session->title }}</h3>
                            <span class="px-2 inline-flex text-xs leading-5 font-light {{ $session->status === 'completed' ? 'bg-black text-white' : ($session->status === 'cancelled' ? 'border border-red-600 text-red-600' : 'border border-black text-black') }}">
                                {{ ucfirst($session->status) }}
                            </span>
                        </div>
                        <div class="mt-2 space-y-1">
                            <p class="text-sm font-light text-gray-600">
                                <span class="font-normal">Peserta:</span> {{ $session->user->name }} ({{ $session->user->email }})
                            </p>
                            @if($session->course)
                            <p class="text-sm font-light text-gray-600">
                                <span class="font-normal">Kelas:</span> {{ $session->course->title }}
                            </p>
                            @endif
                            <p class="text-sm font-light text-gray-600">
                                <span class="font-normal">Jadwal:</span> {{ $session->scheduled_at->format('d M Y H:i') }} ({{ $session->duration_minutes }} menit)
                            </p>
                            @if($session->meeting_link)
                            <p class="text-sm font-light text-gray-600">
                                <span class="font-normal">Link:</span> <a href="{{ $session->meeting_link }}" target="_blank" class="text-black hover:underline">{{ $session->meeting_link }}</a>
                            </p>
                            @endif
                            @if($session->notes)
                            <p class="text-sm font-light text-gray-600 mt-2">{{ $session->notes }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="ml-4 flex flex-col space-y-2">
                        <a href="{{ route('pengajar.private-sessions.edit', $session) }}" class="inline-flex items-center px-3 py-1 border border-black text-sm font-light text-black hover:bg-black hover:text-white text-center">
                            Edit
                        </a>
                        @if($session->status === 'scheduled')
                        <form method="POST" action="{{ route('pengajar.private-sessions.complete', $session) }}" class="inline">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center px-3 py-1 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                                Mark Complete
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <p class="text-gray-600 font-light">Belum ada private sessions terjadwal</p>
                <a href="{{ route('pengajar.private-sessions.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-black text-sm font-light text-black hover:bg-black hover:text-white">
                    Jadwalkan Session Pertama
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($sessions->hasPages())
        <div class="mt-6">
            {{ $sessions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
