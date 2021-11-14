<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::beginTransaction();

		Schema::create('zones', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users');
			$table->unsignedInteger('state_id')->nullable();
			$table->foreign('state_id')->references('id')->on('states');
			$table->unsignedInteger('city_id')->nullable();
			$table->foreign('city_id')->references('id')->on('cities');
			$table->string('address');
			$table->string('phone')->nullable();
			$table->string('lat')->nullable();
			$table->string('long')->nullable();
			$table->boolean('status')->default(true);
			$table->timestamps();
		});

		Schema::create('visit_card_zone', function (Blueprint $table) {
			$table->unsignedInteger('visit_card_id');
			$table->foreign('visit_card_id')->references('id')->on('visit_cards');
			$table->unsignedInteger('zone_id');
			$table->foreign('zone_id')->references('id')->on('zones');
			$table->primary(['visit_card_id', 'zone_id']);
		});

		DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zones');
    }
}
