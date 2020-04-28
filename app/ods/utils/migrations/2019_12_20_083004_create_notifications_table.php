<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('notifiable_type');
            $table->integer('notifiable_id');
            $table->string('title');
            $table->text('content');
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
        Schema::connection('odssql')->dropIfExists('notifications');
    }
}
