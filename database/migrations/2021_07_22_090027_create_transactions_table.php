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
            $table->integer('userId');
            $table->integer('type');
            $table->integer('payment');
            $table->double('gram');
            $table->integer('priceId');
            $table->integer('adminFee');
            $table->integer('nominal');
            $table->boolean('status');
            $table->integer('discount');
            $table->string('barcode');
            $table->string('destinationNumber')->nullable();
            $table->string('message')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
