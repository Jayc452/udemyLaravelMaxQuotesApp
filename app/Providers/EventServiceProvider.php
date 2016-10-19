<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
	
	//listen varaible, listens for events
	//we will be listening for QuoteCreated event
	//Listeners for that will be CreateLogEntry
	//when we execute php artisan event:generate these files will be generated automatically
    protected $listen = [
    		
    		//when QuoteCreated event occurs the listeners in the array will be executed.
        'App\Events\QuoteCreated' => [
        		
        	//this will create a log entry in our quotes_log table	
            'App\Listeners\CreateLogEntry',
        	//this will send an email
        	'App\Listeners\SendUserNotification',
        		
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
