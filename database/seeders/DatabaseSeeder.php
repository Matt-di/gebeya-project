<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Rfc4122\UuidV3;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'id' => UuidV3::uuid4(), 
            'email' => 'admin@admin.com',
            'password'=> Hash::make('password'),
            'is_admin' => true,
            'role' => '1',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
    
        ]);
        User::create([
            'id' => UuidV3::uuid4(), 
            'email' => 'customer@admin.com',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'password'=> Hash::make('password'),
            'role' => '3'
        ]);
        User::create([
            'id' => UuidV3::uuid4(), 
            'email' => 'merchant@admin.com',
            'firstname' => 'Merchant',
            'lastname' => 'Merchant',
            'password'=> Hash::make('password'),
            'role' => '2'
        ]);
    }
}
