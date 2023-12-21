<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Data_umkm>
 */
class Data_umkmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $logo = ['bagdhag.jpg', 'tehpoci.jpg', 'warmingUp.svg'];
        $indeks = rand(0, count($logo) - 1);
        $rand_logo = $logo[$indeks];
        
        return [
            'nama_umkm' => $this->faker->company(),
            'logo_umkm' => $rand_logo,
            // 'slug' => $this->faker->slug,
            'alamat' => $this->faker->address(),
            'no_telp_umkm' => $this->faker->phoneNumber(),
            'vip' => strval(mt_rand(0, 1))
        ];
    }
}
