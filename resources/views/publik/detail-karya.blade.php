
@extends('layouts.app')

@section('title', $karya->judul)

@section('content')

<section class="bg-[#F5EEEB] border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="text-xs text-gray-500 mb-5">
            <a href="/" class="hover:text-[#9D292C]">Beranda</a>
            <span class="mx-2">/</span>
            <a href="/katalog" class="hover:text-[#9D292C]">Katalog</a>
            <span class="mx-2">/</span>
            <span class="text-[#9D292C]">Detail Karya</span>
        </div>

        <span class="text-xs font-bold text-green-700">
            ✓ TERVerifikasi FAKULTAS
        </span>

        <h1 class="text-3xl font-bold text-gray-900 mt-3">
            {{ $karya->judul }}
        </h1>

        <p class="text-gray-600 text-sm mt-3">
            {{ $karya->kategori?->nama_kategori ?? 'Umum' }}
        </p>

    </div>
</section>

<section class="bg-[#FAF9F7] py-10">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-3 gap-7">

            <!-- Konten Utama -->
            <div class="lg:col-span-2">

                <div class="bg-white border border-gray-200 rounded-lg p-5">

                    
@php
    $gambarKarya = $karya->lampirans->first(function ($lampiran) {
        return in_array(
            strtolower(pathinfo($lampiran->path, PATHINFO_EXTENSION)),
            ['jpg', 'jpeg', 'png', 'webp']
        );
    });
@endphp

<div class="h-72 bg-gray-100 rounded-md overflow-hidden flex items-center justify-center">

    @if($gambarKarya)
        <img
            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($gambarKarya->path) }}"
            alt="{{ $karya->judul }}"
            class="w-full h-full object-contain"
        >
    @else
        <div class="text-center">
            <span class="text-5xl">📊</span>
            <p class="text-sm text-gray-500 mt-3">
                Belum ada gambar preview karya.
            </p>
        </div>
    @endif

</div>


                    <div class="mt-8">
                        <h2 class="text-xl font-bold text-gray-900">
                            Tentang Karya
                        </h2>

                        <p class="text-sm text-gray-600 leading-relaxed mt-4">
                            {{ $karya->ringkasan }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3 mt-6">

                        @if($karya->link_demo)
                            <a href="{{ $karya->link_demo }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="bg-[#9D292C] text-white px-5 py-3 rounded-md text-sm font-semibold">
                                Link Demo ↗
                            </a>
                        @endif

                        @if($karya->link_repo)
                            <a href="{{ $karya->link_repo }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="border border-[#9D292C] text-[#9D292C] px-5 py-3 rounded-md text-sm font-semibold">
                                Link Repo ↗
                            </a>
                        @endif

                    </div>

                </div>

                <!-- Lampiran -->
                <div class="bg-white border border-gray-200 rounded-lg p-5 mt-6">

                    <h2 class="font-bold text-gray-900 mb-4">
                        Lampiran Karya
                    </h2>

                    @forelse($karya->lampirans as $lampiran)

                        <div class="flex justify-between items-center border-t border-gray-100 py-4 gap-3">

                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $lampiran->nama_file }}
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $lampiran->tipe }}
                                </p>
                            </div>

                            <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($lampiran->path) }}"
                               target="_blank"
                               class="text-xs font-semibold text-[#9D292C]">
                                Unduh ↗
                            </a>

                        </div>

                    @empty

                        <p class="text-sm text-gray-500">
                            Belum ada lampiran karya.
                        </p>

                    @endforelse

                </div>

            </div>

            <!-- Sidebar -->
            <aside class="space-y-5">

                <div class="bg-white border border-gray-200 rounded-lg p-5">

                    <h3 class="font-bold text-gray-900">
                        Mahasiswa
                    </h3>

                    <div class="mt-4">
                        <p class="font-semibold text-gray-800">
                            {{ $karya->mahasiswa?->name ?? 'Mahasiswa' }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            {{ $karya->mahasiswa?->prodi ?? 'Program Studi' }}
                        </p>
                    </div>

                </div>

                <div class="bg-green-50 border border-green-200 rounded-lg p-5">

                    <h3 class="font-bold text-green-800">
                        ✓ Telah Diverifikasi
                    </h3>

                    <p class="text-xs text-green-700 mt-3 leading-relaxed">
                        Karya ini telah melalui proses verifikasi fakultas dan dinyatakan layak ditampilkan.
                    </p>

                </div>

                <div class="bg-[#F5EEEB] rounded-lg p-5">

                    <h3 class="font-bold text-gray-900">
                        Tertarik dengan karya ini?
                    </h3>

                    <p class="text-xs text-gray-600 mt-2">
                        Hubungi pemilik karya untuk membahas peluang kolaborasi.
                    </p>

                    <a href="/register"
                       class="block text-center bg-[#9D292C] text-white py-3 rounded-md text-sm font-semibold mt-4">
                        Gabung Sekarang
                    </a>

                </div>

            </aside>

        </div>

        <!-- Karya Lainnya -->
        <div class="mt-12">

            <h2 class="text-xl font-bold text-gray-900 mb-5">
                Jelajahi Karya Lainnya
            </h2>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

                @foreach($karyaLainnya as $lainnya)

                    <a href="{{ route('publik.karya.detail', $lainnya->id) }}"
                       class="bg-white border border-gray-200 rounded-lg p-5 hover:shadow-md transition">

                        <span class="text-xs font-semibold text-[#9D292C]">
                            {{ $lainnya->kategori?->nama_kategori ?? 'Umum' }}
                        </span>

                        <h3 class="font-bold text-gray-900 mt-3">
                            {{ $lainnya->judul }}
                        </h3>

                        <p class="text-xs text-gray-500 mt-2">
                            {{ \Illuminate\Support\Str::limit($lainnya->ringkasan, 80) }}
                        </p>

                        <p class="text-xs text-[#9D292C] font-semibold mt-4">
                            Lihat Detail →
                        </p>

                    </a>

                @endforeach

            </div>

        </div>

    </div>
</section>

@endsection
