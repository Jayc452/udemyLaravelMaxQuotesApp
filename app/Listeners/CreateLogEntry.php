<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


//import QuoteLog class
use App\QuoteLog;


//this is the listener that listen for QuoteCreated event
class CreateLogEntry
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuoteCreated  $event
     * @return void
     */
    
    //this method handles when the event is fired
    public function handle(QuoteCreated $event)
    {
        //get the author param from the $event
        $author = $event->author;
        
        //store the author in the QuoteLog model
        $log_entry = new QuoteLog();
        $log_entry->author = $author;
        $log_entry->save();
        
    }
}
