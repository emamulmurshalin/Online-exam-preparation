<?php

namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('subjects')->insert(
            [
                'name' => 'Bengali',
            ]
        );
        DB::table('subjects')->insert(
            [
                'name' => 'English',
            ]
        );
        DB::table('subjects')->insert(
            [
                'name' => 'Math',
            ]
        );
    }
}