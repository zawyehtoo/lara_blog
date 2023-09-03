<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::factory()->create([
            "name"=>"scott",
            "email"=>"scott@gmail.com",
            "password"=>Hash::make("asdfasdf"),
            "role"=>"admin"
        ]);
    }
}
