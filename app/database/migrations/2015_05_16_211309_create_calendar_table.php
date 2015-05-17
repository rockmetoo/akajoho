<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTable extends Migration {

/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
    	if (!Schema::hasTable('calendar')) {
	        Schema::create('calendar', function($t) {
	        	$t->bigIncrements('id')->unsigned();
	            $t->bigInteger('userId')->unsigned()->default(0);
	            $t->string('title', 255)->default(null)->nullable();
	            $t->dateTime('start');
	            $t->dateTime('end')->default(null)->nullable();
	            $t->text('eventMemo')->default(null)->nullable();
	            $t->boolean('allDay')->default(0);
	            $t->tinyInteger('whereToNotify')->default(null)->nullable();
	            $t->tinyInteger('whenToNotify')->default(null)->nullable();
	            $t->string('notifyEmail', 255)->default(null)->nullable();
	            $t->bigInteger('createdBy')->unsigned()->default(0);
	            $t->bigInteger('updatedBy')->unsigned()->default(0);
	            $t->dateTime('dateCreated')->default('0000-00-00 00:00:00');
	            $t->dateTime('dateUpdated')->default('0000-00-00 00:00:00');
	            
	            $t->index('userId');
	            
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
        Schema::drop('calendar');
    }

}
