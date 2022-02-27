<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeppartmentHasProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\DeppartmentHasProblem::factory(10)->create();
    }
}
