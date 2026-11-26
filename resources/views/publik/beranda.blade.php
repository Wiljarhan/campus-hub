
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- HERO SECTION --}}
<section class="bg-[#65090B] text-white">
    <div class="max-w-6xl mx-auto px-6 py-14 grid md:grid-cols-2 gap-10 items-center">

        <div>
            <p class="text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-4">
                Talenta Kampus, Dampak Nyata
            </p>

            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-5">
                Karya terverifikasi.<br>
                Peluang tanpa batas.
            </h1>

            <p class="text-sm text-red-100 leading-relaxed max-w-lg mb-7">
                Temukan inovasi mahasiswa FMIPA UHO. Dari ruang kuliah
                menjadi solusi untuk UMKM dan talenta untuk dunia kerja.
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="{{ url('/katalog') }}"
                   class="bg-[#D4AF37] text-[#65090B] px-5 py-3 rounded font-semibold text-sm hover:opacity-90">
                    Jelajahi Katalog →
                </a>

                <a href="{{ url('/register') }}"
                   class="border border-white/40 px-5 py-3 rounded text-sm hover:bg-white/10">
                    Kenali platform
                </a>
            </div>

            <div class="border-t border-white/20 mt-8 pt-5 flex gap-6 text-xs text-red-100">
                <span>✓ Diverifikasi fakultas</span>
                <span>✓ Terbuka untuk kolaborasi</span>
            </div>
        </div>

        {{-- PREVIEW DASHBOARD --}}
        <div class="bg-white rounded-lg p-5 shadow-xl text-gray-800 max-w-md w-full mx-auto">
            <p class="text-xs text-red-700 font-bold mb-4">
                SCREENSHOT KARYA MAHASISWA
            </p>

            <div class="bg-[#F8F5F0] rounded p-4">
                <h3 class="font-bold text-sm mb-3">SiKasir</h3>
                <p class="text-xs text-gray-500 mb-3">
                    Ringkasan penjualan
                </p>

                <div class="grid grid-cols-3 gap-2 mb-5">
                    <div class="bg-white p-2 rounded text-center">
                        <p class="text-xs text-gray-500">Pendapatan</p>
                        <b class="text-sm text-green-800">Rp 2,4 jt</b>
                    </div>

                    <div class="bg-white p-2 rounded text-center">
                        <p class="text-xs text-gray-500">Transaksi</p>
                        <b class="text-sm">48</b>
                    </div>

                    <div class="bg-white p-2 rounded text-center">
                        <p class="text-xs text-gray-500">Produk</p>
                        <b class="text-sm">126</b>
                    </div>
                </div>

                <div class="h-24 flex items-end gap-2 justify-center border-b border-gray-200 px-3">
                    <div class="bg-green-700/60 w-5 h-10 rounded-t"></div>
                    <div class="bg-green-700/60 w-5 h-14 rounded-t"></div>
                    <div class="bg-green-700/60 w-5 h-12 rounded-t"></div>
                    <div class="bg-green-700/60 w-5 h-20 rounded-t"></div>
                    <div class="bg-green-700/60 w-5 h-16 rounded-t"></div>
                    <div class="bg-[#D4AF37] w-5 h-24 rounded-t"></div>
                </div>
            </div>

            <div class="mt-4 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-sm">
                        SiKasir — Kasir Digital UMKM
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">
                        Web Application · Sistem Informasi
                    </p>
                </div>

                <span class="text-xs text-green-700 font-semibold">
                    ✓ Terverifikasi
                </span>
            </div>
        </div>

    </div>
</section>


{{-- PERAN PENGGUNA --}}
<section class="max-w-6xl mx-auto px-6 py-12">

    <div class="mb-7">
        <h2 class="text-2xl font-bold text-gray-900">
            Satu ekosistem, banyak kemungkinan.
        </h2>

        <p class="text-sm text-gray-500 mt-2">
            Pilih peran Anda dan mulai wujudkan kolaborasi yang berarti.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-5">

        <div class="bg-[#F8F5F2] p-6 rounded-lg">
            <span class="text-xs font-bold text-[#9D292C]">01</span>

            <h3 class="font-bold text-lg mt-3">Mahasiswa</h3>

            <p class="text-sm text-gray-600 mt-2">
                Tampilkan karya terbaik, bangun portofolio,
                dan buka peluang karier Anda.
            </p>

            <a href="{{ url('/register') }}"
               class="inline-block text-sm text-[#9D292C] font-semibold mt-5">
                Mulai unggah karya →
            </a>
        </div>

        <div class="bg-[#F8F5F2] p-6 rounded-lg">
            <span class="text-xs font-bold text-[#9D292C]">02</span>

            <h3 class="font-bold text-lg mt-3">UMKM</h3>

            <p class="text-sm text-gray-600 mt-2">
                Temukan solusi tepat dari inovasi mahasiswa
                untuk mengembangkan usaha Anda.
            </p>

            <a href="{{ url('/register') }}"
               class="inline-block text-sm text-[#9D292C] font-semibold mt-5">
                Temukan solusi →
            </a>
        </div>

        <div class="bg-[#F8F5F2] p-6 rounded-lg">
            <span class="text-xs font-bold text-[#9D292C]">03</span>

            <h3 class="font-bold text-lg mt-3">Recruiter</h3>

            <p class="text-sm text-gray-600 mt-2">
                Kenali kemampuan nyata mahasiswa melalui
                karya yang telah diverifikasi fakultas.
            </p>

            <a href="{{ url('/register') }}"
               class="inline-block text-sm text-[#9D292C] font-semibold mt-5">
                Temukan talenta →
            </a>
        </div>

    </div>
</section>


{{-- KARYA TERBARU --}}
<section class="bg-[#FAF9F7] py-12">
    <div class="max-w-6xl mx-auto px-6">

        <div class="flex justify-between items-end mb-7">
            <div>
                <p class="text-xs font-bold text-[#9D292C] uppercase tracking-wider">
                    Dari Ide Menjadi Solusi
                </p>

                <h2 class="text-2xl font-bold mt-2">
                    Karya Terbaru
                </h2>

                <p class="text-sm text-gray-500 mt-2">
                    Jelajahi inovasi pilihan yang telah melalui verifikasi fakultas.
                </p>
            </div>

            <a href="{{ url('/katalog') }}"
               class="hidden sm:block text-sm text-[#9D292C] font-semibold">
                Lihat semua karya →
            </a>
        </div>

        {{-- DATA KARYA DARI DATABASE --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

            @forelse($karyaTerbaru as $karya)

                <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition">

                    <div class="h-36 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center p-4">
                        <span class="text-xl font-bold text-[#7B1113] text-center">
                            {{ $karya->judul }}
                        </span>
                    </div>

                    <div class="p-4">

                        <p class="text-xs font-bold text-[#9D292C] uppercase">
                            {{ $karya->kategori?->nama_kategori ?? 'Tanpa Kategori' }}
                        </p>

                        <h3 class="font-bold text-base mt-2">
                            {{ $karya->judul }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $karya->mahasiswa?->name ?? 'Mahasiswa' }}
                        </p>

                        <p class="text-sm text-gray-600 mt-2">
                            {{ \Illuminate\Support\Str::limit($karya->ringkasan ?? '', 90) }}
                        </p>

                        <div class="border-t mt-4 pt-3">
                            <span class="text-xs text-green-700 font-semibold">
                                ✓ Terverifikasi
                            </span>
                        </div>

                    </div>
                </article>

            @empty

                <div class="col-span-full text-center py-10 text-gray-500">
                    Belum ada karya yang terverifikasi.
                </div>

            @endforelse

        </div>

        <div class="text-center mt-7 sm:hidden">
            <a href="{{ url('/katalog') }}"
               class="text-sm font-semibold text-[#9D292C]">
                Lihat semua karya →
            </a>
        </div>

    </div>
</section>


{{-- STATISTIK --}}
<section class="bg-[#F7ECEA] py-9">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

        <div>
            <h3 class="text-3xl font-bold text-[#9D292C]">
                {{ $totalKarya }}
            </h3>
            <p class="text-xs text-gray-600 mt-2">
                Karya terverifikasi
            </p>
        </div>

        <div>
            <h3 class="text-3xl font-bold text-[#9D292C]">240</h3>
            <p class="text-xs text-gray-600 mt-2">
                Talenta mahasiswa
            </p>
        </div>

        <div>
            <h3 class="text-3xl font-bold text-[#9D292C]">36</h3>
            <p class="text-xs text-gray-600 mt-2">
                Mitra UMKM
            </p>
        </div>

        <div>
            <h3 class="text-3xl font-bold text-[#9D292C]">18</h3>
            <p class="text-xs text-gray-600 mt-2">
                Kolaborasi terjalin
            </p>
        </div>

    </div>
</section>

@endsection
