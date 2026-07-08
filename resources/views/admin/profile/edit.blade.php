@extends('layouts.app')

@section('title', 'Edit Profil - Admin')

@section('content')
<div class="py-6 bg-white min-h-screen transition-colors duration-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Profile Header with Photo Upload -->
        <div class="bg-cyan-50 border-2 border-black p-8 mb-6 transition-colors duration-200">
            <h3 class="text-2xl font-light text-black mb-6 border-b-2 border-black pb-3">Profil Admin</h3>

            <div class="flex flex-col md:flex-row items-center gap-8">
                <!-- Profile Photo Display -->
                <div class="flex flex-col items-center">
                    <div class="relative group">
                        <div class="w-40 h-40 flex items-center justify-center text-4xl font-light bg-black text-white border-4 border-black rounded-full overflow-hidden" id="avatarPreview">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            @endif
                        </div>

                        <!-- Hover overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-200 flex items-center justify-center opacity-0 group-hover:opacity-100 rounded-full">
                            <span class="text-white text-sm font-light">Ubah Foto</span>
                        </div>
                    </div>
                </div>

                <!-- Photo Upload Instructions -->
                <div class="flex-1">
                    <h4 class="text-lg font-light text-black mb-3">Unggah Foto Profil</h4>
                    <p class="text-sm font-light text-gray-600 mb-4">
                        Foto profil administrator. Format: JPG, PNG, GIF (maks 2MB)
                    </p>
                    <div class="space-y-2 text-sm font-light text-gray-600">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-black rounded-full"></span>
                            <span>Gunakan foto profesional yang jelas</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-black rounded-full"></span>
                            <span>Foto akan ditampilkan di sistem admin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="bg-cyan-50 border-2 border-black transition-colors duration-200">
            <div class="px-4 py-5 sm:p-6">
                <h2 class="text-2xl font-light text-black border-b-2 border-black pb-3 mb-6">Pengaturan Profil</h2>

                @if(session('success'))
                <div class="bg-white border-2 border-black text-black px-4 py-3 font-light mb-6">
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo Upload -->
                    <div>
                        <label for="profile_photo" class="block text-sm font-light text-black mb-2">Foto Profil</label>
                        <div class="flex items-center gap-4">
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/jpeg,image/png,image/jpg,image/gif"
                                class="block w-full text-sm text-gray-600 font-light
                                file:mr-4 file:py-2 file:px-4
                                file:border-2 file:border-black
                                file:text-sm file:font-light
                                file:bg-white
                                file:text-black
                                hover:file:bg-gray-50
                                file:transition-colors file:cursor-pointer
                                cursor-pointer">
                            @if(auth()->user()->profile_photo)
                            <button type="button" onclick="if(confirm('Hapus foto profil?')) { document.getElementById('remove_photo').value='1'; this.closest('form').submit(); }"
                                class="text-sm font-light text-red-600 hover:opacity-70">
                                Hapus Foto
                            </button>
                            <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                            @endif
                        </div>
                        <p class="mt-2 text-xs font-light text-gray-600">
                            JPG, PNG, or GIF (max 2MB)
                        </p>
                    </div>

                    <div class="border-t-2 border-black pt-6"></div>

                    <div>
                        <label for="name" class="block text-sm font-light text-black">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                            class="mt-1 block w-full border-2 border-black bg-white text-black font-light py-2 px-3 focus:outline-none focus:ring-2 focus:ring-black">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-light text-black">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required
                            class="mt-1 block w-full border-2 border-black bg-white text-black font-light py-2 px-3 focus:outline-none focus:ring-2 focus:ring-black">
                    </div>

                    <div class="border-t-2 border-black pt-6">
                        <h3 class="text-lg font-light text-black mb-4">Ganti Password</h3>

                        <div>
                            <label for="current_password" class="block text-sm font-light text-black">Password Saat Ini</label>
                            <input type="password" name="current_password" id="current_password"
                                class="mt-1 block w-full border-2 border-black bg-white text-black font-light py-2 px-3 focus:outline-none focus:ring-2 focus:ring-black">
                        </div>

                        <div class="mt-4">
                            <label for="new_password" class="block text-sm font-light text-black">Password Baru</label>
                            <input type="password" name="new_password" id="new_password"
                                class="mt-1 block w-full border-2 border-black bg-white text-black font-light py-2 px-3 focus:outline-none focus:ring-2 focus:ring-black">
                        </div>

                        <div class="mt-4">
                            <label for="new_password_confirmation" class="block text-sm font-light text-black">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="mt-1 block w-full border-2 border-black bg-white text-black font-light py-2 px-3 focus:outline-none focus:ring-2 focus:ring-black">
                        </div>
                    </div>

                    @if($errors->any())
                    <div class="bg-white border-2 border-black text-black px-4 py-3 font-light">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border-2 border-black text-sm font-light text-black bg-white hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2 border-2 border-black text-sm font-light text-white bg-black hover:opacity-80 transition-opacity">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profilePhotoInput = document.getElementById('profile_photo');
    const avatarPreview = document.getElementById('avatarPreview');

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
});
</script>
@endsection
