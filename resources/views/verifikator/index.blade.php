@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar Antrean Verifikasi Karya</h1>
                <p class="mt-1 text-sm text-gray-600">
                    Karya mahasiswa yang berstatus menunggu peninjauan verifikator.
                </p>
            </div>
        </div>

        @if ($karyas->isEmpty())
            <div class="bg-white border border-gray-200 rounded-lg p-8 text-center shadow-sm">
                <p class="text-gray-600">Belum ada karya yang menunggu verifikasi.</p>
            </div>
        @else
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">
                                    Judul
                                </th>
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">
                                    Nama Mahasiswa
                                </th>
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">
                                    Kategori
                                </th>
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">
                                    Tanggal Unggah
                                </th>
                                <th scope="col" class="px-6 py-3 text-right font-semibold text-gray-700">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($karyas as $karya)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $karya->judul }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $karya->mahasiswa?->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                            {{ $karya->kategori?->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $karya->created_at?->format('d M Y, H:i') ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <a href="#"
                                           class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-medium bg-indigo-600 text-white hover:bg-indigo-700 transition">
                                            Periksa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
