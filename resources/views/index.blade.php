<!--  inherit the master.blade.php in layouts folder -->
@extends('layouts.master')

<!--  content inside this section is displayed in master.blade.php -->
@section('title')
	Quotes App using Laravel
@endsection



@section('styles')

	<!--  we use fontawesome for pagination arrows. -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
@endsection

@section('content')

	<!--  urlname.com/authorName 
	in this the authorName is segment 1
	this checks if authorName is set in url which means that the filter is set -->
	@if(!empty(Request::segment(1)))
	
		<section class="filter-bar">
		
			A filter has been set! <a href="{{ route('index')}}"> Show all quotes</a>
		
		</section>
	
	@endif

    <!--  show error & success messages -->
	<section>
	<br>
	
			<!--  show errors -->
		@if(count($errors) > 0)
			<section class="info-box fail">
			
			 @foreach($errors->all() as $error)
			 
			      <div> {{ $error }} </div>
			  @endforeach
	
			</section>
		@endif
			
		<!--  show success message if it exists -->
		@if(Session::has('success'))
		
			<section class="info-box success">
			
				<!--  retrieve the success param from Session. We had stored this in the postQuote method in QuoteController.php -->
				{{ Session::get('success') }}
				
			</section>
		@endif
	
	</section>
	
	
		
	<!--  display the quotes -->
	
	
	<section class="quotes">
		<h1> Latest Quotes</h1>
		
		@for($i = 0; $i < count($quotes); $i++)
		
			<!--  style & design for each of the quotes -->
			<!--  here we are going to programmatically select the css class to be applied to the quotes. -->
			<!-- We will have 3 post per row. for leftmost post we will apply first-in-line class & for rightmost post we will apply last-in-line class
			i = 0 initially, we check modulus of 3, the value is 0, so we will apply first-in-line class
			i=1, modulus of 3 is not 0, so we will then check if $i+1's modulus of 3 is 0, it is not, so we will apply ''
			i=2, modulus of 3 is not 0, so we will then check if $i+1's modulus of 3 is 0, which is true, so it must be rightmost element, so we will apply last-in-line class  -->
			<article class="quote{{ $i % 3 === 0 ? ' first-in-line' : (($i+1) %3 === 0 ? '  last-in-line' : '' )}}">
				
				<!--  this is x sign to delete the quote -->
				<!--  use the delete route. pass the quote id -->
				<div class="delete"><a href="{{ route('delete', [ 'quote_id' => $quotes[$i]->id ] ) }}">x</a></div>
				
				
				<!--  show the quote -->
							{{ $quotes[$i]->quote }}	
							
							
							
				<div class="info">Created by  <a href="{{ route('author', ['author' => $quotes[$i]->author->name ])}}">{{ $quotes[$i]->author->name }}</a> on {{ $quotes[$i]->created_at }} </div>
				
			</article>
		 
		  
		@endfor
	
		
		
		<div class="pagination">
			
			
			<!-- if the current is not 1, means it is probably 2 or more. hence show left arrow -->
			<!-- we are using font awesome style to draw the arrow here -->
			@if($quotes->currentPage() !== 1)
				<a href="{{ $quotes->previousPageUrl() }}"> <span class="fa fa-caret-left"> </span> </a>
			@endif
			
			
			<!-- if current page is not the last page & this result has pages
			then show the right arrow -->
			@if($quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
			
				<a href="{{ $quotes->nextPageUrl()  }}" > <span class="fa fa-caret-right"></span></a>
			@endif
	
		</div>
			
	</section>
	
	

	
	<!--  add a quote -->
	<section class="edit-quote">
		<h1> Add a Quote</h1>
		
		<!-- form to add a quote -->
		<form method="post" action={{ route('create')}}>
			<div class="input-group">
				<label for="author">Your Name </label>
				<input type="text" name="author" id="author" placeholder="Your Name" />
			</div>
			
			<div class="input-group">
				<label for="email">Your Email </label>
				<input type="text" name="email" id="email" placeholder="Your Email" />
			</div>
			
			<div class="input-group">
				<label for="quote">Your Quote </label>
				<textarea name="quote" id="quote" rows="5" placeholder="Quote"></textarea>
			</div>
			<button type="submit" class="btn"> Submit Quote</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		
		</form>
	</section>
	
@endsection

