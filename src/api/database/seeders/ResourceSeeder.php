<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resource;
class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Resource::factory(10)->create();
    }
}
