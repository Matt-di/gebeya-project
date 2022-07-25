<?php

namespace Database\Factories;

use App\Models\User;
use Ramsey\Uuid\Rfc4122\UuidV3;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id'=>User::all()->random()->id,
            'name' => $this->faker->name(),
            'description' => $this->faker->realText(50),
            'image'=>'https://via.placeholder.com/350x150',
            'quantity'=>$this->faker->numberBetween(5,50),
            'price'=>$this->faker->numberBetween(50,3000),
            'tags'=>$this->faker->text(50)
        ];
    }
}
