<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KartuKeluarga>
 */
class KartuKeluargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomor_kk' => $this->faker->unique()->numerify('3273###########'), // Typical 16 digit KK
            'kepala_keluarga' => $this->faker->name('male'),
            'alamat' => $this->faker->streetAddress(),
            'rt' => $this->faker->numberBetween(2, 5), // As string or int, schema is string
            'rw' => '10', // Fixed for this app context
            'desa_kelurahan' => 'Cigereleng',
            'kecamatan' => 'Regol',
            'kabupaten_kota' => 'Bandung',
            'provinsi' => 'Jawa Barat',
            'kode_pos' => $this->faker->postcode(),
        ];
    }
}
