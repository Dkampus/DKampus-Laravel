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
        $users = User::all();
        $indeks = rand(0, count($users) - 1);
        $rand_id = $users[$indeks]->id;
        
        return [
            'id_user' => $rand_id,
            'nama_umkm' => $this->faker->company(),
            'alamat' => $this->faker->address(),
            'no_telp_umkm' => $this->faker->phoneNumber(),
            'vip' => $this->faker->boolean()
        ];
    }
}
