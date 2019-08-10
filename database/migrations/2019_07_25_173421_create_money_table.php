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
            $table->uuid('user_id')->nullable();
            $table->uuid('money_type_id')->nullable();
            $table->uuid('parent_id')->nullable();
            $table->unsignedInteger('account_balance')->nullable()->default(0);
            $table->timestamps();

            $table->primary('id');
            $table->foreign('money_type_id')->references('id')->on('money_types');
            $table->foreign('user_id')->references('id')->on('users');

        });

        Schema::create('money_money_type', function (Blueprint $table) {
            $table->uuid('money_type_id');
            $table->uuid('money_id');

            $table->foreign('money_type_id')->references('id')->on('money_types');
            $table->foreign('money_id')->references('id')->on('money');
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
        Schema::dropIfExists('money_money_type');
    }
}
