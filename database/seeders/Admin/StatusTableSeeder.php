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
                'name' => 'Active',
            ]
        );
        DB::table('statuses')->insert(
            [
                'name' => 'InActive',
            ]
        );
        DB::table('statuses')->insert(
            [
                'name' => 'Invited',
            ]
        );
        DB::table('statuses')->insert(
            [
                'name' => 'Published',
            ]
        );
        DB::table('statuses')->insert(
            [
                'name' => 'Draft',
            ]
        );
        DB::table('statuses')->insert(
            [
                'name' => 'Read',
            ]
        );
        DB::table('statuses')->insert(
            [
                'name' => 'Unread',
            ]
        );
    }
}
