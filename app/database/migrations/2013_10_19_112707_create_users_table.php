<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($t) {
			$t->engine = 'InnoDB';
			
			$t->increments('id');
			$t->string('email', 255);
			$t->string('password', 64);
			$t->text('name');
			$t->string('alias', 255);
			$t->dateTime('created');
			$t->dateTime('updated')->nullable();
			
			$t->softDeletes();
			$t->unique('email');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}