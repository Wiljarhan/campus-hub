@extends('layouts.app')

@section('content')
    @php
        $judulHalaman = $role === 'umkm'
            ? 'Riwayat Permintaan Adopsi'
            : 'Riwayat Undangan Rekrutmen';

        $statusBadgeClasses = [
            'menunggu' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            'diterima' => 'bg-green-100 text-green-800 border-green-200',
            'ditolak' => 'bg-red-100 text-red-800 border-red-200',
        ];
    @endphp

    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $judulHalaman }}</h1>
                <p class="text-sm text-gray-600 mt-1">
                    @if ($role === 'umkm')
                        Daftar permintaan adopsi karya yang telah Anda kirimkan.
                    @else
                        Daftar undangan rekrutmen yang telah Anda kirimkan kepada mahasiswa.
                    @endif
                </p>
            </div>
        </div>

        @if ($riwayats->isEmpty())
            <div class="bg-white rounded-lg border border-gray-200 p-8 text-center shadow-sm">
                <p class="text-gray-600">Belum ada riwayat.</p>
            </div>
        @else
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">
                                    Judul Karya
                                </th>
                                @if ($role === 'recruiter')
                                    <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">
                                        Posisi
                                    </th>
                                @endif
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">
                                    Pesan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700 whitespace-nowrap">
                                    Tanggal Dikirim
                                </th>
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left font-semibold text-gray-700">
                                    Kontak Mahasiswa
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($riwayats as $item)
                                @php
                                    $badgeClass = $statusBadgeClasses[$item->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                    $mahasiswa = $role === 'umkm' ? $item->karya?->mahasiswa : $item->mahasiswa;
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $item->karya?->judul ?? '-' }}
                                    </td>

                                    @if ($role === 'recruiter')
                                        <td class="px-6 py-4 text-gray-700">
                                            {{ $item->posisi }}
                                        </td>
                                    @endif

                                    <td class="px-6 py-4 text-gray-700 max-w-md whitespace-pre-line">
                                        {{ $item->pesan }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $item->created_at?->format('d M Y, H:i') ?? '-' }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-medium {{ $badgeClass }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item->status === 'diterima' && $mahasiswa?->email)
                                            <a
                                                href="mailto:{{ $mahasiswa->email }}"
                                                class="text-blue-600 hover:text-blue-800 hover:underline font-medium"
                                            >
                                                {{ $mahasiswa->email }}
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
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
