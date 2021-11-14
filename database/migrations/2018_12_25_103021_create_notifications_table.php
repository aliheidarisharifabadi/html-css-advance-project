<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::beginTransaction();

        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('type');
			$table->integer('click_count')->default(0)->nullable();
			$table->integer('deliver_count')->default(0)->nullable();
			$table->boolean('status')->default(false);
            $table->timestamps();
        });

		Schema::create('notif_items', function (Blueprint $table) {
			$table->increments('id');
			$table->string('type');
			$table->string('key');
			$table->boolean('status')->default(true);
			$table->timestamp('created_at')->nullable();
		});

		Schema::create('notification_item', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('notification_id')->nullable();
			$table->foreign('notification_id')->references('id')->on('notifications');
			$table->unsignedInteger('item_id')->nullable();
			$table->foreign('item_id')->references('id')->on('notif_items');
			$table->string('value');
			$table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('notification_item');
        Schema::dropIfExists('notif_items');
        Schema::dropIfExists('notifications');
    }
}
