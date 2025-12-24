<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->numerify('3273###########'),
            'nama_lengkap' => $this->faker->name(),
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat' => $this->faker->streetAddress(),
            'rt' => $this->faker->numberBetween(2, 5),
            'rw' => '10',
            'desa_kelurahan' => 'Cigereleng',
            'kecamatan' => 'Regol',
            'kabupaten_kota' => 'Bandung',
            'provinsi' => 'Jawa Barat',
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
            'pekerjaan' => $this->faker->jobTitle(),
            'status_perkawinan' => $this->faker->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
            'status_warga' => 'Tetap',
            'golongan_darah' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'kewarganegaraan' => 'WNI',
            'pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2']),
            'status_hubungan_dalam_keluarga' => $this->faker->randomElement(['Kepala Keluarga', 'Istri', 'Anak']),
            'nama_ayah' => $this->faker->name('male'),
            'nama_ibu' => $this->faker->name('female'),
            // 'kartu_keluarga_id' will be assigned in seeder or factory callbacks if needed
        ];
    }
}
