<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedingTable extends Migration {

/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
    	if (!Schema::hasTable('feeding')) {
	        Schema::create('feeding', function($t) {
	            $t->bigInteger('userId')->unsigned()->default(0);
	            $t->smallInteger('diet')->unsigned()->default(1)->comment('insert from feeding.diets');
	            $t->integer('quantity')->unsigned()->default(0)->comment('ml or gm etc.');
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
        Schema::drop('feeding');
    }

}
