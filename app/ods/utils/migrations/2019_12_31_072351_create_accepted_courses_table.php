<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceptedCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('accepted_courses', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->bigInteger('lecturer_id');
            $table->string('original_course_id', 36);
            $table->string('name');
            $table->text('description');            
            $table->string('image_path')->nullable();            
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
        Schema::connection('odssql')->dropIfExists('accepted_courses');
    }
}
