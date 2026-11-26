
@extends('layouts.app')

@section('title', 'Katalog Karya')

@section('content')

@php
    $kategoriAktif = request('kategori');
@endphp

<!-- Header Katalog -->
<section class="bg-[#F5EEEB] border-b border-[#E9DEDA]">
    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="text-xs text-gray-500 mb-7">
            <a href="/" class="hover:text-[#9D292C]">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-[#9D292C] font-semibold">Katalog Karya</span>
        </div>

        <p class="text-xs font-bold tracking-widest text-[#9D292C] uppercase">
            Etalase Karya Mahasiswa
        </p>

        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">
            Temukan karya. Buka peluang.
        </h1>

        <p class="text-gray-600 mt-3 max-w-2xl">
            Inovasi mahasiswa FMIPA UHO, terverifikasi dan siap dikolaborasikan.
        </p>

    </div>
</section>

<!-- Konten Katalog -->
<section class="bg-[#FAF9F7] min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Pencarian -->
        <form action="{{ url('/katalog') }}" method="GET"
              class="flex flex-col md:flex-row gap-3 mb-5">

            <input
                type="text"
                name="cari"
                value="{{ request('cari') }}"
                placeholder="Cari judul karya, nama mahasiswa, atau kata kunci..."
                class="flex-1 bg-white border border-gray-200 rounded-md px-4 py-3 text-sm focus:outline-none focus:border-[#9D292C]"
            >

            @if($kategoriAktif)
                <input type="hidden" name="kategori" value="{{ $kategoriAktif }}">
            @endif

            <button type="submit"
                class="bg-[#9D292C] hover:bg-[#65090B] text-white px-8 py-3 rounded-md text-sm font-semibold transition">
                Cari Karya
            </button>

        </form>

        <!-- Filter Kategori -->
        <div class="flex flex-wrap items-center gap-2 mb-8">

            <a href="{{ url('/katalog') }}"
               class="px-4 py-2 rounded-md text-xs font-semibold border transition
               {{ !$kategoriAktif ? 'bg-[#9D292C] text-white border-[#9D292C]' : 'bg-white text-gray-600 border-gray-200 hover:border-[#9D292C]' }}">
                Semua Kategori
            </a>

            @foreach($kategoris as $kategori)
                <a href="{{ url('/katalog') }}?{{ http_build_query(array_filter([
                    'cari' => request('cari'),
                    'kategori' => $kategori->id
                ], fn($value) => $value !== null && $value !== '')) }}"
                   class="px-4 py-2 rounded-md text-xs font-semibold border transition
                   {{ $kategoriAktif == $kategori->id ? 'bg-[#9D292C] text-white border-[#9D292C]' : 'bg-white text-gray-600 border-gray-200 hover:border-[#9D292C]' }}">
                    {{ $kategori->nama_kategori }}
                </a>
            @endforeach

            @if(request()->hasAny(['cari', 'kategori']))
                <a href="{{ url('/katalog') }}"
                   class="px-4 py-2 text-xs text-[#9D292C] font-semibold hover:underline">
                    Reset Filter
                </a>
            @endif

        </div>

        <!-- Informasi Hasil -->
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3 mb-5">

            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    Karya Terverifikasi
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Menampilkan {{ $karyas->firstItem() ?? 0 }} sampai
                    {{ $karyas->lastItem() ?? 0 }} dari
                    {{ $karyas->total() }} karya
                </p>
            </div>

            <span class="text-xs text-gray-500">
                Diurutkan berdasarkan karya terbaru
            </span>

        </div>

        <!-- Daftar Karya -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse($karyas as $karya)

                <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition duration-300 group">

                    <!-- Preview Karya -->
                    <a href="{{ route('publik.karya.detail', $karya->id) }}"
                       class="block">

                        <div class="h-48 bg-gradient-to-br from-[#E5EEE8] to-[#D5E3DC] p-5 relative overflow-hidden">

                            <div class="bg-white rounded-md shadow-md h-full p-3 flex gap-3">

                                <!-- Sidebar Preview -->
                                <div class="w-1/4 bg-[#245A49] rounded-sm flex flex-col items-center py-3 gap-3">
                                    <div class="w-8 h-2 bg-white/80 rounded"></div>
                                    <div class="w-8 h-1 bg-white/40 rounded"></div>
                                    <div class="w-8 h-1 bg-white/40 rounded"></div>
                                    <div class="w-8 h-1 bg-white/40 rounded"></div>
                                </div>

                                <!-- Isi Preview -->
                                <div class="flex-1 py-2">
                                    <div class="w-2/3 h-3 bg-gray-200 rounded mb-3"></div>

                                    <div class="grid grid-cols-3 gap-2 mb-4">
                                        <div class="h-8 bg-[#E8F1EC] rounded"></div>
                                        <div class="h-8 bg-[#E8F1EC] rounded"></div>
                                        <div class="h-8 bg-[#E8F1EC] rounded"></div>
                                    </div>

                                    <div class="flex items-end gap-2 h-16 border-b border-gray-200 px-2">
                                        <div class="w-full h-6 bg-[#8AB49E] rounded-t"></div>
                                        <div class="w-full h-10 bg-[#6D9E85] rounded-t"></div>
                                        <div class="w-full h-8 bg-[#8AB49E] rounded-t"></div>
                                        <div class="w-full h-14 bg-[#6D9E85] rounded-t"></div>
                                        <div class="w-full h-12 bg-[#D4AF37] rounded-t"></div>
                                    </div>
                                </div>

                            </div>

                            <span class="absolute top-3 left-3 bg-white/90 text-[#245A49] text-[10px] font-bold px-2 py-1 rounded">
                                PREVIEW KARYA
                            </span>

                        </div>
                    </a>

                    <!-- Informasi Karya -->
                    <div class="p-5">

                        <div class="flex justify-between items-center gap-2">

                            <span class="text-[10px] uppercase tracking-wide font-bold text-[#9D292C]">
                                {{ $karya->kategori?->nama_kategori ?? 'Umum' }}
                            </span>

                            <span class="text-[10px] text-green-700 font-semibold">
                                ✓ Terverifikasi
                            </span>

                        </div>

                        <a href="{{ route('publik.karya.detail', $karya->id) }}">
                            <h3 class="text-base font-bold text-gray-900 mt-3 leading-snug group-hover:text-[#9D292C] transition">
                                {{ $karya->judul }}
                            </h3>
                        </a>

                        <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($karya->ringkasan, 100) }}
                        </p>

                        <div class="flex items-center gap-2 mt-4 pt-3 border-t border-gray-100">

                            <div class="w-8 h-8 rounded-full bg-[#F5EEEB] flex items-center justify-center text-[#9D292C] text-xs font-bold">
                                {{ strtoupper(substr($karya->mahasiswa?->name ?? 'M', 0, 1)) }}
                            </div>

                            <div>
                                <p class="text-xs font-semibold text-gray-800">
                                    {{ $karya->mahasiswa?->name ?? 'Mahasiswa' }}
                                </p>

                                <p class="text-[10px] text-gray-400">
                                    {{ $karya->mahasiswa?->prodi ?? 'Mahasiswa FMIPA UHO' }}
                                </p>
                            </div>

                        </div>

                        <div class="flex justify-end mt-4">
                            <a href="{{ route('publik.karya.detail', $karya->id) }}"
                               class="text-xs font-bold text-[#9D292C] hover:underline">
                                Lihat Detail →
                            </a>
                        </div>

                    </div>

                </article>

            @empty

                <div class="col-span-full bg-white border border-gray-200 rounded-lg text-center py-16">

                    <div class="text-4xl mb-4">📂</div>

                    <h3 class="font-bold text-gray-800">
                        Karya tidak ditemukan
                    </h3>

                    <p class="text-sm text-gray-500 mt-2">
                        Coba gunakan kata kunci atau kategori lainnya.
                    </p>

                    <a href="{{ url('/katalog') }}"
                       class="inline-block mt-5 text-sm font-semibold text-[#9D292C] hover:underline">
                        Lihat semua karya
                    </a>

                </div>

            @endforelse

        </div>

        <!-- Pagination -->
        @if($karyas->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $karyas->links() }}
            </div>
        @endif

    </div>
</section>

@endsection
