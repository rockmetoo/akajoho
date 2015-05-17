<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnsTable extends Migration {

/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
    	if (!Schema::hasTable('snsAuthentication')) {
	        Schema::create('snsAuthentication', function($t) {
	            $t->bigInteger('userId')->unsigned()->default(0);
	            $t->string('facebook', 255)->default(null)->nullable();
	            $t->string('twitter', 255)->default(null)->nullable();
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
        Schema::drop('snsAuthentication');
    }

}
