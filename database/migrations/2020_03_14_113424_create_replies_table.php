<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('body');

            $table->bigInteger('question_id')->unsigned();
            $table->bigInteger('user_id');

            //$table->dropForeign('replies_question_id_foreign');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

            // $table->dropForeign('answers_user_id_foreign');
            // $table->foreign('user_id')
            // ->references('id')->on('users')
            // ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
