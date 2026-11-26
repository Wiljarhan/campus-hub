@extends('layouts.app')

@section('content')
    @php
        $roleLabels = [
            'mahasiswa' => 'Mahasiswa',
            'verifikator' => 'Verifikator',
            'umkm' => 'UMKM',
            'recruiter' => 'Recruiter',
        ];

        $profileFields = [
            'NIM' => $user->nim,
            'Program Studi' => $user->prodi,
            'NIP' => $user->nip,
            'Nama Usaha' => $user->nama_usaha,
            'Bidang Usaha' => $user->bidang,
            'Perusahaan' => $user->perusahaan,
        ];
    @endphp

    <div class="flex items-center justify-center py-8">
        <div class="w-full max-w-lg bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
            <div class="mb-6 flex items-start justify-between gap-4 border-b border-gray-200 pb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Informasi Akun</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Detail profil akun yang sedang masuk.
                    </p>
                </div>
                @include('auth._logout')
            </div>

            <dl class="divide-y divide-gray-200 text-sm">
                <div class="py-3 flex justify-between gap-4">
                    <dt class="font-medium text-gray-600">Nama</dt>
                    <dd class="text-gray-900 text-right">{{ $user->name }}</dd>
                </div>
                <div class="py-3 flex justify-between gap-4">
                    <dt class="font-medium text-gray-600">Email</dt>
                    <dd class="text-gray-900 text-right">{{ $user->email }}</dd>
                </div>
                <div class="py-3 flex justify-between gap-4">
                    <dt class="font-medium text-gray-600">Role</dt>
                    <dd class="text-gray-900 text-right">{{ $roleLabels[$user->role] ?? ucfirst((string) $user->role) }}</dd>
                </div>

                @foreach ($profileFields as $label => $value)
                    @if (filled($value))
                        <div class="py-3 flex justify-between gap-4">
                            <dt class="font-medium text-gray-600">{{ $label }}</dt>
                            <dd class="text-gray-900 text-right">{{ $value }}</dd>
                        </div>
                    @endif
                @endforeach
            </dl>
        </div>
    </div>
@endsection
