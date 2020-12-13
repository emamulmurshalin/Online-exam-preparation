<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_comments', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('contact_info_id')->unsigned();
            $table->longText("comment");
            $table->timestamps();
            $table->foreign('contact_info_id')->references('id')->on('contact_infos')
                ->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_comments');
    }
}
