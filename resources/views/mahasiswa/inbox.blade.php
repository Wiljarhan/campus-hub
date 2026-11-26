@extends('layouts.app')

@section('content')
    {{-- Header halaman inbox mahasiswa --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Inbox Mahasiswa</h1>
            <p class="text-sm text-gray-600 mt-1">
                Kelola permintaan adopsi karya dari UMKM dan undangan rekrutmen dari recruiter.
            </p>
        </div>

        {{-- Tombol kembali ke daftar karya saya --}}
        <a href="{{ route('mahasiswa.index') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 text-sm font-medium rounded-lg shadow-sm transition">
            Kembali
        </a>
    </div>

    {{-- Tampilkan notifikasi kotak hijau jika ada pesan sukses dari session --}}
    @if (session('sukses'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 shadow-sm">
            {{ session('sukses') }}
        </div>
    @endif

    <div class="space-y-8">
        {{-- Bagian 1: Permintaan Adopsi (UMKM) --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-900 mb-3">Permintaan Adopsi (UMKM)</h2>

            @if ($permintaanAdopsis->isEmpty())
                <div class="bg-white rounded-lg border border-gray-200 p-6 text-center shadow-sm">
                    <p class="text-sm text-gray-600">Belum ada permintaan adopsi.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($permintaanAdopsis as $permintaan)
                        @php
                            // Tentukan warna badge status permintaan adopsi
                            $badgeClass = match ($permintaan->status) {
                                'menunggu' => 'bg-yellow-100 text-yellow-800',
                                'diterima' => 'bg-green-100 text-green-800',
                                'ditolak' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp

                        <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                                <div>
                                    {{-- Judul karya dan nama pengirim UMKM --}}
                                    <h3 class="text-base font-semibold text-gray-900">
                                        {{ $permintaan->karya?->judul ?? '-' }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Pengirim: <span class="font-medium text-gray-800">{{ $permintaan->umkm?->name ?? '-' }}</span>
                                    </p>
                                </div>

                                {{-- Badge status berwarna --}}
                                <span class="inline-flex items-center self-start px-2.5 py-0.5 rounded-full text-xs font-medium capitalize {{ $badgeClass }}">
                                    {{ $permintaan->status }}
                                </span>
                            </div>

                            {{-- Pesan dari UMKM --}}
                            <p class="mt-3 text-sm text-gray-700 bg-gray-50 rounded-md p-3 border border-gray-100">
                                {{ $permintaan->pesan }}
                            </p>

                            {{-- Tampilkan tombol Terima dan Tolak hanya jika status masih menunggu --}}
                            @if ($permintaan->status === 'menunggu')
                                <div class="mt-4 flex items-center gap-2">
                                    {{-- Form PATCH untuk menerima permintaan adopsi --}}
                                    <form action="{{ route('mahasiswa.adopsi.respon', $permintaan) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded-md shadow-sm transition">
                                            Terima
                                        </button>
                                    </form>

                                    {{-- Form PATCH untuk menolak permintaan adopsi --}}
                                    <form action="{{ route('mahasiswa.adopsi.respon', $permintaan) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-md shadow-sm transition">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- Bagian 2: Undangan Rekrutmen (Recruiter) --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-900 mb-3">Undangan Rekrutmen (Recruiter)</h2>

            @if ($undanganRekrutmens->isEmpty())
                <div class="bg-white rounded-lg border border-gray-200 p-6 text-center shadow-sm">
                    <p class="text-sm text-gray-600">Belum ada undangan rekrutmen.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($undanganRekrutmens as $undangan)
                        @php
                            // Tentukan warna badge status undangan rekrutmen
                            $badgeClass = match ($undangan->status) {
                                'menunggu' => 'bg-yellow-100 text-yellow-800',
                                'diterima' => 'bg-green-100 text-green-800',
                                'ditolak' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp

                        <div class="bg-white rounded-lg border border-gray-200 p-5 shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                                <div>
                                    {{-- Judul karya, nama pengirim recruiter, dan posisi yang ditawarkan --}}
                                    <h3 class="text-base font-semibold text-gray-900">
                                        {{ $undangan->karya?->judul ?? '-' }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Pengirim: <span class="font-medium text-gray-800">{{ $undangan->recruiter?->name ?? '-' }}</span>
                                    </p>
                                    <p class="text-sm text-gray-600 mt-0.5">
                                        Posisi: <span class="font-medium text-gray-800">{{ $undangan->posisi }}</span>
                                    </p>
                                </div>

                                {{-- Badge status berwarna --}}
                                <span class="inline-flex items-center self-start px-2.5 py-0.5 rounded-full text-xs font-medium capitalize {{ $badgeClass }}">
                                    {{ $undangan->status }}
                                </span>
                            </div>

                            {{-- Pesan dari recruiter --}}
                            <p class="mt-3 text-sm text-gray-700 bg-gray-50 rounded-md p-3 border border-gray-100">
                                {{ $undangan->pesan ?: '-' }}
                            </p>

                            {{-- Tampilkan tombol Terima dan Tolak hanya jika status masih menunggu --}}
                            @if ($undangan->status === 'menunggu')
                                <div class="mt-4 flex items-center gap-2">
                                    {{-- Form PATCH untuk menerima undangan rekrutmen --}}
                                    <form action="{{ route('mahasiswa.undangan.respon', $undangan) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="diterima">
                                        <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded-md shadow-sm transition">
                                            Terima
                                        </button>
                                    </form>

                                    {{-- Form PATCH untuk menolak undangan rekrutmen --}}
                                    <form action="{{ route('mahasiswa.undangan.respon', $undangan) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-md shadow-sm transition">
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection
