<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//this route handle requests to root / in the url or where route name index is invoked
//we will use this route also for filtering quotes by author
//author field is optional, which is why we have ?
Route::get('/', [

	'uses' => 'QuoteController@getIndex',
	'as' => 'index'
		
]);


//route to create new post
Route::post('/new', [
	
	'uses' => 'QuoteController@postQuote',
	'as' => 'create'
		
]);

//route to delete a post
Route::get('/delete/{quote_id}', [
		
	'uses' => 'QuoteController@getDeleteQuote',
	'as' => 'delete' 
		
]);


Route::get('/author/{author?}', [

		'uses' => 'QuoteController@getIndex',
		'as' => 'author'

]);

//route for logs
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');



