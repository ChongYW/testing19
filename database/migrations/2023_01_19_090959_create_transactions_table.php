<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->double('amount');
            $table->string('description')->nullable();
            $table->string('transaction_type');
            $table->unsignedBigInteger('from_wallet_id');
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_wallet_id');
            $table->unsignedBigInteger('to_user_id');
            $table->timestamps();

            $table->index('from_wallet_id');
            $table->index('from_user_id');
            $table->index('to_wallet_id');
            $table->index('to_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
