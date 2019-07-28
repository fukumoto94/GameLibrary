<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('money_type_id')->nullable();
            $table->unsignedInteger('accout_balance');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('money_type_id')->references('id')->on('money_types');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('money');
    }
}
