@extends('public.layouts.master')

@section('title', 'Online Proceeding')

@section('content')
<!--general search-->
<div class="jumbotron-head py-5">
	<section class="container py-5">
		<h1 class="text-center py-5 text-light">Read. Learn. Discover</h1>
		<div class="col-lg-6 m-auto">
			<div class="form-group pt-5">
				<input type="text" class="form-control form-control-lg" placeholder="Search title, topic, author, affiliation, keyword, etc">
			</div>
			<button type="submit" class="btn btn-primary">Search</button>
			<a href="./advanced-search.html"><button type="submit" class="btn btn-secondary">Advanced search</button></a>
		</div>
	</div>
</section>
</div>
<!--news-->
<section class="container">
	<div class="row p-3">
		<!--recent articles-->
		<div class="col-sm-8 py-5">
			<h5 class="text-uppercase">Recent articles</h5>
			<div class="list-group">
				@foreach($articles->data->take(3) as $article)
				<a href="{{ route('public.article.show',[$article['id']]) }}" class="list-group-item list-group-item-action flex-column align-items-start border-top-0 border-left-0 border-right-0">
					<p class="mb-1">{{ $article['title'] }}</p>
					<small class="text-primary">{{ collect($article['authors'])->implode('name','; ') }}</small>
				</a>
				@endforeach
			</div>
			<button class="btn btn-none-primary my-2">More articles
				<i class="fa fa-chevron-circle-right pl-3"></i>
			</button>
		</div>
		<!--upcoming conferences-->
		<div class="col-sm-4 py-5">
			<h5 class="text-uppercase">Upcoming conferences</h5>
			<div class="list-group">
				<a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-top-0 border-left-0 border-right-0">
					<p class="mb-1">The 2nd International Conference on Health Sciences</p>
					<small class="text-primary">Eastparc Hotel, Yogyakarta. 11–12 July 2017</small>
				</a>
				<a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-left-0 border-right-0">
					<p class="mb-1">The 2nd International Conference on South East Asia Studies</p>
					<small class="text-primary">Eastparc Hotel, Yogyakarta. 27–28 September 2017</small>
				</a>
				<a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-left-0 border-right-0">
					<p class="mb-1">The 2nd International Conference on Tropical Agriculture</p>
					<small class="text-primary">Eastparc Hotel, Yogyakarta. 26–27 October 2017</small>
				</a>
			</div>
			<button class="btn btn-none-primary my-2">More conferences
				<i class="fa fa-chevron-circle-right pl-3"></i>
			</button>
		</div>
	</div>
</section>
<!--bookshelf-->
<div class="jumbotron-book">
	<section class="container p-5">
		<div class="row">
			<div class="col-sm-4 pb-5">
				<h4 class="text-uppercase">Latest proceedings</h4>
				<p>View the latest published proceedings from our international and national conferences.</p>
				<a href="{{ route('public.proceeding.index') }}">
					<button type="button m-sm-0" class="btn btn-none-primary">View all
						<i class="fa fa-chevron-circle-right pl-3"></i>
					</button>
				</a>
			</div>
			<div class="container col-sm-8">
				<div class="card-deck">
					@foreach($proceedings->data->take(4) as $proceeding)
					<div class="card">
						<a href="./docs/201707.html">
							<img class="card-img-top" src="{{ $proceeding['front_cover'] }}" alt="{{ $proceeding['alias'] }}" title="{{ $proceeding['name'] }}">
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
</div>
<!--footer-->
<section class="jumbotron-gold">
	<div class="container py-5 p-md-5">
		<button type="button m-sm-0" class="btn btn-primary">Subscribe</button>
	</div>
</section>
@endsection