<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'password' => 'password',
            'role_id' => 3,
            'phone' => '1234567890',
            'email' => 'User@test.com',
        ]);
        User::factory()->create([
            'name' => 'Test Merchant',
            'password' => 'password',
            'role_id' => 2,
            'phone' => '0987654321',
            'email' => 'Merchant@test.com',
        ]);
        User::factory()->create([
            'name' => 'Test Admin',
            'password' => 'password',
            'role_id' => 1,
            'phone' => '1112223333',
            'email' => 'Admin@test.com',
        ]);
        user::factory()->count(3)->create();
    }
}
