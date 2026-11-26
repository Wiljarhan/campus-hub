@extends('layouts.app')

@section('content')
    {{-- Header halaman: judul dan tombol unggah karya di atas daftar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Karya Saya</h1>
            <p class="text-sm text-gray-600 mt-1">
                Daftar karya yang telah kamu unggah beserta status verifikasinya.
            </p>
        </div>

        {{-- Tombol sementara menuju "#" karena route unggah karya akan dibuat nanti --}}
        <a href="#"
           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
            Unggah Karya
        </a>
    </div>

    {{-- Cek apakah mahasiswa sudah memiliki karya atau belum --}}
    @if ($karyas->isEmpty())
        {{-- Tampilan pesan jika belum ada karya sama sekali --}}
        <div class="bg-white rounded-lg border border-gray-200 p-8 text-center shadow-sm">
            <p class="text-gray-600">Belum ada karya. Unggah karya pertamamu.</p>
        </div>
    @else
        {{-- Tabel daftar karya milik mahasiswa --}}
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">Kategori</th>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">Status</th>
                        <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">Catatan Revisi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($karyas as $karya)
                        @php
                            // Tentukan warna badge berdasarkan status karya
                            $badgeClass = match ($karya->status) {
                                'menunggu' => 'bg-yellow-100 text-yellow-800',
                                'terverifikasi' => 'bg-green-100 text-green-800',
                                'ditolak' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <tr class="hover:bg-gray-50">
                            {{-- Kolom judul karya --}}
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $karya->judul }}
                            </td>

                            {{-- Kolom kategori karya (gunakan null-safe jika kategori kosong) --}}
                            <td class="px-6 py-4 text-gray-600">
                                {{ $karya->kategori?->nama_kategori ?? '-' }}
                            </td>

                            {{-- Kolom badge status verifikasi --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize {{ $badgeClass }}">
                                    {{ $karya->status }}
                                </span>
                            </td>

                            {{-- Kolom catatan revisi: hanya tampil jika ditolak dan memiliki catatan --}}
                            <td class="px-6 py-4 text-gray-600">
                                @if ($karya->status === 'ditolak' && !empty($karya->verifikasi?->catatan))
                                    {{ $karya->verifikasi->catatan }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
