<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmittedCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('submitted_courses', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->bigInteger('lecturer_id');
            $table->string('original_course_id', 36);
            $table->string('unique_code',10)->unique();
            $table->text('summary');
            $table->string('name');
            $table->text('description');
            $table->integer('status')->default(0);
            $table->string('image_path')->nullable();
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
        Schema::connection('odssql')->dropIfExists('submitted_courses');
    }
}
