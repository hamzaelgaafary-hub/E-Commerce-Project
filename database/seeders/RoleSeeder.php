<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Role::create([ 'id' => 1,'name' => 'admin']);
        Role::create([ 'id' => 2,'name' => 'merchant']);
        Role::create([ 'id' => 3, 'name' => 'user']);
    }
}
