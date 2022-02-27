<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Repport;
class RepportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Repport::factory(10)->create();
    }
}
