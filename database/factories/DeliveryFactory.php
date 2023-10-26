<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
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
            'id_orderDetail' => mt_rand(1, 5)
        ];
    }
}
