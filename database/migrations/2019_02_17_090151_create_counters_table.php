<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('user_id')->nullable()->index();
			$table->foreign('user_id')->references('id')->on('users');
			$table->unsignedInteger('visit_card_id')->nullable()->index();
			$table->foreign('visit_card_id')->references('id')->on('visit_cards');
			$table->integer('view_count')->nullable();
			$table->integer('rate_count')->nullable();
			$table->integer('report_count')->nullable();
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
        Schema::dropIfExists('counters');
    }
}
