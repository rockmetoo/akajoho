<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailSubscribeTable extends Migration {

/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
    	if (!Schema::hasTable('emailsubscribe')) {
	        Schema::create('emailsubscribe', function($t) {
	            $t->bigIncrements('id')->unsigned();
	            $t->string('email', 255)->unique();
	            $t->smallInteger('messageMagazineId')->unsigned()->default(null)->nullable()->comment('get messageMagazine table id');
	            $t->tinyInteger('isSent')->unsigned()->default(0)->comment('0->not sent, 1->sent');
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
        Schema::drop('emailsubscribe');
    }

}
