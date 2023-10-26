<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        User::create([
            'nama_user' => 'Ujang Bengkel',
            'email' => 'ujangbutuhuang@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'), // password
            'role' => 'admin',
            'no_telp' => '827-986-5852'
        ]);

        User::create([
            'nama_user' => 'Arif Kecap',
            'email' => 'knalpotbaja@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345'), // password
            'role' => 'kurir',
            'no_telp' => '827-986-5852'
        ]);


    }
}
