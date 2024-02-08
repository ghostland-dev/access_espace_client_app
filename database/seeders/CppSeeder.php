<?php

namespace Database\Seeders;

use App\Models\Cpp;
use Illuminate\Database\Seeder;

class CppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cpp::factory()
            ->count(5)
            ->create();
    }
}
