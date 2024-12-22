<?php

namespace Database\Seeders;

use App\Models\Loans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Loans::factory()->count(100)->create();
    }
}
