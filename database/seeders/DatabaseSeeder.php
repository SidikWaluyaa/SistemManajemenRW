<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::factory()->create([
            'name' => 'Admin RW',
            'email' => 'admin@rw10.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Users for RT 02 - 05
        $rts = ['02', '03', '04', '05'];
        foreach ($rts as $rt) {
            User::factory()->create([
                'name' => 'Ketua RT ' . $rt,
                'email' => 'rt' . $rt . '@rw10.com',
                'password' => bcrypt('password'),
                'role' => 'rt',
                'rt' => $rt,
            ]);
        }

        // 2. Create Transaction Categories
        $categories = [
            ['nama_kategori' => 'Iuran Wajib', 'slug' => 'iuran-wajib', 'jenis' => 'Pemasukan', 'deskripsi' => 'Iuran bulanan warga'],
            ['nama_kategori' => 'Sumbangan Sukarela', 'slug' => 'sumbangan-sukarela', 'jenis' => 'Pemasukan', 'deskripsi' => 'Sumbangan sukarela'],
            ['nama_kategori' => 'Kebersihan', 'slug' => 'kebersihan', 'jenis' => 'Pengeluaran', 'deskripsi' => 'Biaya pengangkutan sampah'],
            ['nama_kategori' => 'Pembangunan', 'slug' => 'pembangunan', 'jenis' => 'Pengeluaran', 'deskripsi' => 'Perbaikan fasilitas umum'],
        ];

        foreach ($categories as $cat) {
            \App\Models\KategoriTransaksi::create($cat);
        }

        // 3. Create Warga and KK
        // Create 5 KK, each with 3-5 Warga
        \App\Models\KartuKeluarga::factory(5)->create()->each(function ($kk) {
            \App\Models\Warga::factory(rand(2, 5))->create([
                'kartu_keluarga_id' => $kk->id,
                'alamat' => $kk->alamat, // Sync address
                'rt' => $kk->rt, // Sync RT
                'rw' => $kk->rw, // Sync RW
            ]);
        });
        
        // Create some loose Warga (e.g. anak kos)
        \App\Models\Warga::factory(10)->create();
    }
}
