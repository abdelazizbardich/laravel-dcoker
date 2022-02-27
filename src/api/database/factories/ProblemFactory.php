<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProblemFactory extends Factory
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
            "icon" => "https://cdn-icons-png.flaticon.com/512/616/616554.png"
        ];
    }
}
