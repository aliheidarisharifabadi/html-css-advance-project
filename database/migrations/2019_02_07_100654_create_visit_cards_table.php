<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitCardsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::beginTransaction();

		Schema::create('visit_cards', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->unsignedInteger('photo_id')->nullable();
			$table->foreign('photo_id')->references('id')->on('photos');
			$table->unsignedInteger('resume_id')->nullable();
			$table->string('title');
			$table->string('specialty')->nullable();
			$table->text('description')->nullable();
			$table->integer('view_count')->default(0);
			$table->boolean('status')->default(true);
			$table->timestamp('deleted_at')->nullable();
			$table->timestamps();
		});

		Schema::create('visit_card_social', function (Blueprint $table) {
			$table->integer('visit_card_id')->unsigned();
			$table->integer('social_id')->unsigned();
			$table->foreign('visit_card_id')->references('id')->on('visit_cards')->onDelete('cascade');
			$table->foreign('social_id')->references('id')->on('socials')->onDelete('cascade');
			$table->primary(['visit_card_id', 'social_id']);
		});

		Schema::create('visit_card_categories', function (Blueprint $table) {
			$table->unsignedInteger('category_id');
			$table->foreign('category_id')->references('id')->on('categories');
			$table->unsignedInteger('visit_card_id');
			$table->foreign('visit_card_id')->references('id')->on('visit_cards');
			$table->primary(['visit_card_id', 'category_id']);
		});

		Schema::create('visit_card_user', function (Blueprint $table) {
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->unsignedInteger('visit_card_id');
			$table->foreign('visit_card_id')->references('id')->on('visit_cards');
			$table->primary(['visit_card_id', 'user_id']);
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
		Schema::dropIfExists('visit_card_categories');
		Schema::dropIfExists('visit_card_social');
		Schema::dropIfExists('visit_cards');
	}
}
