@extends('public.layouts.master')

@section('title', 'Online Proceeding')

@section('content')
<!--book info-->
<div class="container pt-5 py-3">
	<section class="row">
		<div class="col-sm-3 pt-5 d-none d-lg-block">
			<img class="card-img-top" src="{{ $proceeding->front_cover }}" alt="{{ $proceeding->alias }}" title="{{ $proceeding->name }}">
		</div>
		<div class="col-sm-9 pt-5">
			<h5>{{ $proceeding->name }}</h5>
			{!! $proceeding->introduction !!}
			<table class="small">
				<tr>
					<td><strong>Date of conference</strong></td>
					<td><strong>:</strong></td>
					<td>{{ $proceeding->date['conference_start'] }} - {{ $proceeding->date['conference_end'] }}</td>
				</tr>
				<tr>
					<td><strong>Conference location</strong></td>
					<td><strong>:</strong></td>
					<td>{{ $proceeding->location }}</td>
				</tr>
				</tr>
				<tr>
					<td><strong>Added to OnLi</strong></td>
					<td><strong>:</strong></td>
					<td>{{ $proceeding->created_at }}</td>
				</tr>
				@foreach($proceeding->identifiers as $identifiers)
				<tr>
					<td><strong>
					@if($identifiers['type']=='print_isbn'){{ 'PRINT ISBN' }}
                    @elseif($identifiers['type']=='online_isbn'){{ 'ONLINE ISBN' }}
                    @else{{ 'DOI' }}
                    @endif
					</strong></td>
					<td><strong>:</strong></td>
					<td>{{ $identifiers['id'] }}</td>
				</tr>
				@endforeach
			</table>
		</div>
	</section>
</div>
<!--filter search-->
<section class="jumbotron-blue sticky-top">
	<div class="container py-3 ">
		<div class="row "> 
			<div class="col-sm-2">
				<select class="custom-select ">
					<option selected>Author</option>
					@foreach ($proceeding->articles as $article)
					<option value="{{ collect($article['authors']) }}">{{ collect($article['authors'])->implode('name','') }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-8">
				<input type="text " class="form-control " placeholder="Search in ICSEAS 2017">
			</div>
			<div class="col-sm-2">
				<button type="button" class="btn blocks"><i class="fa fa-search fa-fw" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</section>
<!--table of contents-->
<section class="container list-group py-3">
	@foreach ($proceeding->articles as $article)
	<div class="list-group-item list-group-item-action border-0 ">
		<div class="row ">
			<div class="col-md-9">
				<a class="text-dark mb-1">{{ $article['title'] }}</a><br/>
				<a class="small text-primary ">{{ collect($article['authors'])->implode('name','; ') }}</a>
			</div>
			<div class="col-md-3 align-self-center">
				<a href="{{ route('public.article.show',[$article['id']]) }}" class="btn btn-primary" role="button" aria-disabled="true">View</a>
				<a href="../index.html" class="btn btn-danger" role="button" aria-disabled="true">PDF</a>
				<a class="btn btn-light" role="button" aria-disabled="true">1&ndash;6</a>
			</div>
		</div>
	</div>
	@endforeach
</section>
@include('public.layouts.latest-proceeding')
@endsection
