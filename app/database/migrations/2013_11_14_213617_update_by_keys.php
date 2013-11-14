<?php

use Illuminate\Database\Migrations\Migration;

class UpdateByKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('groups', function($t)
		{
			$t->dropForeign('groups_created_by_foreign');
			$t->dropForeign('groups_updated_by_foreign');
			$t->renameColumn('updated_by', 'updated_by_id');
			$t->renameColumn('created_by', 'created_by_id');
			$t->foreign('updated_by_id')->references('id')->on('users');
			$t->foreign('created_by_id')->references('id')->on('users');
		});
		
		Schema::table('vehicles', function($t)
		{
			$t->dropForeign('vehicles_created_by_foreign');
			$t->dropForeign('vehicles_updated_by_foreign');
			$t->renameColumn('updated_by', 'updated_by_id');
			$t->renameColumn('created_by', 'created_by_id');
			$t->foreign('updated_by_id')->references('id')->on('users');
			$t->foreign('created_by_id')->references('id')->on('users');
		});
		
		Schema::table('bookings', function($t)
		{
			$t->dropForeign('bookings_updated_by_foreign');
			$t->renameColumn('updated_by', 'updated_by_id');
			$t->foreign('updated_by_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('groups', function($t)
		{
			$t->dropForeign('groups_created_by_id_foreign');
			$t->dropForeign('groups_updated_by_id_foreign');
			$t->renameColumn('updated_by_id', 'updated_by');
			$t->renameColumn('created_by_id', 'created_by');
			$t->foreign('updated_by')->references('id')->on('users');
			$t->foreign('created_by')->references('id')->on('users');
		});
		
		Schema::table('vehicles', function($t)
		{
			$t->dropForeign('vehicles_created_by_id_foreign');
			$t->dropForeign('vehicles_updated_by_id_foreign');
			$t->renameColumn('updated_by_id', 'updated_by');
			$t->renameColumn('created_by_id', 'created_by');
			$t->foreign('updated_by')->references('id')->on('users');
			$t->foreign('created_by')->references('id')->on('users');
		});
		
		Schema::table('bookings', function($t)
		{
			$t->dropForeign('bookings_updated_by_id_foreign');
			$t->renameColumn('updated_by_id', 'updated_by');
			$t->foreign('updated_by')->references('id')->on('users');
		});
	}

}