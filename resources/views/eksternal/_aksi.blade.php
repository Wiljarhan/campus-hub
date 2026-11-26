@if (auth()->check() && in_array(auth()->user()->role, ['umkm', 'recruiter'], true))
    @if ($karya->status === 'terverifikasi' || session('error'))
        <div class="mt-6 space-y-4">
            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if ($karya->status === 'terverifikasi')
                @if ($errors->any())
                    <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        <p class="font-medium mb-1">Terjadi kesalahan pada input Anda:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (auth()->user()->role === 'umkm')
                    <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Ajukan Adopsi</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Kirim pesan permintaan adopsi karya ini untuk kebutuhan usaha Anda.
                        </p>

                        <form action="{{ route('eksternal.adopsi.store', $karya) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="adopsi-pesan" class="block text-sm font-medium text-gray-700 mb-1">
                                    Pesan Permintaan Adopsi
                                </label>
                                <textarea
                                    id="adopsi-pesan"
                                    name="pesan"
                                    rows="4"
                                    maxlength="1000"
                                    required
                                    placeholder="Jelaskan rencana adopsi atau kerja sama yang ingin Anda ajukan..."
                                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                >{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button
                                    type="submit"
                                    class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                >
                                    Ajukan Adopsi
                                </button>
                            </div>
                        </form>
                    </div>
                @elseif (auth()->user()->role === 'recruiter')
                    <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">Kirim Undangan</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Undang pemilik karya ini untuk peluang rekrutmen di perusahaan Anda.
                        </p>

                        <form action="{{ route('eksternal.undangan.store', $karya) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="undangan-posisi" class="block text-sm font-medium text-gray-700 mb-1">
                                    Posisi yang Ditawarkan
                                </label>
                                <input
                                    id="undangan-posisi"
                                    type="text"
                                    name="posisi"
                                    value="{{ old('posisi') }}"
                                    maxlength="255"
                                    required
                                    placeholder="Contoh: Junior Backend Developer"
                                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                >
                                @error('posisi')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="undangan-pesan" class="block text-sm font-medium text-gray-700 mb-1">
                                    Pesan Undangan
                                </label>
                                <textarea
                                    id="undangan-pesan"
                                    name="pesan"
                                    rows="4"
                                    maxlength="1000"
                                    required
                                    placeholder="Tuliskan detail tawaran, tahapan rekrutmen, atau kontak yang dapat dihubungi..."
                                    class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                >{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button
                                    type="submit"
                                    class="inline-flex items-center rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                                >
                                    Kirim Undangan
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            @endif
        </div>
    @endif
@endif
