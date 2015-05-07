<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoopTable extends Migration {

/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
    	if (!Schema::hasTable('poop')) {
	        Schema::create('poop', function($t) {
	            $t->bigInteger('userId')->unsigned()->default(0);
	            $t->smallInteger('color')->unsigned()->default(1)->comment('insert from poop.colors');
	            $t->smallInteger('type')->unsigned()->default(1)->comment('insert from poop.types');
	            $t->integer('when')->unsigned()->nullable();
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
        Schema::drop('poop');
    }

}
