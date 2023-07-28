<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "nama" => "Ahmad Mujamil",
            "nip" => "201003206",
            "role" => "admin",
            "password" => bcrypt('1q2w3e4r5t'),
            "username" => "admin"
        ]);
    }
}
