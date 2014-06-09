<?php

use Illuminate\Database\Migrations\Migration;

class GalleryItem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('gallery_items', function($table){
            $table->increments('id');
            $table->integer('gallery_book_id');
            $table->string('name');
            $table->string('originalname');
            $table->integer('type')->default(1);
            $table->text('description')->nullable()
                    ->default(null);
            $table->integer('author_id');
            $table->string('mimetype');
            $table->string('ext');
            $table->integer('filesize');
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
		//
	}

}