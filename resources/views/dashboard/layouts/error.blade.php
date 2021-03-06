@extends('dashboard.layouts.master')

@section('title', 'Oops! Something went wrong.')

@section('content')
	<section class="body py-3">
		<div class="row">
			<div class="col-lg-6 text-center offset-lg-3">
				<h1 class="text-muted" style="font-size: 5rem; font-weight: 600">{{ $code }}</h1>
				<img src="/img/ilustrations/error-with-laptop.svg" class="img-fluid">
				<h3 class="mt-3">Opps! Something went wrong.</h3>
				<h5>{{ $errors->first('message') }}</h5>
				{{-- <h5>Something went wrong on our system. Try to reload the page. Sometimes it helps</h5> --}}
				
			</div>
		</div>
	</section>
@endsection