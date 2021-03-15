<?php


namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizAnswerSeeder extends Seeder
{
    public function run()
    {
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 1,
                'answer' => 'অনিলাদেবী',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 2,
                'answer' => 'মদনমোহন তর্কালঙ্কার',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 3,
                'answer' => ' মাএাবৃও',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 4,
                'answer' => 'সংঙ্কৃত',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 5,
                'answer' => 'ব্যাতিহার বহূব্রীহি সমাস',
            ]
        );

        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 6,
                'answer' => 'Bias',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 7,
                'answer' => 'to grasp the hidden meaning',
            ]
        );

        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 8,
                'answer' => '0',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 9,
                'answer' => '০.৩',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 10,
                'answer' => 'ভূমি×উচ্চতা',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 11,
                'answer' => '১/২',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 12,
                'answer' => '(-1,1)',
            ]
        );

        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 13,
                'answer' => 'Poor',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 14,
                'answer' => 'had',
            ]
        );
        DB::table('quiz_answers')->insert(
            [
                'quiz_id' => 15,
                'answer' => 'It is far from here',
            ]
        );
    }
}
