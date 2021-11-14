<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('parent_id')->nullable();
			$table->unsignedInteger('photo_id')->nullable();
			$table->foreign('photo_id')->references('id')->on('photos');
            $table->string('name');
            $table->string('description');
            $table->string('slug');
            $table->tinyInteger('selected');
            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
