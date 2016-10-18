<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    //set relation with Author model
    //note the name of this function is singular of author
   //the  name of this method is important. It is singular because of the 'belongsTo' relationship
   //if you use plural (authors) as method name here, it will give error
    public function author(){
    	
    	//we have already set Author to have hasMany relation with Quote model
    	//here we set the inverse of that
    	return $this->belongsTo('App\Author');
    	
    }
	
}
