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
            $table->integer('gram');
            $table->integer('prevSaldo');
            $table->integer('currentSaldo');
            $table->integer('biayaAdmin');
            $table->integer('price');
            $table->integer('total');
            $table->integer('discount')->nullable();
            $table->string('destinationNumber')->nullable();
            $table->string('message')->nullable();
            $table->timestamps();
        });
    }

    //  'userId',
    //     'type',
    //     'price',
    //     'total',
    //     'destinationNumber',
    //     'message'

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
