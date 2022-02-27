<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->domainWord(),
            "extension" => $this->faker->fileExtension(),
            "path" => "https://cdn-icons-png.flaticon.com/512/616/616554.png",
        ];
    }
}
