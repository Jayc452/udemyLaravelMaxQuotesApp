<!--  inherit the master.blade.php in layouts folder -->
@extends('layouts.master')

<!--  content inside this section is displayed in master.blade.php -->
@section('title')
	Hello
@endsection



@section('styles')

	<!--  we use fontawesome for pagination arrows. -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
@endsection

@section('content')

	<!--  display the quotes -->
	<section class="quotes">
		<h1> Latest Quotes</h1>
		
		<!--  style & design for each of the quotes -->
		<article class="quote">
			<div class="delete"><a href="#">x</a></div>
			Quote Text
			<div class="info"><a href="#">Created by Jay</a> on... </div>
		</article>
		
		Pagination goes here	
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
				<label for="quote">Your Quote </label>
				<textarea name="quote" id="quote" rows="5" placeholder="Quote"></textarea>
			</div>
			<button type="submit" class="btn"> Submit Quote</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		
		</form>
	</section>
@endsection

