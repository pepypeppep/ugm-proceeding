@extends('public.layouts.master')

@section('title', 'Online Proceeding')

@section('content')
<div class="container pt-5 py-3">
	<section class="row">
		<div class="col-sm-3 pt-5 d-none d-lg-block">
			<img class="card-img-top" src="{{ $book->cover }}" alt="{{ $book->title }}" title="Proceeding of the 2nd International Conference on South East Asia Studies">
		</div>
		<div class="col-sm-6 pt-5">
			<h5>{{ $book->title }}</h5>
			<p class="text-justify">{!! $book->description !!}</p>
			
		</div>
		<div class="col-lg-3 pt-5 py-3 d-none d-lg-block">
			<!--button-->
			<div class="list-group">
				@empty ($book->data['download'])
				  <a href="#" class="btn list-group-item list-group-item-action disabled"><i class="fa fa-file-pdf pr-3"></i>Download PDF</a>
			  @else
			  	<a href="{{ $book->download }}" target="_blank" class="btn list-group-item list-group-item-action"><i class="fa fa-file-pdf pr-3"></i>Download PDF</a>
				@endempty
				<button type="button" class="btn list-group-item list-group-item-action"><i class="fa fa-bookmark pr-3"></i>Cite this article</button>
				<button type="button" class="btn list-group-item list-group-item-action"><i class="fa fa-print pr-2"></i> Print</button>
			</div>
			<!-- information -->
			<br>
			<small>
				<strong>Added to OnLi:</strong><br>
				{{ $book->created_at }}<br>
				<strong>Publisher</strong><br>
				{{ $book->publisher }}<br>
				<strong>Publication Year</strong><br>
				{{ $book->publication_year }}<br>
				<strong>Edition</strong><br>
				{{ $book->edition }}<br>
				<strong>Page(s)</strong><br>
				{{ $book->pages }}<br>
				<strong>ISBN</strong><br>
				{{ $book->publisher }}<br>
				<strong>Category</strong><br>
				{{ collect($book->category)->implode(',', '') }}
			</small>
		</div>
	</section>
</div>
@endsection
