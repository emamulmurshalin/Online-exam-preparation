<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('countries')->insert(
            [
                'name' => 'Bangladesh',
            ],
            [
                'name' => 'Saudi Arabia',
            ]
        );
    }
}