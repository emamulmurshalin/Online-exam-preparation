<?php

namespace Database\Seeders;

use App\Models\Exam\Admin\Country;
use Database\Seeders\Admin\CountryTableSeeder;
use Database\Seeders\Admin\QuestionTypeSeeder;
use Database\Seeders\Admin\QuestionYearSeeder;
use Database\Seeders\Admin\StatusTableSeeder;
use Database\Seeders\Admin\SubjectTableSeeder;
use Database\Seeders\Admin\UserTableSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Model::unguard();
        $this->call(SubjectTableSeeder::class);
        $this->call(QuestionYearSeeder::class);
        $this->call(QuestionTypeSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
