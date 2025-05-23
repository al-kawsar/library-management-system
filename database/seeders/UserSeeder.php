<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(100)->create();

        User::create([
            'name' => "Andi Muh. Raihan Alkawsar",
            'email' => "alkawsar@lks.com",
            'password' => bcrypt('123123123'),
            'role' => 'admin',
        ]);

    }
}
