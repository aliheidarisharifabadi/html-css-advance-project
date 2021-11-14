<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users');
			$table->unsignedInteger('visit_card_id')->nullable();
			$table->foreign('visit_card_id')->references('id')->on('visit_cards');
			$table->string('reason');
			$table->tinyInteger('anger');
			$table->boolean('status')->default(false);
			$table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
