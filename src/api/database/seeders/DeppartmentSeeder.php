<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Hash;
class DeppartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => "admin",
            'email' => "appuser@email.com",
            "password" => Hash::make("pass1234"),
            "phones" => ["0625147895","051425698735","074545876932"],
            "lat" => "654534",
            "long" => "654831",
            "role" => "user",
            "logo" => "#####",
            "categories_id" => Category::all()->random()->id
        ]);
    }
}
