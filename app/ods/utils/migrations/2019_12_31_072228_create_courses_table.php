<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('courses', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->bigInteger('lecturer_id');
            $table->string('name');
            $table->text('description');
            $table->integer('modifier')->nullable();
            $table->boolean('lock')->default(false);
            $table->string('image_path')->nullable();
            $table->bigInteger('accepted_course_id')->nullable();
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
        Schema::connection('odssql')->dropIfExists('courses');
    }
}
