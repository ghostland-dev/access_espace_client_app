<?php

namespace Database\Seeders;

use App\Models\Compteurelec;
use Illuminate\Database\Seeder;

class CompteurelecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Compteurelec::factory()
            ->count(5)
            ->create();
    }
}
