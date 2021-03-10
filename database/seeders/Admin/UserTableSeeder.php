<?php
namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert(
            [
                'first_name' => 'Joune',
                'last_name' => 'Doe',
                'email' => 'admin@demo.com',
                'role' => 'Admin',
                'status_id' => 1,
                'photo' => 'default.png',
                'verification_code' => '123456',
                'verified' => 1,
                'password' => Hash::make('123456'),
                'created_at' => now(),
            ]
        );
        DB::table('users')->insert(
            [
                'first_name' => 'General',
                'last_name' => 'User',
                'email' => 'general@demo.com',
                'role' => 'User',
                'status_id' => 2,
                'photo' => 'default.png',
                'verification_code' => '654321',
                'verified' => 1,
                'password' => Hash::make('123456'),
                'created_at' => now(),
            ]
        );

    }
}
