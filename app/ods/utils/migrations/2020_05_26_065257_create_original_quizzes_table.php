<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOriginalQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('original_quizzes', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('original_course_id');
            $table->string('accepted_quiz_id')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('threshold')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('original_quizzes');
    }
}
