<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('photo_id')->nullable();
			$table->string('refer_id')->references('id')->on('users')->nullable();
			$table->string('phone')->unique();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('app_version')->nullable();
			$table->string('password')->nullable();
			$table->rememberToken();
			$table->string('status')->index()->nullable();
			$table->boolean('can_create_vcard')->default(true);
			$table->timestamp('deleted_at')->nullable();
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
		Schema::dropIfExists('users');
	}
}
