<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('confirmations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('confirmable_type');
            $table->integer('confirmable_id');
            $table->string('comment')->nullable();
            $table->integer('status');
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
        Schema::connection('odssql')->dropIfExists('confirmations');
    }
}
