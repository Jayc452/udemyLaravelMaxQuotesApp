<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // set the relation
    //notice the name of this function is plural of Quote
	public function quotes(){
		
		//this model (Author) has a 'hasMany' relation with Quote model
		//the parameter passed is the Quote model
		return $this->hasMany('App\Quote');
		
	}
	
}
