<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codes', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('type');
			$table->string('phone')->index();
			$table->string('code');
			$table->boolean('status')->default(true);
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
		Schema::dropIfExists('sms');
	}
}
