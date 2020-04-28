<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmittedTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('submitted_topics', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('submitted_course_id', 36);
            $table->string('original_topic_id', 36);
            $table->string('name');
            $table->text('description');
            $table->integer('modifier')->nullable();
            $table->text('comment')->nullable();
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
        Schema::connection('odssql')->dropIfExists('submitted_topics');
    }
}
