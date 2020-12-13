<?php

namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('statuses')->insert(
            [
                'name' => 'status_active',
            ]
        );
    }
}