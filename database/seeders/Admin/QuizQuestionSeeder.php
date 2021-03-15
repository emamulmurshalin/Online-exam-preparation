<?php


namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizQuestionSeeder extends Seeder
{
    public function run()
    {
        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'নিচের কোনটি শরৎচন্দ্র চট্রোপাধ্যায়ের ছদ্মনাম?',
                'subject_id' => 1,
                'question_types_id' => 1
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'সকালে উঠিয়া আমি মনে মনে বলি,সারাদিন
                আমি যেন ভাল হয়ে চলি-এ চরণদ্ধয়ের লেখক-',
                'subject_id' => 1,
                'question_types_id' => 2
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'রবীন্দ্রনাথের\'সোনার তরী\'কবিতা কোন ছন্দে রচিত ?',
                'subject_id' => 1,
                'question_types_id' => 1
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => '\'অপ\'কী ধরনের উপসর্গ ?',
                'subject_id' => 1,
                'question_types_id' => 2
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => '\'লাঠালাঠি\'- এটি কোন সমাস?',
                'subject_id' => 1,
                'question_types_id' => 2
            ]
        );

        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'In each of the following questions, choose the word
                opposite in meaning to the given word:- Equity',
                'subject_id' => 2,
                'question_types_id' => 1
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'To read between the lines-',
                'subject_id' => 2,
                'question_types_id' => 2
            ]
        );

        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'x+1/x=√3 হলে x^3+1/x^3 এর মান কত?',
                'subject_id' => 3,
                'question_types_id' => 1
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'নিচের কোনটি ক্ষুদ্রতম সংখ্যা ?',
                'subject_id' => 3,
                'question_types_id' => 2
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'কোনটি সামন্তরিকের ক্ষেত্রফল?',
                'subject_id' => 3,
                'question_types_id' => 1
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'একটি ছক্কার গুটি ছুড়ে মারলে জোড় সংখ্যা ওঠার সম্ভাবনা কত?',
                'subject_id' => 3,
                'question_types_id' => 2
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'x + y = 0 এবং 2x – y +3 = 0 সরলরেখা দুটি কোন বিন্দুতে ছেঁদ করে?',
                'subject_id' => 3,
                'question_types_id' => 1
            ]
        );

        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'Synonym of - WRETCHED',
                'subject_id' => 2,
                'question_types_id' => 1
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => 'This could have worked if I ..... been more far-sighted.',
                'subject_id' => 2,
                'question_types_id' => 2
            ]
        );
        DB::table('quizzes')->insert(
            [
                'quiz_question' => ' Identifying correct sentence ',
                'subject_id' => 2,
                'question_types_id' => 1
            ]
        );
    }
}
