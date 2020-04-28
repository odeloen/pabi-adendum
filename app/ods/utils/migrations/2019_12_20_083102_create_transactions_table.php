<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('odssql')->create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('payable_type');
            $table->bigInteger('payable_id');
            $table->bigInteger('account_id')->nullable();
            $table->string('method', 20);
            $table->integer('amount');
            $table->integer('status')->default(0);
            $table->timestamp('verified_date')->nullable();
            $table->text('comment')->nullable();
            $table->text('receipt_path')->nullable();
            $table->date('receipt_date')->nullable();
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
        Schema::connection('odssql')->dropIfExists('transactions');
    }
}
