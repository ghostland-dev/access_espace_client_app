<?php

namespace Database\Seeders;

use App\Models\Historique;
use Illuminate\Database\Seeder;

class HistoriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Historique::factory()
            ->count(5)
            ->create();
    }
}
