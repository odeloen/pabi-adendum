<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcceptedMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('accepted_materials', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('accepted_topic_id', 36);
            $table->string('original_material_id', 36);
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type');            
            $table->string('video_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->text('post_content')->nullable();
            $table->boolean('public');
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
        Schema::connection('odssql')->dropIfExists('accepted_materials');
    }
}
