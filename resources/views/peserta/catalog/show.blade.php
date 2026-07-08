@extends('layouts.app')

@section('title', $course->title . ' - Katalog')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="border-black text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Berlangganan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('peserta.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="block px-4 py-3 text-base font-light text-black bg-gray-50 border-b border-gray-100">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Berlangganan</a>
@endsection

@section('content')
<div class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('peserta.catalog.index') }}" class="text-sm font-light text-black hover:opacity-70">
                ← Kembali ke Katalog
            </a>
        </div>

        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white border border-gray-200">
                    @if($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-64 object-cover">
                    @else
                    <div class="w-full h-64 bg-black"></div>
                    @endif

                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-2xl leading-6 font-light text-black">{{ $course->title }}</h3>
                        <p class="mt-1 text-sm font-light text-gray-600">
                            <a href="{{ route('peserta.catalog.category', $course->category->slug) }}" class="text-black hover:opacity-70">
                                {{ $course->category->name }}
                            </a>
                        </p>
                    </div>

                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <h4 class="text-lg font-light text-black mb-2">Deskripsi</h4>
                        <p class="font-light text-gray-600">{{ $course->description }}</p>
                    </div>

                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <h4 class="text-lg font-light text-black mb-4">Materi Kelas</h4>
                        <p class="text-sm font-light text-gray-600 mb-4">{{ $course->materials->count() }} materi pembelajaran</p>
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach($course->materials->take(5) as $material)
                            <li class="py-3 flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($material->content_type === 'video')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        @endif
                                    </svg>
                                    <span class="text-sm font-light text-black">{{ $material->title }}</span>
                                </div>
                                <span class="text-sm font-light text-gray-600">{{ $material->duration_minutes }} menit</span>
                            </li>
                            @endforeach
                            @if($course->materials->count() > 5)
                            <li class="py-3 text-sm font-light text-gray-600">
                                Dan {{ $course->materials->count() - 5 }} materi lainnya...
                            </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Pengajar Section -->
                    <div class="border-t-2 border-black bg-cyan-50 px-4 py-8 sm:px-6">
                        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                            <!-- Instructor Photo -->
                            <div class="flex-shrink-0">
                                @if($course->pengajar->profile_photo)
                                <img src="{{ asset('storage/' . $course->pengajar->profile_photo) }}" alt="{{ $course->pengajar->name }}" class="w-40 h-40 rounded-full object-cover">
                                @else
                                <div class="w-40 h-40 rounded-full bg-black flex items-center justify-center">
                                    <span class="text-white text-5xl font-light">{{ strtoupper(substr($course->pengajar->name, 0, 1)) }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- Instructor Details -->
                            <div class="flex-1 text-center md:text-left">
                                <h4 class="text-2xl font-light text-black mb-2">{{ $course->pengajar->name }}</h4>
                                @if($course->pengajar->bio)
                                <p class="text-sm font-light text-gray-600 mb-6 leading-relaxed">{{ $course->pengajar->bio }}</p>
                                @else
                                <p class="text-sm font-light text-gray-600 mb-6 leading-relaxed">Pengajar berpengalaman yang siap membimbing Anda dalam pembelajaran.</p>
                                @endif

                                <!-- Social Links -->
                                <div class="flex justify-center md:justify-start gap-4">
                                    @if($course->pengajar->instagram_link)
                                    <a href="{{ $course->pengajar->instagram_link }}" target="_blank" rel="noopener noreferrer" class="text-black hover:opacity-70 transition-opacity">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    @else
                                    <span class="text-gray-400 cursor-not-allowed opacity-50" title="Instagram link belum diatur oleh pengajar">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($course->reviews->count() > 0)
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <h4 class="text-lg font-light text-black mb-4">Review</h4>
                        <div class="space-y-4">
                            @foreach($course->reviews->take(3) as $review)
                            <div class="{{ $review->user->tier === 'sangar' ? 'border-l-4 border-black bg-gradient-to-r from-gray-50 to-transparent' : 'border-l-2 border-black' }} pl-4 py-2">
                                <div class="flex items-center mb-1">
                                    <x-avatar-with-decoration :user="$review->user" size="w-8 h-8" :showBadge="false" />
                                    <span class="text-sm font-light text-black ml-2 mr-2">{{ $review->user->name }}</span>
                                    @if($review->user->tier === 'sangar')
                                    <span class="px-2 py-0.5 text-xs font-light bg-black text-white border border-black mr-2">W.I.B SANGAR</span>
                                    @endif
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-black' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-sm font-light text-gray-600">{{ $review->comment }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 lg:mt-0 lg:col-span-1">
                <div class="bg-white border border-gray-200 lg:sticky lg:top-20">
                    <div class="px-4 py-5 sm:p-6">
                        @if($course->reviews->count() > 0)
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-light text-gray-600">Rating</span>
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-black mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm font-light text-black">{{ number_format($course->averageRating(), 1) }}</span>
                                <span class="text-sm font-light text-gray-600 ml-1">({{ $course->totalReviews() }} review)</span>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-center justify-between mb-6">
                            <span class="text-sm font-light text-gray-600">Total Materi</span>
                            <span class="text-sm font-light text-black">{{ $course->materials->count() }} materi</span>
                        </div>

                        <div class="space-y-3">
                            <a href="{{ route('peserta.learning.course', $course->slug) }}" class="w-full inline-flex justify-center items-center px-4 py-3 border border-black text-sm font-light text-black hover:bg-black hover:text-white transition-colors">
                                Mulai Belajar
                            </a>

                            @php
                                $hasReviewed = auth()->user()->reviews()->where('course_id', $course->id)->exists();
                                $hasCompleted = auth()->user()->hasCompletedCourse($course);
                            @endphp

                            @if(!$hasReviewed)
                                @if($hasCompleted)
                                <a href="{{ route('peserta.review.create', $course->slug) }}" class="w-full inline-flex justify-center items-center px-4 py-3 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80 transition-opacity">
                                    Berikan Review
                                </a>
                                @else
                                <button disabled class="w-full inline-flex justify-center items-center px-4 py-3 border-2 border-gray-300 text-sm font-light text-gray-400 bg-gray-100 cursor-not-allowed">
                                    Selesaikan Kelas untuk Review
                                </button>
                                @endif
                            @else
                            <div class="text-center py-2 text-sm font-light text-gray-600">
                                Anda sudah memberikan review
                            </div>
                            @endif

                            @if(auth()->user()->tier === 'free')
                            <p class="text-xs font-light text-gray-600 text-center">
                                Upgrade ke tier premium untuk akses penuh
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
