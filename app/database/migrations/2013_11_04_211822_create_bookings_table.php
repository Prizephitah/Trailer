<?php

use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookings', function($t) {
			$t->engine = 'InnoDB';
			
			$t->increments('id');
			$t->integer('vehicle_id')->unsigned();
			$t->integer('user_id')->unsigned();
			$t->dateTime('start');
			$t->dateTime('end');
			$t->text('comment')->nullable();
			$t->dateTime('updated')->nullable();
			$t->integer('updated_by')->nullable()->unsigned();
			
			$t->softDeletes();
			$t->index('vehicle_id');
			$t->index('user_id');
			$t->index(array('start', 'end'));
			$t->foreign('vehicle_id')->references('id')->on('vehicles');
			$t->foreign('user_id')->references('id')->on('users');
			$t->foreign('updated_by')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookings');
	}

}