<?php

namespace Database\Seeders;

use App\Models\Cahiercharge;
use Illuminate\Database\Seeder;

class CahierchargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cahiercharge::factory()
            ->count(5)
            ->create();
    }
}
