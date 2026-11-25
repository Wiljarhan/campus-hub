<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Mahasiswa Contoh',
                'email' => 'mahasiswa@contoh.test',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'nim' => 'F1G125001',
                'prodi' => 'Ilmu Komputer',
            ],
            [
                'name' => 'Verifikator Contoh',
                'email' => 'verifikator@contoh.test',
                'password' => Hash::make('password'),
                'role' => 'verifikator',
                'nip' => '1990010120200101',
            ],
            [
                'name' => 'UMKM Contoh',
                'email' => 'umkm@contoh.test',
                'password' => Hash::make('password'),
                'role' => 'umkm',
                'nama_usaha' => 'Toko Contoh',
                'bidang' => 'Kuliner',
            ],
            [
                'name' => 'Recruiter Contoh',
                'email' => 'recruiter@contoh.test',
                'password' => Hash::make('password'),
                'role' => 'recruiter',
                'perusahaan' => 'PT Contoh Maju',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }
    }
}
