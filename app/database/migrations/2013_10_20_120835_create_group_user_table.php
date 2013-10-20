<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups_users', function($t) {
			$t->engine = 'InnoDB';
			
			$t->integer('group_id')->unsigned();
			$t->integer('user_id')->unsigned();
			$t->boolean('admin')->default(false);
			
			$t->primary(array('group_id', 'user_id'));
			$t->foreign('group_id')->references('id')->on('groups');
			$t->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups_users');
	}

}