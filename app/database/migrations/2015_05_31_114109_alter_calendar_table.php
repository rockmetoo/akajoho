<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCalendarTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$conn			 = Schema::getConnection('akazoho');
    	$dbSchemaManager = $conn->getDoctrineSchemaManager();
    	$doctrineTable	 = $dbSchemaManager->listTableDetails('calendar');
    	
    	if (!$doctrineTable->hasColumn('isYearlyEvent')) {
    		DB::select(DB::raw("ALTER TABLE `calendar` ADD `isYearlyEvent` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER `notifyEmail`"));
    	}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
