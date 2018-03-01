@extends('public.layouts.master')

@section('title', 'Online Proceeding')

@section('content')
<div class="container pt-5 py-3">
	<section class="row">
		<div class="col-sm-3 pt-5 d-none d-lg-block">
			<img class="card-img-top" src="../img/books/fig4.jpg" alt="ICST 2017 Proceeding" title="Proceeding of the 2nd International Conference on South East Asia Studies">
		</div>
		<div class="col-sm-6 pt-5">
			<h5>{{ $books->title }}</h5>
			<p class="text-justify">{!! $books->description !!}</p>
			
		</div>
		<div class="col-lg-3 pt-5 py-3 d-none d-lg-block">
			<!--button-->
			<div class="list-group">
				<button type="button" class="btn list-group-item list-group-item-action"><i class="fa fa-file-pdf pr-3"></i>Download PDF</button>
				<button type="button" class="btn list-group-item list-group-item-action"><i class="fa fa-bookmark pr-3"></i>Cite this article</button>
				<button type="button" class="btn list-group-item list-group-item-action"><i class="fa fa-print pr-2"></i> Print</button>
			</div>
			<!-- information -->
			<br>
			<small>
				<strong>Added to OnLi:</strong><br>
				{{ $books->created_at }}<br>
				<strong>Publisher</strong><br>
				{{ $books->publisher }}<br>
				<strong>Publication Year</strong><br>
				{{ $books->publication_year }}<br>
				<strong>Edition</strong><br>
				{{ $books->edition }}<br>
				<strong>Page(s)</strong><br>
				{{ $books->pages }}<br>
				<strong>ISBN</strong><br>
				{{ $books->publisher }}<br>
				<strong>Category</strong><br>
				{{ collect($books->category)->implode(',', '') }}
			</small>
		</div>
	</section>
</div>
@endsection