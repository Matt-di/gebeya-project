<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'id' => $this->faker->uuid(),
                'user_id'=>User::all()->random()->id,
                'name' => $this->faker->name(),
                'show_nav' => $this->faker->boolean(),
                'description'=>$this->faker->text(50)           
        ];
    }
}
