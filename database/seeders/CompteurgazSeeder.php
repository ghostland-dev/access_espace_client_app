<?php

namespace Database\Seeders;

use App\Models\Compteurgaz;
use Illuminate\Database\Seeder;

class CompteurgazSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Compteurgaz::factory()
            ->count(5)
            ->create();
    }
}
