<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('broj_racuna');
            $table->unsignedBigInteger('custumer_id');
            $table->foreign('custumer_id')->references('id')->on('customers');
            $table->integer('bilans_racuna');
            $table->unsignedBigInteger('financial_institution_id');
            $table->foreign('financial_institution_id')->references('id')->on('financial_institutions');
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
        Schema::dropIfExists('accounts');
    }
}