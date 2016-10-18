<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	
	//this method executes when we run this migrations file to create our table
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            //column that will hold the actual quote
            $table->text('quote');
            
            //column that will hold the author id of author who wrote the quote
            $table->integer('author_id');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    //this method executes when we run this migrations file to  destroy our table
    public function down()
    {
        Schema::drop('quotes');
    }
}
