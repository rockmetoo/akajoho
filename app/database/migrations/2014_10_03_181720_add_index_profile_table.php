<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexProfileTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$conn			 = Schema::getConnection('akazoho');
    	$dbSchemaManager = $conn->getDoctrineSchemaManager();
    	$doctrineTable	 = $dbSchemaManager->listTableDetails('profile');
    	
    	// alter table "users" add constraint users_email_unique unique ("email")
    	if (!$doctrineTable->hasIndex('PRIMARY'))
    	{
    		DB::select(DB::raw("ALTER TABLE profile ADD PRIMARY KEY(`userId`)"));
    	}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	DB::select(DB::raw("ALTER TABLE profile DROP INDEX PRIMARY"));
    }

}
