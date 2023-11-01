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
        $menu_makanan = ['friedChicken.jpeg', 'ayamGoyeng.jpg', 'geprek.jpg', 'goyengAyam.jpeg', 'pahaAyam.jpeg', 'pahaAyam.jpg', 'spagetti.jpg'];
        $indeks = rand(0, count($menu_makanan) - 1);
        $rand_image = $menu_makanan[$indeks];

        return [
            'data_umkm_id' => mt_rand(1,3),
            'nama_makanan' => $this->faker->words(2, true),
            'slug' => $this->faker->slug,
            'deskripsi' => $this->faker->paragraphs(3, true),
            'image' => $rand_image,
            'harga' => mt_rand(3, 20). "000",
            'rating' => mt_rand(2, 10)
        ];
    }
}
