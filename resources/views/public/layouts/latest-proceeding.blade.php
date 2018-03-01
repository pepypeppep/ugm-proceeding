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
					@foreach($latestProceedings as $proceeding)
					<div class="card">
						<a href="{{ route('public.proceeding.show',[$proceeding['id']]) }}">
							<img class="card-img-top" src="{{ $proceeding['front_cover'] }}" alt="{{ $proceeding['alias'] }}" title="{{ $proceeding['name'] }}">
						</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
</div>