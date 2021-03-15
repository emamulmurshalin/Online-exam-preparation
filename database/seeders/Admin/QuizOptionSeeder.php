<?php


namespace Database\Seeders\Admin;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizOptionSeeder extends Seeder
{
    public function run()
    {
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 1,
                'option' => 'বীরবল',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 1,
                'option' => 'ভিমরুল',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 1,
                'option' => 'অনিলাদেবী',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 1,
                'option' => 'যাযাবর',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 2,
                'option' => 'রবীন্দ্রনাথ ঠাকুর',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 2,
                'option' => 'রবীন্দ্রনাথ ঠাকুর',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 2,
                'option' => 'মদনমোহন তর্কালঙ্কার',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 2,
                'option' => 'কৃষ্ণচন্দ্র মজুমদার',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 3,
                'option' => 'স্বরবৃও',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 3,
                'option' => 'অক্ষরবৃও',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 3,
                'option' => 'মন্দাক্রান্তা',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 3,
                'option' => 'মাএাবৃও',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 4,
                'option' => 'সংঙ্কৃত',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 4,
                'option' => 'বাংলা',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 4,
                'option' => 'বিদেশী',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 4,
                'option' => 'মিশ্র',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 5,
                'option' => 'প্রাদিসমাস',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 5,
                'option' => 'ব্যাতিহার বহূব্রীহি সমাস',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 5,
                'option' => 'তৎপুরুষ সমাস',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 5,
                'option' => 'কর্মধারয় সমাস',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 6,
                'option' => 'Uprightness',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 6,
                'option' => 'Justice',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 6,
                'option' => 'Integrity',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 6,
                'option' => 'Bias',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 7,
                'option' => 'to concentrate',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 7,
                'option' => 'to suspect',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 7,
                'option' => 'to read carefully',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 7,
                'option' => 'to grasp the hidden meaning',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 8,
                'option' => '2',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 8,
                'option' => '4',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 8,
                'option' => '0',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 8,
                'option' => '6',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 9,
                'option' => '০.৩',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 9,
                'option' => '√০.৩',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 9,
                'option' => '১/৩',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 9,
                'option' => '২/৫',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 10,
                'option' => '১\২ দৈর্ঘ্য×উচ্চতা',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 10,
                'option' => 'দৈর্ঘ্য ×প্রস্থ',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 10,
                'option' => '২ দৈর্ঘ্য ×প্রস্থ',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 10,
                'option' => 'ভূমি×উচ্চতা',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 11,
                'option' => '১',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 11,
                'option' => '১/২',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 11,
                'option' => '১/৬',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 11,
                'option' => '১/৩',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 12,
                'option' => '(-1/3, 1/3)',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 12,
                'option' => '(1,-1)',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 12,
                'option' => '(-3,3)',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 12,
                'option' => '(-1,1)',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 13,
                'option' => 'Poor',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 13,
                'option' => 'Foolish',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 13,
                'option' => 'Insane',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 13,
                'option' => 'Strained',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 14,
                'option' => 'have',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 14,
                'option' => 'had',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 14,
                'option' => 'might',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 14,
                'option' => 'would',
            ]
        );

        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 15,
                'option' => 'It is further from here.',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 15,
                'option' => 'It is still further from here.',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 15,
                'option' => 'What you say is far from the truth',
            ]
        );
        DB::table('quiz_options')->insert(
            [
                'quiz_id' => 15,
                'option' => 'It is far from here',
            ]
        );
    }
}
