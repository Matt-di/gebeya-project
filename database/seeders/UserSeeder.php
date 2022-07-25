<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Database\Factories\ProductFactory;
use Database\Factories\CategoryFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(3)->create();
    }
}
