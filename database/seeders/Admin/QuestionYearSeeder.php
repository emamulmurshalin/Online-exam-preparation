<?php

namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionYearSeeder extends Seeder
{
    public function run()
    {
        DB::table('question_years')->insert(
            [
                'year' => '2011',
            ]
        );
        DB::table('question_years')->insert(
            [
                'year' => '2012',
            ]
        );
        DB::table('question_years')->insert(
            [
                'year' => '2013',
            ]
        );
        DB::table('question_years')->insert(
            [
                'year' => '2014',
            ]
        );
        DB::table('question_years')->insert(
            [
                'year' => '2015',
            ]
        );
        DB::table('question_years')->insert(
            [
                'year' => '2016',
            ]
        );
        DB::table('question_years')->insert(
            [
                'year' => '2017',
            ]
        );
        DB::table('question_years')->insert(
            [
                'year' => '2018',
            ]
        );
        DB::table('question_years')->insert(
            [
                'year' => '2019',
            ]
        );
        DB::table('question_years')->insert(
            [
                'year' => '2020',
            ]
        );
    }
}