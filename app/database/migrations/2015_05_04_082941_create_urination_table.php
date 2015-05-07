<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrinationTable extends Migration {

/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
    	if (!Schema::hasTable('urination')) {
	        Schema::create('urination', function($t) {
	            $t->bigInteger('userId')->unsigned()->default(0);
	            $t->smallInteger('color')->unsigned()->default(1)->comment('insert from urination.colors');
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
        Schema::drop('urination');
    }

}
