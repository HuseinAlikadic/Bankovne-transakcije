<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingKnjizenjesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posting_knjizenjes', function (Blueprint $table) {
            $table->id();
            $table->integer('money_value');
            $table->unsignedBigInteger('id_from_account');
            $table->foreign('id_from_account')->references('id')->on('accounts');
            $table->unsignedBigInteger('id_to_account');
            $table->foreign('id_to_account')->references('id')->on('accounts');
            $table->unsignedBigInteger('financial_institutions_id');
            $table->foreign('financial_institutions_id')->references('id')->on('financial_institutions');
            $table->date('booking_date');
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
        Schema::dropIfExists('posting_knjizenjes');
    }
}