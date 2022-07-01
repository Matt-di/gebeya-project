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
        Admin::create([
            'id' => UuidV3::uuid4(), 
            'email' => 'admin@admin.com',
            'username' => 'admin@admin.com',
            'password'=> Hash::make('password'),
            'admin_type' => 'super'
    
        ]);
        User::create([
            'id' => UuidV3::uuid4(), 
            'email' => 'customer@admin.com',
            'username' => 'customer@admin.com',
            'password'=> Hash::make('password'),
            'user_type' => 'client'
        ]);
        User::create([
            'id' => UuidV3::uuid4(), 
            'email' => ',merchant@admin.com',
            'username' => 'merchant@admin.com',
            'password'=> Hash::make('password'),
            'user_type' => 'merchant'
        ]);
    }
}
