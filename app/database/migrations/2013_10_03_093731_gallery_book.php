<?php

use Illuminate\Database\Migrations\Migration;

class GalleryBook extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create('gallery_books', function($table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable()
                ->default(null);
            $table->integer('author_id');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('gallery_books');
	}

}