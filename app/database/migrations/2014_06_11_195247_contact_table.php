<?php

use Illuminate\Database\Migrations\Migration;

class ContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function($table){
			/** @var \Illuminate\Database\Schema\Blueprint $table */
			$table->increments('id');
			$table->string('email');
			$table->text('message');
			$table->integer('event_id')->nullable();
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