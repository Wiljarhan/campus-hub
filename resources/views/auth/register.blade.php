@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="w-full max-w-md bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-gray-900">Daftar Akun</h1>
                <p class="mt-1 text-sm text-gray-600">
                    Buat akun baru di Campus Talent &amp; Showcase Hub.
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Lengkap
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Masukkan nama lengkap"
                        class="w-full rounded-md border @error('name') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                    >
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="nama@kampus.ac.id"
                        class="w-full rounded-md border @error('email') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                    >
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="Minimal 8 karakter"
                        class="w-full rounded-md border @error('password') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                    >
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Konfirmasi Password
                    </label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Ulangi password"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                    >
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">
                        Daftar Sebagai (Role)
                    </label>
                    <select
                        id="role"
                        name="role"
                        required
                        class="w-full rounded-md border @error('role') border-red-500 @else border-gray-300 @enderror bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                    >
                        <option value="">-- Pilih Role --</option>
                        <option value="mahasiswa" @selected(old('role') === 'mahasiswa')>Mahasiswa</option>
                        <option value="verifikator" @selected(old('role') === 'verifikator')>Verifikator</option>
                        <option value="umkm" @selected(old('role') === 'umkm')>UMKM</option>
                        <option value="recruiter" @selected(old('role') === 'recruiter')>Recruiter</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kolom profil Mahasiswa --}}
                <div data-role-fields="mahasiswa" class="hidden space-y-4">
                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">
                            NIM
                        </label>
                        <input
                            id="nim"
                            type="text"
                            name="nim"
                            value="{{ old('nim') }}"
                            placeholder="Contoh: 2201020001"
                            class="w-full rounded-md border @error('nim') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                        >
                        @error('nim')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="prodi" class="block text-sm font-medium text-gray-700 mb-1">
                            Program Studi
                        </label>
                        <input
                            id="prodi"
                            type="text"
                            name="prodi"
                            value="{{ old('prodi') }}"
                            placeholder="Contoh: Teknik Informatika"
                            class="w-full rounded-md border @error('prodi') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                        >
                        @error('prodi')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kolom profil Verifikator --}}
                <div data-role-fields="verifikator" class="hidden space-y-4">
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">
                            NIP
                        </label>
                        <input
                            id="nip"
                            type="text"
                            name="nip"
                            value="{{ old('nip') }}"
                            placeholder="Masukkan NIP"
                            class="w-full rounded-md border @error('nip') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                        >
                        @error('nip')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kolom profil UMKM --}}
                <div data-role-fields="umkm" class="hidden space-y-4">
                    <div>
                        <label for="nama_usaha" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Usaha
                        </label>
                        <input
                            id="nama_usaha"
                            type="text"
                            name="nama_usaha"
                            value="{{ old('nama_usaha') }}"
                            placeholder="Masukkan nama usaha"
                            class="w-full rounded-md border @error('nama_usaha') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                        >
                        @error('nama_usaha')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="bidang" class="block text-sm font-medium text-gray-700 mb-1">
                            Bidang Usaha
                        </label>
                        <input
                            id="bidang"
                            type="text"
                            name="bidang"
                            value="{{ old('bidang') }}"
                            placeholder="Contoh: Kuliner, Fashion, Teknologi"
                            class="w-full rounded-md border @error('bidang') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                        >
                        @error('bidang')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kolom profil Recruiter --}}
                <div data-role-fields="recruiter" class="hidden space-y-4">
                    <div>
                        <label for="perusahaan" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Perusahaan
                        </label>
                        <input
                            id="perusahaan"
                            type="text"
                            name="perusahaan"
                            value="{{ old('perusahaan') }}"
                            placeholder="Masukkan nama perusahaan"
                            class="w-full rounded-md border @error('perusahaan') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-gray-900 focus:outline-none focus:ring-1 focus:ring-gray-900"
                        >
                        @error('perusahaan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-md bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition"
                >
                    Daftar
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-gray-900 hover:underline">
                    Masuk
                </a>
            </p>
        </div>
    </div>

    <script>
        (function () {
            const roleSelect = document.getElementById('role');
            const roleSections = document.querySelectorAll('[data-role-fields]');

            function toggleRoleFields() {
                const selectedRole = roleSelect.value;

                roleSections.forEach(function (section) {
                    const isActive = section.getAttribute('data-role-fields') === selectedRole;
                    section.classList.toggle('hidden', !isActive);

                    section.querySelectorAll('input, select, textarea').forEach(function (field) {
                        field.disabled = !isActive;
                    });
                });
            }

            roleSelect.addEventListener('change', toggleRoleFields);
            toggleRoleFields();
        })();
    </script>
@endsection
