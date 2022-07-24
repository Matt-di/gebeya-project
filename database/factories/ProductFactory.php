<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Rfc4122\UuidV3;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=>UuidV3::uuid4(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(50),
            
        ];
    }
}
