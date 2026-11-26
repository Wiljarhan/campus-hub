@extends('layouts.app')

@section('content')
    {{-- Container utama sejajar dengan navbar dan footer (max-w-6xl mx-auto px-4 py-10) --}}
    <div class="max-w-6xl mx-auto px-4 py-10">
        {{-- Header halaman form unggah karya --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Unggah Karya Baru</h1>
                <p class="text-sm text-gray-600 mt-1">
                    Lengkapi detail karya beserta lampiran pendukung untuk diverifikasi.
                </p>
            </div>

            {{-- Tombol kembali ke halaman daftar karya mahasiswa --}}
            <a href="{{ route('mahasiswa.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 text-sm font-medium rounded-lg shadow-sm transition">
                Kembali
            </a>
        </div>

        {{-- Kartu form unggah karya --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
            {{-- Gunakan enctype="multipart/form-data" agar form bisa mengirim file --}}
            <form action="{{ route('mahasiswa.karya.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Input judul karya --}}
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">
                        Judul Karya <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="judul"
                           id="judul"
                           value="{{ old('judul') }}"
                           placeholder="Contoh: Sistem Monitoring Kualitas Air Berbasis IoT"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-marun focus:outline-none focus:ring-1 focus:ring-marun">
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Dropdown kategori karya --}}
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori_id"
                            id="kategori_id"
                            class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm focus:border-marun focus:outline-none focus:ring-1 focus:ring-marun">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Textarea ringkasan karya --}}
                <div>
                    <label for="ringkasan" class="block text-sm font-medium text-gray-700 mb-1">
                        Ringkasan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="ringkasan"
                              id="ringkasan"
                              rows="4"
                              placeholder="Jelaskan latar belakang, fitur utama, dan manfaat karyamu..."
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-marun focus:outline-none focus:ring-1 focus:ring-marun">{{ old('ringkasan') }}</textarea>
                    @error('ringkasan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input opsional link demo dan link repository --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="link_demo" class="block text-sm font-medium text-gray-700 mb-1">
                            Link Demo (Opsional)
                        </label>
                        <input type="url"
                               name="link_demo"
                               id="link_demo"
                               value="{{ old('link_demo') }}"
                               placeholder="https://demo.contoh.com"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-marun focus:outline-none focus:ring-1 focus:ring-marun">
                        @error('link_demo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="link_repo" class="block text-sm font-medium text-gray-700 mb-1">
                            Link Repository (Opsional)
                        </label>
                        <input type="url"
                               name="link_repo"
                               id="link_repo"
                               value="{{ old('link_repo') }}"
                               placeholder="https://github.com/username/repo"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-marun focus:outline-none focus:ring-1 focus:ring-marun">
                        @error('link_repo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Input unggah banyak file lampiran sekaligus --}}
                <div>
                    <label for="lampiran" class="block text-sm font-medium text-gray-700 mb-1">
                        Lampiran (Opsional)
                    </label>
                    <input type="file"
                           name="lampiran[]"
                           id="lampiran"
                           multiple
                           accept=".pdf,.jpg,.jpeg,.png,.zip,.docx"
                           class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-marun/10 file:text-marun hover:file:bg-marun/20">
                    <p class="mt-1 text-xs text-gray-500">
                        Bisa memilih lebih dari satu file. Format: pdf, jpg, jpeg, png, zip, docx (maks. 5 MB per file).
                    </p>

                    {{-- Error jika field lampiran itu sendiri bermasalah --}}
                    @error('lampiran')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    {{-- Error untuk masing-masing file di dalam array lampiran[] --}}
                    @foreach ($errors->get('lampiran.*') as $messages)
                        @foreach ($messages as $message)
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @endforeach
                    @endforeach
                </div>

                {{-- Tombol aksi form --}}
                <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                    <a href="{{ route('mahasiswa.index') }}"
                       class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Kembali
                    </a>
                    {{-- Tombol simpan/unggah karya dengan warna marun --}}
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-marun rounded-lg hover:opacity-90 shadow-sm transition">
                        Unggah Karya
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
