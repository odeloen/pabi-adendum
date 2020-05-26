<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceptedQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('accepted_quizzes', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('accepted_course_id');
            $table->string('original_quiz_id');
            $table->integer('duration');
            $table->integer('threshold');
            $table->string('correct_answers');
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
        Schema::dropIfExists('accepted_quizzes');
    }
}
