<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            'Aplikasi Web',
            'Aplikasi Mobile',
            'Data dan AI',
            'IoT',
            'Desain dan Multimedia',
            'Lainnya',
        ];

        foreach ($kategoris as $nama) {
            Kategori::firstOrCreate([
                'nama_kategori' => $nama,
            ]);
        }
    }
}
