<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Problem;
class ProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Problem::factory(10)->create();
    }
}
