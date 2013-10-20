<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function($t) {
			$t->engine = 'InnoDB';
			
			$t->increments('id');
			$t->string('name', 255);
			$t->text('description');
			$t->integer('created_by')->unsigned();
			$t->dateTime('created');
			$t->integer('updated_by')->nullable()->unsigned();
			$t->dateTime('updated')->nullable();
			
			$t->softDeletes();
			$t->unique('name');
			$t->index('created_by');
			$t->foreign('created_by')->references('id')->on('users');
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
		Schema::drop('groups');
	}

}