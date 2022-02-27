<?php

namespace Database\Factories;
use App\Models\Problem;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "lat" => $this->faker->latitude(-90,90),
            "long" => $this->faker->longitude(-180,180),
            "solved" => $this->faker->numberBetween(0,1),
            "problems_id" => Problem::all()->random()->id
        ];
    }
}
