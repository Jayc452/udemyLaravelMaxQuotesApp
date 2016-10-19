<?php


//set the namespace Controllers
namespace App\Http\Controllers;

//import the Author & Quote models 
use App\Author;

//import quote model
use App\Quote;

//import the Request class
use Illuminate\Http\Request;

//import Log facade/class
use Illuminate\Support\Facades\Log;


//import QuoteCreated event
use App\Events\QuoteCreated;

//import event facades
use Illuminate\Support\Facades\Event;



class QuoteController extends Controller{
	
	//this will return the index view
	//we may pass $author to this method. else its default value is null
	public function getIndex($author = null){
		
		//if author is not null
		if(!is_null($author)){
			
			//get the author from db
			$quote_author = Author::where('name', $author)->first();
			
			if($quote_author){
				
				//get all the quotes by the author. order by descending order of date	
				//pagination is enabled. So you will get 6 records per page
				$quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(6); 
			}
			
		}
		else{
			
				//get all quotes from quotes table using Quote model and ORM
			//pagination is enabled. So you will get 6 records per page
				$quotes = Quote::orderBy('created_at', 'desc')->paginate(6);
			
		}
		
		
		//the first param is the view that is to be loaded
		//2nd param is an array of key value of pairs,that contain data to be displayed in the frontend view
		return view('index', ['quotes' => $quotes]);
	}
	
	
	public function postQuote(Request $request){
		
		//validation
		$this->validate($request, [
				
			'author' => 'required|max:60|alpha',
			'quote' => 'required|max:500',
			'email' => 'required|email'
				
		]);
		
		//get the values from the form fields
		
		//get the author name & capitalise the first character
		$authorName = ucfirst($request['author']);
		//get the quote
		$quoteText = $request['quote'];
		
		//get email
		$authorEmail = $request['email'];
		
		//see if the author already exists in our db
		//get the author 
		$author = Author::where('name', $authorName)->first();
		
		//if author doesnt exist, then create a new one
		if(!$author){
			
			$author = new Author();
			$author->name = $authorName;
			$author->email = $authorEmail;
			$author->save();
			
		}
		
		$quote = new Quote();
		$quote->quote= $quoteText;
		
		//save this using relations
		//use the quotes method we have in author model to save the authorid & quote in quotes table
		$author->quotes()->save($quote);
		
		
		//fire the QuoteCreated event 
		//pass an object of QuoteCreated as a parameter
		Event::fire(new QuoteCreated($author));
		
		//return the index route
		//"with" carries the content that we want to deliver to that view. We can add anything in there
		//return redirect() is an alternative to return view...
		//success param is stored in our session. So you can retrieve it in index view using Session
		return redirect()->route('index')->with([
				'success' => 'Quote Saved'	
		]);
		
		
	}
	
	//method to delete a quote
	//$quote_idis got from the url, cause this is a GET method
	public function getDeleteQuote($quote_id){
		
		log::info('inside getDeleteQuote');
		
		//get the quote using the quote id
		$quote = Quote::find($quote_id);
		
		$author_deleted = false;
		
		//see if the author of this quote, has written only 1 quote.
		//if so delete the author when you delete his quote
		if(count($quote->author->quotes) === 1){
			
			//delete the author
			$quote->author->delete();
			$author_deleted = true;
		}
		
		//delete the quote
		$quote->delete();
		
		//set the message
		$msg = $author_deleted ? 'Quote and author deleted' : 'Quote deleted';
		
		return redirect()->route('index')->with(['success' => $msg]);
	}
	
}