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
                'first_name' => 'Admin',
                'last_name' => 'Demo',
                'email' => 'admin@demo.com',
                'role_id' => 1,
                'status_id' => 2,
                'photo' => 'default.png',
                'password' => Hash::make('12345678'),
            ]
        );
        DB::table('users')->insert(
            [
                'first_name' => 'Admin',
                'last_name' => 'Demo',
                'email' => 'admin6@demo.com',
                'role_id' => 2,
                'status_id' => 2,
                'photo' => 'default.png',
                'password' => Hash::make('12345678'),
            ]
        );
        DB::table('users')->insert(
            [
                'first_name' => 'Admin',
                'last_name' => 'Demo',
                'email' => 'admin5@demo.com',
                'role_id' => 2,
                'status_id' => 2,
                'photo' => 'default.png',
                'password' => Hash::make('12345678'),
            ]
        );
        DB::table('users')->insert(
            [
                'first_name' => 'Admin',
                'last_name' => 'Demo',
                'email' => 'admin4@demo.com',
                'role_id' => 2,
                'status_id' => 2,
                'photo' => 'default.png',
                'password' => Hash::make('12345678'),
            ]
        );
        DB::table('users')->insert(
            [
                'first_name' => 'Admin',
                'last_name' => 'Demo',
                'email' => 'admin3@demo.com',
                'role_id' => 2,
                'status_id' => 2,
                'photo' => 'default.png',
                'password' => Hash::make('12345678'),
            ]
        );
        DB::table('users')->insert(
            [
                'first_name' => 'Admin',
                'last_name' => 'Demo',
                'email' => 'admin2@demo.com',
                'role_id' => 2,
                'status_id' => 2,
                'photo' => 'default.png',
                'password' => Hash::make('12345678'),
            ]
        );
        DB::table('users')->insert(
            [
                'first_name' => 'Admin',
                'last_name' => 'Demo',
                'email' => 'admin1@demo.com',
                'role_id' => 2,
                'status_id' => 2,
                'photo' => 'default.png',
                'password' => Hash::make('12345678'),
            ]
        );

    }
}