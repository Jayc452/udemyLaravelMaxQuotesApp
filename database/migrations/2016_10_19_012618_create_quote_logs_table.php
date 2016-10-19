<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	//the default name for this was quote_logs
    	//we changed it to quote_log to be more appropriate
    	//we will need to also edit model to reflect this change
        Schema::create('quote_log', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            //create column called author
            $table->string('author');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_log');
    }
}
