<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_office_id')->unsigned();
            $table->integer('package_id')->unsigned();
            $table->string('uid');
            $table->integer('payment_status')->unsigned();
            $table->string('card_type')->nullable();
            $table->string('trx_id');
            $table->string('amount');
            $table->string('store_amount');
            $table->foreign('local_office_id')->references('id')->on('localoffices')->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
