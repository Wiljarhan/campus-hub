<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman form login.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi login pengguna.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectByRole($request->user()->role);
    }

    /**
     * Tampilkan halaman form pendaftaran akun.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran akun pengguna baru.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'role' => ['required', 'in:mahasiswa,verifikator,umkm,recruiter'],
            'nim' => ['nullable', 'string', 'max:255', 'required_if:role,mahasiswa'],
            'prodi' => ['nullable', 'string', 'max:255', 'required_if:role,mahasiswa'],
            'nip' => ['nullable', 'string', 'max:255', 'required_if:role,verifikator'],
            'nama_usaha' => ['nullable', 'string', 'max:255', 'required_if:role,umkm'],
            'bidang' => ['nullable', 'string', 'max:255', 'required_if:role,umkm'],
            'perusahaan' => ['nullable', 'string', 'max:255', 'required_if:role,recruiter'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain atau masuk',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role yang dipilih tidak valid.',
            'nim.required_if' => 'NIM wajib diisi untuk mahasiswa.',
            'prodi.required_if' => 'Program studi wajib diisi untuk mahasiswa.',
            'nip.required_if' => 'NIP wajib diisi untuk verifikator.',
            'nama_usaha.required_if' => 'Nama usaha wajib diisi untuk UMKM.',
            'bidang.required_if' => 'Bidang usaha wajib diisi untuk UMKM.',
            'perusahaan.required_if' => 'Nama perusahaan wajib diisi untuk recruiter.',
        ]);

        $role = $validated['role'];

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role = $role;
        $user->nim = $role === 'mahasiswa' ? $validated['nim'] : null;
        $user->prodi = $role === 'mahasiswa' ? $validated['prodi'] : null;
        $user->nip = $role === 'verifikator' ? $validated['nip'] : null;
        $user->nama_usaha = $role === 'umkm' ? $validated['nama_usaha'] : null;
        $user->bidang = $role === 'umkm' ? $validated['bidang'] : null;
        $user->perusahaan = $role === 'recruiter' ? $validated['perusahaan'] : null;
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectByRole($user->role);
    }

    /**
     * Tampilkan halaman profil akun pengguna saat ini.
     */
    public function akun(Request $request): View
    {
        return view('auth.akun', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Keluarkan pengguna dan akhiri sesi saat ini.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Anda telah keluar.');
    }

    /**
     * Arahkan pengguna ke halaman sesuai role.
     */
    private function redirectByRole(?string $role): RedirectResponse
    {
        return match ($role) {
            'mahasiswa' => redirect('/mahasiswa'),
            'verifikator' => redirect('/verifikator'),
            'umkm', 'recruiter' => redirect('/katalog'),
            default => redirect()->route('akun'),
        };
    }
}
