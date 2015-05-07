<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersVerifyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::connection('akazohoUsers')->hasTable('usersVerify')) {
			Schema::connection('akazohoUsers')->create('usersVerify', function($t) {
				$t->bigInteger('userId')->unsigned();
				$t->string('email', 255)->unique();
				$t->string('code', 128);
				$t->bigInteger('createdBy')->unsigned()->default(0);
				$t->bigInteger('updatedBy')->unsigned()->default(0);
				$t->dateTime('dateCreated')->default('0000-00-00 00:00:00');
				$t->dateTime('dateUpdated')->default('0000-00-00 00:00:00');
				 
				$t->engine = 'InnoDB';
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('akazohoUsers')->drop('usersVerify');
	}

}
