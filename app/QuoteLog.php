<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteLog extends Model
{
    //in migrations file for this model, the default table name was quote_logs,
    //we changed it to quote_log there. So here we need to reflect the change
	protected $table = "quote_log";
	
	
	
	
}
