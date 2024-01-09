<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Data_umkm;
use App\Models\Delivery;
use App\Models\Menu;
use App\Models\orderDetail;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Data_umkm::factory(3)->create();
        Menu::factory(20)->create();
        Cart::factory(7)->create();
        Payment::factory(5)->create();
        orderDetail::factory(5)->create();
        Delivery::factory(5)->create();

        Data_umkm::find(1)->update([
            'nama_umkm' => 'Ayam Goreng Baghdad',
            'logo_umkm' => 'bagdhag.jpg'
        ]);
        Data_umkm::find(2)->update([
            'nama_umkm' => 'Warming Up - KoLab',
            'logo_umkm' => 'warmingUp.svg'
        ]);
        Data_umkm::find(3)->update([
            'nama_umkm' => 'Es Teh Poci',
            'logo_umkm' => 'tehpoci.jpg'
        ]);

    }
}
