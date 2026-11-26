@extends('layouts.app')

@section('content')
    @php
        $statusClasses = match ($karya->status) {
            'terverifikasi', 'disetujui', 'diterima' => 'bg-green-100 text-green-800',
            'ditolak' => 'bg-red-100 text-red-800',
            'revisi' => 'bg-orange-100 text-orange-800',
            'menunggu' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    @endphp

    <div class="space-y-6">
        @if (session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="space-y-2">
                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $karya->judul }}</h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize {{ $statusClasses }}">
                        {{ $karya->status }}
                    </span>
                </div>
                <p class="text-sm text-gray-600">
                    Detail karya mahasiswa untuk ditinjau oleh verifikator.
                </p>
            </div>

            <div>
                <a href="{{ route('verifikator.index') }}"
                   class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 space-y-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                <div>
                    <dt class="font-medium text-gray-500">Nama Mahasiswa</dt>
                    <dd class="mt-1 text-gray-900 font-medium">{{ $karya->mahasiswa?->name ?? '-' }}</dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-500">Email Mahasiswa</dt>
                    <dd class="mt-1 text-gray-900">{{ $karya->mahasiswa?->email ?? '-' }}</dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-500">Kategori</dt>
                    <dd class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                            {{ $karya->kategori?->nama_kategori ?? '-' }}
                        </span>
                    </dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-500">Tanggal Unggah</dt>
                    <dd class="mt-1 text-gray-900">{{ $karya->created_at?->format('d M Y, H:i') ?? '-' }}</dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-500">Link Demo</dt>
                    <dd class="mt-1">
                        @if ($karya->link_demo)
                            <a href="{{ $karya->link_demo }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="text-indigo-600 hover:text-indigo-800 underline break-all">
                                {{ $karya->link_demo }}
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </dd>
                </div>

                <div>
                    <dt class="font-medium text-gray-500">Link Repo</dt>
                    <dd class="mt-1">
                        @if ($karya->link_repo)
                            <a href="{{ $karya->link_repo }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="text-indigo-600 hover:text-indigo-800 underline break-all">
                                {{ $karya->link_repo }}
                            </a>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </dd>
                </div>
            </dl>

            <div class="border-t border-gray-200 pt-6">
                <h2 class="text-sm font-medium text-gray-500">Ringkasan</h2>
                <p class="mt-2 text-sm text-gray-900 whitespace-pre-line">{{ $karya->ringkasan ?? '-' }}</p>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <h2 class="text-sm font-medium text-gray-500 mb-3">Lampiran</h2>
                @if ($karya->lampirans->isEmpty())
                    <p class="text-sm text-gray-500">Tidak ada lampiran</p>
                @else
                    <ul class="divide-y divide-gray-200 border border-gray-200 rounded-md">
                        @foreach ($karya->lampirans as $lampiran)
                            <li class="px-4 py-3 flex items-center justify-between gap-4 text-sm">
                                <a href="{{ asset('storage/' . $lampiran->path) }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="text-indigo-600 hover:text-indigo-800 font-medium underline break-all">
                                    {{ $lampiran->nama_file }}
                                </a>
                                @if ($lampiran->tipe)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700 shrink-0">
                                        {{ $lampiran->tipe }}
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 space-y-6">
            <h2 class="text-lg font-semibold text-gray-900">Keputusan Verifikasi</h2>

            @if ($karya->status === 'menunggu')
                <div class="space-y-6">
                    <form action="{{ route('verifikator.setujui', $karya) }}"
                          method="POST"
                          onsubmit="return confirm('Setujui karya ini?')">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium bg-green-600 text-white hover:bg-green-700 transition">
                            Setujui
                        </button>
                    </form>

                    <form action="{{ route('verifikator.tolak', $karya) }}"
                          method="POST"
                          class="border-t border-gray-200 pt-6 space-y-4">
                        @csrf
                        <div>
                            <label for="catatan" class="block text-sm font-medium text-gray-700">
                                Catatan Revisi <span class="text-red-600">*</span>
                            </label>
                            <textarea id="catatan"
                                      name="catatan"
                                      rows="4"
                                      required
                                      placeholder="Tuliskan alasan penolakan atau catatan revisi minimal 10 karakter..."
                                      class="mt-1 block w-full rounded-md border @error('catatan') border-red-500 @else border-gray-300 @enderror px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium bg-red-600 text-white hover:bg-red-700 transition">
                            Tolak
                        </button>
                    </form>
                </div>
            @else
                <p class="text-sm text-gray-700">
                    Karya ini sudah diputuskan dengan status: <span class="font-semibold">{{ $karya->status }}</span>
                </p>
            @endif
        </div>
    </div>
@endsection
