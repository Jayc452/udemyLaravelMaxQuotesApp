<?php


//set the namespace Controllers
namespace App\Http\Controllers;

//import the Author & Quote models 
use App\Author;
use App\Quote;

//import the Request class
use Illuminate\Http\Request;

class QuoteController extends Controller{
	
	//this will return the index view
	public function getIndex(){
		
		//get all the quotes
		$quotes = Quote::all();
		
		//the first param is the view that is to be loaded
		//2nd param is an array of key value of pairs,that contain data to be displayed in the frontend view
		return view('index', ['quotes' => $quotes]);
	}
	
	
	public function postQuote(Request $request){
		
		//validation
		$this->validate($request, [
				
			'author' => 'required|max:60|alpha',
			'quote' => 'required|max:500'
				
		]);
		
		//get the values from the form fields
		
		//get the author name & capitalise the first character
		$authorName = ucfirst($request['author']);
		//get the quote
		$quoteText = $request['quote'];
		
		//see if the author already exists in our db
		//get the author 
		$author = Author::where('name', $authorName)->first();
		
		//if author doesnt exist, then create a new one
		if(!$author){
			
			$author = new Author();
			$author->name = $authorName;
			$author->save();
			
		}
		
		$quote = new Quote();
		$quote->quote= $quoteText;
		
		//save this using relations
		//use the quotes method we have in author model to save the authorid & quote in quotes table
		$author->quotes()->save($quote);
		
		//return the index route
		//"with" carries the content that we want to deliver to that view. We can add anything in there
		//return redirect() is an alternative to return view...
		//success param is stored in our session. So you can retrieve it in index view using Session
		return redirect()->route('index')->with([
				'success' => 'Quote Saved'	
		]);
		
		
	}
	
}