<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightTable extends Migration {

/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
    	if (!Schema::hasTable('weight')) {
	        Schema::create('weight', function($t) {
	            $t->bigInteger('userId')->unsigned()->default(0);
	            $t->integer('weight')->unsigned()->default(0)->comment('kg or gm or pound etc.');
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
        Schema::drop('weight');
    }

}
