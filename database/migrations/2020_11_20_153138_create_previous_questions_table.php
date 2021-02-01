<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreviousQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("question_title");
            $table->string("question_file_path");
            $table->integer('question_years_id')->unsigned();
            $table->integer('question_types_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->timestamps();
            $table->foreign('question_years_id')
                ->references('id')
                ->on('question_years');
            $table->foreign('question_types_id')
                ->references('id')
                ->on('question_types');
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('previous_questions');
    }
}
