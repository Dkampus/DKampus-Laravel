<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\menu>
 */
class menuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_umkm' => mt_rand(1,5),
            'nama_makanan' => $this->faker->words(2, true),
            'deskripsi' => $this->faker->paragraphs(3, true),
            'harga' => mt_rand(3, 20). "000",
            'rating' => mt_rand(2, 10)
        ];
    }
}
