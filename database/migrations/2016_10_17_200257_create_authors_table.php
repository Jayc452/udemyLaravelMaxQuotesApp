<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	
	//this method executes when we run this migrations file to create our table
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            
        	//these were there by default
        	$table->increments('id');
            $table->timestamps();
            
            //create the name column 
            $table->string('name');
            
            //create column for email
            $table->string('email');
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
        Schema::drop('authors');
    }
}
