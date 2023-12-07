<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "Phyu Phwe",
            "email" => "phyuphwe@gmail.com",
            "password" => "asdffdsa",
        ]);
        User::factory(10)->create();
        User::factory()->create([
            "name" => "Aung Sitt Khaing",
            "email" => "ask@gmail.com",
            "password" => "asdffdsa",
            "role" => "admin"
        ]);
    }
}
