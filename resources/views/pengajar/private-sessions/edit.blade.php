@extends('layouts.app')

@section('title', 'Edit Sesi Privat - Pengajar')

@section('nav-links')
<a href="{{ route('pengajar.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('pengajar.courses.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Courses</a>
<a href="{{ route('pengajar.reviews.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Reviews</a>
<a href="{{ route('pengajar.private-sessions.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Private Sessions</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-light text-black">Edit Private Session</h2>
        </div>

        <div class="bg-white border border-gray-200 p-6">
            <form method="POST" action="{{ route('pengajar.private-sessions.update', $privateSession) }}">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- User -->
                    <div>
                        <label for="user_id" class="block text-sm font-light text-black">Peserta (Tier Sangar)</label>
                        <select name="user_id" id="user_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('user_id') border-red-500 @enderror">
                            <option value="">Pilih Peserta</option>
                            @foreach($sangarUsers as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $privateSession->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Course (Optional) -->
                    <div>
                        <label for="course_id" class="block text-sm font-light text-black">Kelas (Optional)</label>
                        <select name="course_id" id="course_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('course_id') border-red-500 @enderror">
                            <option value="">Tidak terkait kelas tertentu</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $privateSession->course_id) == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-light text-black">Judul Session</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $privateSession->title) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('title') border-red-500 @enderror">
                        @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Scheduled At -->
                    <div>
                        <label for="scheduled_at" class="block text-sm font-light text-black">Jadwal</label>
                        <input type="datetime-local" name="scheduled_at" id="scheduled_at" value="{{ old('scheduled_at', $privateSession->scheduled_at->format('Y-m-d\TH:i')) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('scheduled_at') border-red-500 @enderror">
                        @error('scheduled_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration_minutes" class="block text-sm font-light text-black">Durasi (menit)</label>
                        <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', $privateSession->duration_minutes) }}" required min="15" max="180" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('duration_minutes') border-red-500 @enderror">
                        @error('duration_minutes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meeting Link -->
                    <div>
                        <label for="meeting_link" class="block text-sm font-light text-black">Meeting Link (Optional)</label>
                        <input type="url" name="meeting_link" id="meeting_link" value="{{ old('meeting_link', $privateSession->meeting_link) }}" placeholder="https://meet.google.com/..." class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('meeting_link') border-red-500 @enderror">
                        @error('meeting_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-light text-black">Catatan (Optional)</label>
                        <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('notes') border-red-500 @enderror">{{ old('notes', $privateSession->notes) }}</textarea>
                        @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-light text-black">Status</label>
                        <select name="status" id="status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white text-black font-light focus:outline-none focus:border-black @error('status') border-red-500 @enderror">
                            <option value="scheduled" {{ old('status', $privateSession->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="completed" {{ old('status', $privateSession->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $privateSession->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4">
                        <form method="POST" action="{{ route('pengajar.private-sessions.destroy', $privateSession) }}" onsubmit="return confirm('Yakin ingin menghapus session ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-600 text-sm font-light text-red-600 hover:bg-red-600 hover:text-white">
                                Hapus Session
                            </button>
                        </form>
                        <div class="flex space-x-3">
                            <a href="{{ route('pengajar.private-sessions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-light text-black hover:bg-gray-50">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-black border border-black text-sm font-light text-white hover:opacity-80 transition-opacity">
                                Update Session
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
