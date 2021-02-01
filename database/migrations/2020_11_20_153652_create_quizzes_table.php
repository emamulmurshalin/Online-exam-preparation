<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("quiz_question");
            $table->integer('subject_id')->unsigned();
            $table->integer('question_types_id')->unsigned();
            $table->timestamps();
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');
            $table->foreign('question_types_id')
                ->references('id')
                ->on('question_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
