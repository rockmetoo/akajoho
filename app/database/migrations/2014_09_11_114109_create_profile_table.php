<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration {

/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
    	if (!Schema::hasTable('profile')) {
	        Schema::create('profile', function($t) {
	            $t->bigInteger('userId')->unsigned()->default(0);
	            $t->string('firstName', 128)->default(null)->nullable();
	            $t->string('lastName', 128)->default(null)->nullable();
	            $t->smallInteger('gender')->unsigned()->default(1)->comment('1->female, 2->male, 3->others');
	            $t->integer('dob')->unsigned()->nullable();
	            $t->string('postcode', 12)->default(null)->nullable();
	            $t->string('address', 128)->default(null)->nullable();
	            $t->string('pTmp', 32)->default(null)->nullable();
	            $t->string('p0', 64)->default(null)->nullable();
	            $t->string('p1', 64)->default(null)->nullable();
	            $t->string('p2', 64)->default(null)->nullable();
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
        Schema::drop('profile');
    }

}
