<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('123456'),
            'phone_number' => '1234567890',
            'status' => 'pending',
            'avatar' => '',
            'address' => '123 Main St, Anytown, USA',
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'janesmith@example.com',
            'password' => bcrypt('123456'),
            'phone_number' => '0987654321',
            'status' => 'pending',
            'avatar' => '',
            'address' => '456 Elm St, Othertown, USA',
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Alice Johnson',
            'email' => 'alicejohnson@example.com',
            'password' => bcrypt('123456'),
            'phone_number' => '5551234567',
            'status' => 'pending',
            'avatar' => '',
            'address' => '789 Oak St, Sometown, USA',
            'role_id' => 3
        ]);
    }
}
