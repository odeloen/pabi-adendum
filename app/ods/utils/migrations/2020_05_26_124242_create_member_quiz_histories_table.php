<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberQuizHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('member_quiz_histories', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('accepted_course_id');
            $table->string('accepted_quiz_id');
            $table->integer('user_id');
            $table->integer('score')->default(0);
            $table->integer('verdict')->default(0);
            $table->string('answers');
            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable();
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
        Schema::dropIfExists('member_quiz_histories');
    }
}
