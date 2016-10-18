<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    //set relation with Author model
    //note the name of this function is plural of authors
    public function authors(){
    	
    	//we have already set Author to have hasMany relation with Quote model
    	//here we set the inverse of that
    	return $this->belongsTo('App\Author');
    }
	
}
