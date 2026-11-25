<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Campus Talent & Showcase Hub')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        marun: '#7B1113',
                        emas: '#D4AF37',
                        gelap: '#111827',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-gray-800 bg-white min-h-screen flex flex-col">

    {{-- Bar kecil di atas --}}
    <div class="bg-marun text-white text-xs">
        <div class="max-w-6xl mx-auto px-4 py-1.5 flex justify-between">
            <span>Fakultas MIPA Universitas Halu Oleo</span>
            <div class="space-x-4">
                <a href="{{ url('/') }}" class="hover:text-emas">Beranda</a>
                <a href="{{ url('/katalog') }}" class="hover:text-emas">Katalog</a>
            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <header class="bg-white border-b shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-uho.png') }}" alt="" class="h-10 w-auto"
                     onerror="this.style.display='none'">
                <span class="font-bold text-marun leading-tight">Campus Talent &amp;<br>Showcase Hub</span>
            </a>

            <button id="menu-btn" type="button" class="md:hidden p-2 rounded border text-marun" aria-label="Menu">
                &#9776;
            </button>

            <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="{{ url('/') }}" class="hover:text-marun">Beranda</a>
                <a href="{{ url('/katalog') }}" class="hover:text-marun">Katalog</a>

                @guest
                    <a href="{{ url('/login') }}" class="hover:text-marun">Masuk</a>
                    <a href="{{ url('/register') }}" class="bg-marun text-white px-4 py-2 rounded hover:opacity-90">Daftar</a>
                @endguest

                @auth
                    @if(auth()->user()->role === 'mahasiswa')
                        <a href="{{ url('/mahasiswa') }}" class="hover:text-marun">Karya Saya</a>
                    @elseif(auth()->user()->role === 'verifikator')
                        <a href="{{ url('/verifikator') }}" class="hover:text-marun">Verifikasi</a>
                    @elseif(in_array(auth()->user()->role, ['umkm', 'recruiter']))
                        <a href="{{ url('/eksternal/riwayat') }}" class="hover:text-marun">Riwayat</a>
                    @endif
                    <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                        <button type="submit" class="bg-marun text-white px-4 py-2 rounded hover:opacity-90">Keluar</button>
                    </form>
                @endauth
            </nav>
        </div>

        {{-- Menu layar kecil --}}
        <nav id="mobile-menu" class="hidden md:hidden border-t px-4 py-3 space-y-2 text-sm font-medium">
            <a href="{{ url('/') }}" class="block">Beranda</a>
            <a href="{{ url('/katalog') }}" class="block">Katalog</a>
            @guest
                <a href="{{ url('/login') }}" class="block">Masuk</a>
                <a href="{{ url('/register') }}" class="block">Daftar</a>
            @endguest
            @auth
                @if(auth()->user()->role === 'mahasiswa')
                    <a href="{{ url('/mahasiswa') }}" class="block">Karya Saya</a>
                @elseif(auth()->user()->role === 'verifikator')
                    <a href="{{ url('/verifikator') }}" class="block">Verifikasi</a>
                @elseif(in_array(auth()->user()->role, ['umkm', 'recruiter']))
                    <a href="{{ url('/eksternal/riwayat') }}" class="block">Riwayat</a>
                @endif
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="text-marun font-semibold">Keluar</button>
                </form>
            @endauth
        </nav>
    </header>

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="max-w-6xl mx-auto w-full px-4 mt-4">
            <div class="bg-green-50 border border-green-300 text-green-800 px-4 py-3 rounded">{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-6xl mx-auto w-full px-4 mt-4">
            <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 rounded">{{ session('error') }}</div>
        </div>
    @endif

    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer 4 kolom --}}
    <footer class="bg-gelap text-gray-300 text-sm mt-12">
        <div class="max-w-6xl mx-auto px-4 py-10 grid gap-8 sm:grid-cols-2 md:grid-cols-4">
            <div>
                <h3 class="text-white font-semibold mb-3">Campus Talent &amp; Showcase Hub</h3>
                <p>Etalase karya mahasiswa yang terverifikasi, terbuka untuk UMKM dan recruiter.</p>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3">Tautan</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="hover:text-emas">Beranda</a></li>
                    <li><a href="{{ url('/katalog') }}" class="hover:text-emas">Katalog</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3">Direktori</h3>
                <ul class="space-y-2">
                    <li><a href="https://fmipa.uho.ac.id" class="hover:text-emas">FMIPA UHO</a></li>
                    <li><a href="https://uho.ac.id" class="hover:text-emas">Universitas Halu Oleo</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-3">Kontak</h3>
                <p>Kampus Hijau Bumi Tridharma<br>Anduonohu, Kendari<br>Sulawesi Tenggara 93132</p>
            </div>
        </div>
        <div class="border-t border-white/10 text-center text-xs py-4">
            &copy; {{ date('Y') }} Kelompok III RPL &mdash; Campus Talent &amp; Showcase Hub
        </div>
    </footer>

    <script>
        document.getElementById('menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>