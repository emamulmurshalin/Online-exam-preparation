<?php


namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('post_catergories')->insert(
            [
                'name' => 'BCS',
            ]
        );
        DB::table('post_catergories')->insert(
            [
                'name' => 'Exam preperation',
            ]
        );
        DB::table('post_catergories')->insert(
            [
                'name' => 'Viva',
            ]
        );
    }
}
