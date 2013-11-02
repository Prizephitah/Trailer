<?php

use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vehicles', function($t) {
			$t->engine = 'InnoDB';
			
			$t->increments('id');
			$t->integer('group_id')->unsigned();
			$t->string('license_plate', 255);
			$t->string('name', 255);
			$t->text('description');
			$t->date('model_year')->nullable();
			$t->integer('curb_weight');
			$t->integer('gross_weight');
			$t->integer('length');
			$t->integer('width');
			$t->integer('created_by')->unsigned();
			$t->dateTime('created');
			$t->integer('updated_by')->nullable()->unsigned();
			$t->dateTime('updated')->nullable();
			
			$t->softDeletes();
			$t->index('created_by');
			$t->foreign('group_id')->references('id')->on('groups');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vehicles');
	}

}