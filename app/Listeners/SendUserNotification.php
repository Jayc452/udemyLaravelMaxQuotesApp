<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


//import Mail class
use Illuminate\Support\Facades\Mail;



class SendUserNotification
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
    
    //this method will be executed when this listener is called
    public function handle(QuoteCreated $event)
    {
        //get the author object from the event
        $author = $event->author;
        
        //get the name & email
        $name = $author->name;
        $email = $author->email;	
        
        //import mail class in global before using this
        //send email using Mail class
        
        //1st param is the template we will use for this email
        //2nd param is variables we will pass to the view/email template, that can be used there
        //3rd param is the function closure where we can pass additional conifgurations to the email and configure the message.
        //use function specifies the variables we will be using in the closure
        Mail::send('email.user_notification', ['name' => $name], function($message) use($email, $name){
        	
        	//this is basic email. you can also add cc, attachments etc.
        	$message->from('admin@mytestcourse.com', 'Admin');
        	
        	//To field contains the email address & name of the author
        	$message->to($email, $name);
        	
        	//subject
        	$message->subject('Thank you for your quote ');
        	
        });
    	
    	
    }
}
