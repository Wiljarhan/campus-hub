<?php

namespace Database\Seeders;

use App\Models\Karya;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Database\Seeder;

class KaryaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = User::where('email', 'mahasiswa@contoh.test')->firstOrFail();
        $verifikator = User::where('email', 'verifikator@contoh.test')->firstOrFail();

        $kategoriWeb = Kategori::where('nama_kategori', 'Aplikasi Web')->first()
            ?? Kategori::firstOrFail();
        $kategoriAi = Kategori::where('nama_kategori', 'Data dan AI')->first()
            ?? Kategori::firstOrFail();
        $kategoriIot = Kategori::where('nama_kategori', 'IoT')->first()
            ?? Kategori::firstOrFail();

        $karyaTerverifikasi = Karya::create([
            'user_id' => $mahasiswa->id,
            'kategori_id' => $kategoriWeb->id,
            'judul' => 'Sistem Kasir & Inventaris UMKM Berbasis Web',
            'ringkasan' => 'Aplikasi web untuk pencatatan transaksi harian, manajemen stok bahan baku, serta laporan laba rugi otomatis yang dirancang khusus untuk pelaku UMKM kuliner.',
            'link_demo' => 'https://demo.contoh.test/kasir-umkm',
            'link_repo' => 'https://github.com/contoh-mahasiswa/kasir-umkm-web',
            'status' => 'terverifikasi',
        ]);

        Verifikasi::create([
            'karya_id' => $karyaTerverifikasi->id,
            'verifikator_id' => $verifikator->id,
            'hasil' => 'setujui',
            'catatan' => 'Karya lengkap, tautan demo dapat diakses, dan dokumentasi repositori sudah jelas.',
        ]);

        Karya::create([
            'user_id' => $mahasiswa->id,
            'kategori_id' => $kategoriAi->id,
            'judul' => 'Prediksi Permintaan Stok Warung dengan Time Series',
            'ringkasan' => 'Model machine learning berbasis Python dan dashboard web ringan untuk memprediksi kebutuhan stok harian berdasarkan histori penjualan mingguan.',
            'link_demo' => 'https://demo.contoh.test/prediksi-stok',
            'link_repo' => 'https://github.com/contoh-mahasiswa/prediksi-stok-ai',
            'status' => 'menunggu',
        ]);

        $karyaDitolak = Karya::create([
            'user_id' => $mahasiswa->id,
            'kategori_id' => $kategoriIot->id,
            'judul' => 'Monitoring Suhu & Kelembaban Gudang Penyimpanan',
            'ringkasan' => 'Perangkat sensor berbasis ESP32 yang mengirimkan data suhu dan kelembaban secara berkala ke dashboard monitoring serta memberi peringatan dini.',
            'link_demo' => 'https://demo.contoh.test/monitoring-gudang',
            'link_repo' => 'https://github.com/contoh-mahasiswa/iot-monitoring-gudang',
            'status' => 'ditolak',
        ]);

        Verifikasi::create([
            'karya_id' => $karyaDitolak->id,
            'verifikator_id' => $verifikator->id,
            'hasil' => 'tolak',
            'catatan' => 'Revisi diperlukan: tautan demo belum menampilkan data simulasi sensor dan README repositori belum menyertakan skema rangkaian.',
        ]);
    }
}
