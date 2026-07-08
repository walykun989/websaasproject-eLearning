@extends('layouts.app')

@section('title', 'Edit Profil - Peserta')

@section('nav-links')
<a href="{{ route('peserta.dashboard') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="border-transparent text-gray-600 hover:border-black hover:text-black inline-flex items-center px-1 pt-1 border-b-2 text-sm font-light">Berlangganan</a>
@endsection

@section('mobile-nav-links')
<a href="{{ route('peserta.dashboard') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Dashboard</a>
<a href="{{ route('peserta.catalog.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Katalog</a>
<a href="{{ route('peserta.learning.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pembelajaran Saya</a>
<a href="{{ route('peserta.orders.index') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50 border-b border-gray-100">Pesanan</a>
<a href="{{ route('peserta.pricing') }}" class="block px-4 py-3 text-base font-light text-gray-900 hover:bg-gray-50">Berlangganan</a>
@endsection

@section('content')
<div class="py-6 bg-white min-h-screen transition-colors duration-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Profile Header with Photo Upload -->
        <div class="bg-gradient-to-br from-white to-gray-50 border border-gray-200 p-8 mb-6 transition-colors duration-200 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-black opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-black opacity-5 rounded-full -ml-12 -mb-12"></div>

            <div class="relative">
                <h3 class="text-2xl font-light text-black mb-6 border-b border-gray-200 pb-3">Foto Profil & Avatar</h3>

                <div class="flex flex-col md:flex-row items-center gap-8">
                    <!-- Profile Photo Display -->
                    <div class="flex flex-col items-center">
                        <div class="relative group">
                            @php
                            $style = auth()->user()->border_style;

                            // Base styling - black/white only
                            $styleClasses = 'bg-black text-white border-2 border-black';
                            $hasDecoration = false;
                            $decorationFile = null;

                            // Mapping decoration names to SVG files
                            $decorationMap = [
                                'space-orbit' => 'space-orbit.svg',
                                'space-nebula' => 'space-nebula.svg',
                                'space-constellation' => 'space-constellation.svg',
                                'nature-vines' => 'nature-vines.svg',
                                'nature-floral' => 'nature-floral.svg',
                                'nature-sunburst' => 'nature-sunburst.svg',
                                'water-bubbles' => 'water-bubbles.svg',
                                'water-waves' => 'water-waves.svg',
                                'water-whirlpool' => 'water-whirlpool.svg',
                            ];

                            // Apply tier-based styles
                            if ($style === 'solid') {
                                $styleClasses = 'bg-black text-white border-4 border-white';
                            } elseif ($style === 'dashed') {
                                $styleClasses = 'bg-black text-white border-4 border-dashed border-white';
                            } elseif ($style === 'double') {
                                $styleClasses = 'bg-black text-white border-[6px] border-double border-white';
                            } elseif (isset($decorationMap[$style]) && auth()->user()->tier === 'sangar') {
                                $hasDecoration = true;
                                $decorationFile = $decorationMap[$style];
                                $styleClasses = 'bg-black text-white';
                            }
                            @endphp

                            <!-- Avatar with layering technique -->
                            <div class="relative inline-block w-40 h-40">
                                <!-- SVG Decoration Layer - positioned BEHIND avatar with negative offsets -->
                                <div id="decorationLayer" class="absolute pointer-events-none" style="top: -15%; left: -15%; width: 130%; height: 130%; z-index: 0;">
                                    @if($hasDecoration)
                                        @if($style === 'space-orbit')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="52" stroke="#6366f1" stroke-width="1.5" stroke-dasharray="4 4" /><circle cx="10" cy="40" r="6" fill="#8b5cf6" /><circle cx="110" cy="80" r="4" fill="#a78bfa" /><circle cx="70" cy="8" r="3" fill="#e2e8f0" /></svg>
                                        @elseif($style === 'space-nebula')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><defs><linearGradient id="nebula{{ $user->id }}" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#ec4899" /><stop offset="50%" stop-color="#8b5cf6" /><stop offset="100%" stop-color="#3b82f6" /></linearGradient><filter id="glow{{ $user->id }}" x="-20%" y="-20%" width="140%" height="140%"><feGaussianBlur stdDeviation="3" result="blur" /><feComposite in="SourceGraphic" in2="blur" operator="over" /></filter></defs><circle cx="60" cy="60" r="53" stroke="url(#nebula{{ $user->id }})" stroke-width="4" filter="url(#glow{{ $user->id }})" /></svg>
                                        @elseif($style === 'space-constellation')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="50" stroke="#1e293b" stroke-width="2" /><polyline points="20,20 40,10 70,15 100,30" stroke="#fde047" stroke-width="1.5" fill="none" /><circle cx="20" cy="20" r="2.5" fill="#fef08a" /><circle cx="40" cy="10" r="2" fill="#fef08a" /><circle cx="70" cy="15" r="3" fill="#fef08a" /><circle cx="100" cy="30" r="2" fill="#fef08a" /><circle cx="15" cy="80" r="2.5" fill="#fef08a" /><circle cx="100" cy="90" r="2" fill="#fef08a" /></svg>
                                        @elseif($style === 'nature-vines')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="51" stroke="#22c55e" stroke-width="3" /><path d="M 12 50 Q 0 40 10 30" stroke="#16a34a" stroke-width="2" fill="none" stroke-linecap="round" /><path d="M 108 70 Q 120 80 110 90" stroke="#16a34a" stroke-width="2" fill="none" stroke-linecap="round" /><ellipse cx="10" cy="30" rx="4" ry="7" transform="rotate(45 10 30)" fill="#4ade80" /><ellipse cx="110" cy="90" rx="4" ry="7" transform="rotate(45 110 90)" fill="#4ade80" /></svg>
                                        @elseif($style === 'nature-floral')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="50" stroke="#fbcfe8" stroke-width="2" /><circle cx="20" cy="20" r="8" fill="#f472b6" /><circle cx="15" cy="28" r="6" fill="#f9a8d4" /><circle cx="28" cy="15" r="6" fill="#f9a8d4" /><circle cx="100" cy="100" r="8" fill="#f472b6" /><circle cx="92" cy="105" r="6" fill="#f9a8d4" /><circle cx="105" cy="92" r="6" fill="#f9a8d4" /></svg>
                                        @elseif($style === 'nature-sunburst')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="48" stroke="#fbbf24" stroke-width="2" /><path d="M 60 5 L 60 12" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 60 115 L 60 108" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 5 60 L 12 60" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 115 60 L 108 60" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 20 20 L 26 26" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 100 100 L 94 94" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /></svg>
                                        @elseif($style === 'water-bubbles')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="50" stroke="#38bdf8" stroke-width="1.5" /><circle cx="15" cy="80" r="10" fill="#7dd3fc" fill-opacity="0.8" /><circle cx="8" cy="95" r="5" fill="#bae6fd" /><circle cx="28" cy="90" r="7" fill="#38bdf8" fill-opacity="0.6" /><circle cx="105" cy="30" r="8" fill="#7dd3fc" fill-opacity="0.8" /><circle cx="112" cy="18" r="4" fill="#bae6fd" /></svg>
                                        @elseif($style === 'water-waves')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><path d="M 10 60 C 10 20, 50 10, 80 15 C 110 20, 110 80, 80 105 C 50 130, 10 100, 10 60 Z" stroke="#0ea5e9" stroke-width="3" fill="none" /><path d="M 15 60 C 15 25, 50 18, 75 22 C 100 25, 105 75, 75 95 C 50 115, 15 90, 15 60 Z" stroke="#0284c7" stroke-width="1.5" fill="none" /></svg>
                                        @elseif($style === 'water-whirlpool')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><path d="M 60 10 A 50 50 0 0 1 110 60" stroke="#0284c7" stroke-width="4" stroke-linecap="round" fill="none" /><path d="M 110 60 A 50 50 0 0 1 60 110" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" fill="none" /><path d="M 60 110 A 50 50 0 0 1 10 60" stroke="#38bdf8" stroke-width="4" stroke-linecap="round" fill="none" /><path d="M 10 60 A 50 50 0 0 1 60 10" stroke="#7dd3fc" stroke-width="2" stroke-linecap="round" fill="none" /></svg>
                                        @endif
                                    @endif
                                </div>

                                <!-- Avatar - positioned ON TOP of decoration -->
                                <div id="avatarPreview" class="relative w-40 h-40 flex items-center justify-center text-4xl font-light transition-all duration-300 rounded-full overflow-hidden {{ $styleClasses }}" style="z-index: 1;">
                                    @if(auth()->user()->profile_photo)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    @endif
                                </div>

                                <!-- Hover overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-200 flex items-center justify-center opacity-0 group-hover:opacity-100 rounded-full">
                                    <span class="text-white text-sm font-light">Change Photo</span>
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->tier === 'sangar')
                        <p class="mt-4 text-center text-sm font-light text-black bg-gradient-to-r from-yellow-400 to-orange-500 px-4 py-1 rounded-full">
                            ⭐ Gaya eksklusif Sangar terbuka!
                        </p>
                        @endif
                    </div>

                    <!-- Photo Upload Instructions -->
                    <div class="flex-1">
                        <h4 class="text-lg font-light text-black mb-3">Unggah Foto Anda</h4>
                        <p class="text-sm font-light text-gray-600 mb-4">
                            Personalisasi profil Anda dengan foto kustom. Format yang diterima: JPG, PNG, GIF (maks 2MB)
                        </p>
                        <div class="space-y-2 text-sm font-light text-gray-500">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-black rounded-full"></span>
                                <span>Foto Anda akan ditampilkan di seluruh platform</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-black rounded-full"></span>
                                <span>Gaya avatar berlaku jika tidak ada foto yang diatur</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="bg-gradient-to-br from-white to-gray-50 border border-gray-200 transition-colors duration-200 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-40 h-40 bg-black opacity-5 rounded-full -ml-20 -mt-20"></div>

            <div class="px-4 py-5 sm:p-6 relative">
                <h2 class="text-2xl font-light text-black border-b border-gray-200 pb-3 mb-6">Pengaturan Profil</h2>

                <form method="POST" action="{{ route('peserta.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6" id="profileForm">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo Upload -->
                    <div>
                        <label for="profile_photo" class="block text-sm font-light text-black mb-2">Foto Profil</label>
                        <div class="flex items-center gap-4">
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/jpeg,image/png,image/jpg,image/gif"
                                class="block w-full text-sm text-gray-500 font-light
                                file:mr-4 file:py-2 file:px-4
                                file:border file:border-gray-300
                                file:text-sm file:font-light
                                file:bg-white
                                file:text-black
                                hover:file:bg-gray-50
                                file:transition-colors file:cursor-pointer
                                cursor-pointer">
                            @if(auth()->user()->profile_photo)
                            <button type="button" onclick="if(confirm('Hapus foto profil?')) document.getElementById('remove_photo').value='1'; this.closest('form').submit();"
                                class="text-sm font-light text-red-600 hover:opacity-70">
                                Hapus Foto
                            </button>
                            <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                            @endif
                        </div>
                        <p class="mt-2 text-xs font-light text-gray-500">
                            JPG, PNG, or GIF (max 2MB)
                        </p>
                    </div>

                    <div class="border-t border-gray-200 pt-6"></div>

                    <div>
                        <label for="name" class="block text-sm font-light text-black">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                            class="mt-1 block w-full border border-gray-300 bg-white text-black font-light py-2 px-3 focus:outline-none focus:border-black">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-light text-black">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required
                            class="mt-1 block w-full border border-gray-300 bg-white text-black font-light py-2 px-3 focus:outline-none focus:border-black">
                    </div>

                    <div>
                        <label for="border_style" class="block text-sm font-light text-black">Dekorasi Avatar</label>
                        <select name="border_style" id="border_style"
                            class="mt-1 block w-full border border-gray-300 bg-white text-black font-light py-2 px-3 focus:outline-none focus:border-black transition-colors" style="background-color: white !important;">
                            <option value="">Bawaan</option>
                            <option value="solid" {{ auth()->user()->border_style === 'solid' ? 'selected' : '' }}>Bingkai Solid</option>
                            <option value="dashed" {{ auth()->user()->border_style === 'dashed' ? 'selected' : '' }}>Bingkai Putus-putus</option>
                            <option value="double" {{ auth()->user()->border_style === 'double' ? 'selected' : '' }}>Bingkai Ganda</option>

                            @if(auth()->user()->tier === 'sangar')
                            <option value="" disabled class="text-gray-400">━━━ TEMA SPACE (Eksklusif Sangar) ━━━</option>
                            <option value="space-orbit" {{ auth()->user()->border_style === 'space-orbit' ? 'selected' : '' }}>🌌 Orbit Planet</option>
                            <option value="space-nebula" {{ auth()->user()->border_style === 'space-nebula' ? 'selected' : '' }}>✨ Nebula</option>
                            <option value="space-constellation" {{ auth()->user()->border_style === 'space-constellation' ? 'selected' : '' }}>⭐ Konstelasi Bintang</option>

                            <option value="" disabled class="text-gray-400">━━━ TEMA NATURE (Eksklusif Sangar) ━━━</option>
                            <option value="nature-vines" {{ auth()->user()->border_style === 'nature-vines' ? 'selected' : '' }}>🌿 Sulur Hijau</option>
                            <option value="nature-floral" {{ auth()->user()->border_style === 'nature-floral' ? 'selected' : '' }}>🌸 Bunga Bermekaran</option>
                            <option value="nature-sunburst" {{ auth()->user()->border_style === 'nature-sunburst' ? 'selected' : '' }}>☀️ Pancaran Matahari</option>

                            <option value="" disabled class="text-gray-400">━━━ TEMA WATER (Eksklusif Sangar) ━━━</option>
                            <option value="water-bubbles" {{ auth()->user()->border_style === 'water-bubbles' ? 'selected' : '' }}>💧 Gelembung Air</option>
                            <option value="water-waves" {{ auth()->user()->border_style === 'water-waves' ? 'selected' : '' }}>🌊 Ombak Samudra</option>
                            <option value="water-whirlpool" {{ auth()->user()->border_style === 'water-whirlpool' ? 'selected' : '' }}>🌀 Pusaran Air</option>
                            @else
                            <option value="" disabled class="text-gray-400">━━━ Dekorasi Premium 🔒 ━━━</option>
                            <option value="" disabled class="text-gray-400">🌌 Tema Space - Perlu Berlangganan Sangar</option>
                            <option value="" disabled class="text-gray-400">🌿 Tema Nature - Perlu Berlangganan Sangar</option>
                            <option value="" disabled class="text-gray-400">💧 Tema Water - Perlu Berlangganan Sangar</option>
                            @endif
                        </select>

                        @if(auth()->user()->tier !== 'sangar')
                        <p class="mt-2 text-sm font-light text-gray-600">
                            Dekorasi avatar premium eksklusif untuk
                            <a href="{{ route('peserta.pricing') }}" class="text-black hover:opacity-70 underline">pelanggan W.I.B Sangar</a>!
                        </p>
                        @else
                        <p class="mt-2 text-sm font-light text-black">
                            ⭐ Dekorasi eksklusif Sangar dengan tema Space, Nature & Water!
                        </p>
                        @endif
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-light text-black mb-4">Ganti Password</h3>

                        <div>
                            <label for="current_password" class="block text-sm font-light text-black">Password Saat Ini</label>
                            <input type="password" name="current_password" id="current_password"
                                class="mt-1 block w-full border border-gray-300 bg-white text-black font-light py-2 px-3 focus:outline-none focus:border-black">
                        </div>

                        <div class="mt-4">
                            <label for="new_password" class="block text-sm font-light text-black">Password Baru</label>
                            <input type="password" name="new_password" id="new_password"
                                class="mt-1 block w-full border border-gray-300 bg-white text-black font-light py-2 px-3 focus:outline-none focus:border-black">
                        </div>

                        <div class="mt-4">
                            <label for="new_password_confirmation" class="block text-sm font-light text-black">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="mt-1 block w-full border border-gray-300 bg-white text-black font-light py-2 px-3 focus:outline-none focus:border-black">
                        </div>
                    </div>

                    @if($errors->any())
                    <div class="bg-black border border-black text-white px-4 py-3 font-light">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('peserta.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-light text-black hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2 border border-black text-sm font-light text-white bg-black hover:bg-gray-800 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Instant dark mode switching
document.addEventListener('DOMContentLoaded', function() {
    const themeSelect = document.getElementById('theme');
    const htmlElement = document.documentElement;
    const profilePhotoInput = document.getElementById('profile_photo');
    const avatarPreview = document.getElementById('avatarPreview');

    // Handle theme switching instantly
    if (themeSelect) {
        themeSelect.addEventListener('change', function() {
            const selectedTheme = this.value;
            const userTier = '{{ auth()->user()->tier }}';

            // Check if user has permission for dark mode
            if (selectedTheme === 'dark') {
                if (userTier === 'apik' || userTier === 'sangar') {
                    htmlElement.classList.add('dark');
                } else {
                    // Revert selection if not allowed
                    this.value = '{{ auth()->user()->theme ?? "" }}';
                }
            } else {
                htmlElement.classList.remove('dark');
            }
        });
    }

    // Preview profile photo before upload
    if (profilePhotoInput) {
        profilePhotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.innerHTML = '<img src="' + e.target.result + '" alt="Profile Photo Preview" class="w-full h-full object-cover">';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Handle avatar decoration changes with live preview
    const borderStyleSelect = document.getElementById('border_style');
    const decorationLayer = document.getElementById('decorationLayer');

    if (borderStyleSelect && decorationLayer) {
        borderStyleSelect.addEventListener('change', function() {
            updateAvatarPreview(this.value);
        });
    }

    function updateAvatarPreview(style) {
        // Reset avatar to base styling
        avatarPreview.className = 'w-40 h-40 flex items-center justify-center text-4xl font-light transition-all duration-300 rounded-full overflow-hidden';

        // Apply base or border styles
        let styleClasses = 'bg-black text-white';

        if (style === 'solid') {
            styleClasses = 'bg-black text-white border-4 border-white';
        } else if (style === 'dashed') {
            styleClasses = 'bg-black text-white border-4 border-dashed border-white';
        } else if (style === 'double') {
            styleClasses = 'bg-black text-white border-[6px] border-double border-white';
        }

        avatarPreview.className += ' ' + styleClasses;

        // Clear decoration layer
        decorationLayer.innerHTML = '';

        // Generate unique ID for SVGs with gradients/filters
        const uniqueId = 'js' + Date.now();

        // Add inline SVG decorations for premium styles
        const decorations = {
            'space-orbit': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="52" stroke="#6366f1" stroke-width="1.5" stroke-dasharray="4 4" /><circle cx="10" cy="40" r="6" fill="#8b5cf6" /><circle cx="110" cy="80" r="4" fill="#a78bfa" /><circle cx="70" cy="8" r="3" fill="#e2e8f0" /></svg>',
            'space-nebula': `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><defs><linearGradient id="nebula${uniqueId}" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#ec4899" /><stop offset="50%" stop-color="#8b5cf6" /><stop offset="100%" stop-color="#3b82f6" /></linearGradient><filter id="glow${uniqueId}" x="-20%" y="-20%" width="140%" height="140%"><feGaussianBlur stdDeviation="3" result="blur" /><feComposite in="SourceGraphic" in2="blur" operator="over" /></filter></defs><circle cx="60" cy="60" r="53" stroke="url(#nebula${uniqueId})" stroke-width="4" filter="url(#glow${uniqueId})" /></svg>`,
            'space-constellation': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="50" stroke="#1e293b" stroke-width="2" /><polyline points="20,20 40,10 70,15 100,30" stroke="#fde047" stroke-width="1.5" fill="none" /><circle cx="20" cy="20" r="2.5" fill="#fef08a" /><circle cx="40" cy="10" r="2" fill="#fef08a" /><circle cx="70" cy="15" r="3" fill="#fef08a" /><circle cx="100" cy="30" r="2" fill="#fef08a" /><circle cx="15" cy="80" r="2.5" fill="#fef08a" /><circle cx="100" cy="90" r="2" fill="#fef08a" /></svg>',
            'nature-vines': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="51" stroke="#22c55e" stroke-width="3" /><path d="M 12 50 Q 0 40 10 30" stroke="#16a34a" stroke-width="2" fill="none" stroke-linecap="round" /><path d="M 108 70 Q 120 80 110 90" stroke="#16a34a" stroke-width="2" fill="none" stroke-linecap="round" /><ellipse cx="10" cy="30" rx="4" ry="7" transform="rotate(45 10 30)" fill="#4ade80" /><ellipse cx="110" cy="90" rx="4" ry="7" transform="rotate(45 110 90)" fill="#4ade80" /></svg>',
            'nature-floral': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="50" stroke="#fbcfe8" stroke-width="2" /><circle cx="20" cy="20" r="8" fill="#f472b6" /><circle cx="15" cy="28" r="6" fill="#f9a8d4" /><circle cx="28" cy="15" r="6" fill="#f9a8d4" /><circle cx="100" cy="100" r="8" fill="#f472b6" /><circle cx="92" cy="105" r="6" fill="#f9a8d4" /><circle cx="105" cy="92" r="6" fill="#f9a8d4" /></svg>',
            'nature-sunburst': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="48" stroke="#fbbf24" stroke-width="2" /><path d="M 60 5 L 60 12" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 60 115 L 60 108" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 5 60 L 12 60" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 115 60 L 108 60" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 20 20 L 26 26" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /><path d="M 100 100 L 94 94" stroke="#fbbf24" stroke-width="3" stroke-linecap="round" /></svg>',
            'water-bubbles': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><circle cx="60" cy="60" r="50" stroke="#38bdf8" stroke-width="1.5" /><circle cx="15" cy="80" r="10" fill="#7dd3fc" fill-opacity="0.8" /><circle cx="8" cy="95" r="5" fill="#bae6fd" /><circle cx="28" cy="90" r="7" fill="#38bdf8" fill-opacity="0.6" /><circle cx="105" cy="30" r="8" fill="#7dd3fc" fill-opacity="0.8" /><circle cx="112" cy="18" r="4" fill="#bae6fd" /></svg>',
            'water-waves': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><path d="M 10 60 C 10 20, 50 10, 80 15 C 110 20, 110 80, 80 105 C 50 130, 10 100, 10 60 Z" stroke="#0ea5e9" stroke-width="3" fill="none" /><path d="M 15 60 C 15 25, 50 18, 75 22 C 100 25, 105 75, 75 95 C 50 115, 15 90, 15 60 Z" stroke="#0284c7" stroke-width="1.5" fill="none" /></svg>',
            'water-whirlpool': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" fill="none" class="w-full h-full"><path d="M 60 10 A 50 50 0 0 1 110 60" stroke="#0284c7" stroke-width="4" stroke-linecap="round" fill="none" /><path d="M 110 60 A 50 50 0 0 1 60 110" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" fill="none" /><path d="M 60 110 A 50 50 0 0 1 10 60" stroke="#38bdf8" stroke-width="4" stroke-linecap="round" fill="none" /><path d="M 10 60 A 50 50 0 0 1 60 10" stroke="#7dd3fc" stroke-width="2" stroke-linecap="round" fill="none" /></svg>'
        };

        if (decorations[style]) {
            decorationLayer.innerHTML = decorations[style];
        }
    }
});
</script>
@endsection
