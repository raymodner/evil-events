<?php

use Illuminate\Database\Migrations\Migration;

class EventTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function($table){
			/** @var \Illuminate\Database\Schema\Blueprint $table */
			$table->increments('id');
			$table->dateTime('start');
			$table->dateTime('end');
			$table->string('title');
			$table->text('subtitle')->nullable();
			$table->text('info');
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