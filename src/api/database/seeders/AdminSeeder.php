<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
class AdminSeeder extends Seeder
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
            'email' => "appadmin@email.com",
            "password" => Hash::make("pass1234"),
            "phones" => ["0625147895","051425698735","074545876932"],
            "lat" => "654534",
            "long" => "654831",
            "role" => "admin",
            "logo" => "#####",
            "categories_id" => null
        ]);

        \App\Models\User::create([
            'name' => "application",
            'email' => "application@email.com",
            "password" => Hash::make("pass1234"),
            "phones" => [null,null,null],
            "lat" => null,
            "long" => null,
            "role" => "application",
            "logo" => null,
            "categories_id" => null
        ]);
    }
}
