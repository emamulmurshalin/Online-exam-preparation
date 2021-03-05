<?php

namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('question_types')->insert(
            [
                'type' => 'BCS',
            ]
        );
        DB::table('question_types')->insert(
            [
                'type' => 'Govt teacher',
            ]
        );
    }
}
