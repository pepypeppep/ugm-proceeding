@extends('dashboard.layouts.master')

@section('title', 'Edit Proceedings Details')

@section('header')
  <section class="header py-5">
    <div class="row justify-content-between">
      <div class="col-md-10 mb-3 mb-md-0">
        <h2 class="m-0">Edit proceeding details</h2>
        <a href="{{ route('proceeding.show', [$proceeding->id, 'tab' => 'articles']) }}" class="text-primary" style="font-size: 0.9rem"><i class="fas fa-angle-left fa-fw"></i>Back to proceedings</a>
      </div>
    </div>
  </section>
@endsection

@section('content')
	<section class="body pb-5">
		<div class="row">
			<div class="col-lg-8">
				<form method="POST" action="{{ route('proceeding.update', [$proceeding->id]) }}">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="card">
						<div class="card-body">
							<div class="form-separator">
								<h5>General informations</h5>
							</div>
							{{-- FIELD NAME --}}
							<div class="form-group row">
							  <div class="col-sm-12">
							    <label>Name</label>
							    <textarea class="form-control @if($errors->has('name')) is-invalid @endif" name="name" id="name" rows="1" required>{{ $proceeding->name }}</textarea>
							    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
							  </div>
							</div>
							{{-- FIELD INTRODUCTION --}}
							<div class="form-group row">
							  <div class="col-sm-12">
							    <label>Introduction</label>
							    <textarea id="summernote" class="form-control @if($errors->has('introduction')) is-invalid @endif" name="introduction" id="introduction" rows="4" required @if(request('focus') == 'introduction') autofocus @endif>{{ $proceeding->introduction }}</textarea>
							    <div class="invalid-feedback">{{ $errors->first('introduction') }}</div>
							  </div>
							</div>
							{{-- FIELD ALIAS --}}
							<div class="form-group row">
							  <div class="col-sm-4">
							    <label for="alias">Conference's short name</label>
							    <input name="alias" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('alias')) is-invalid @endif" id="alias" value="{{ $proceeding->alias }}" required>
							    <small id="aliasHelp" class="form-text text-muted">e.g. ICST 2017</small>
							    <div class="invalid-feedback">{{ $errors->first('alias') }}</div>
							  </div>
							</div>
							{{-- FIELD ORGANIZER --}}
							<div class="form-group row">
							  <div class="col-sm-6">
							    <label for="organizer">Organizer</label>
							    <input name="organizer" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('organizer')) is-invalid @endif" id="organizer" value="{{ $proceeding->organizer }}" required>
							    <div class="invalid-feedback">{{ $errors->first('organizer') }}</div>
							  </div>
							</div>
							{{-- FIELD DATE --}}
							<div class="form-group row">
							  <div class="col-sm-5">
							    <label for="conference_start">Conference date</label>
							    <div class="input-group input-daterange datepicker">
							      <input type="text" class="form-control @if($errors->has('conference_start')) is-invalid @endif" name="conference_start" value="{{ $proceeding->date['conference_start'] }}" required>
							      <div class="input-group-append">
							        <span class="input-group-text" id="">to</span>
							      </div>
							      <input type="text" class="form-control @if($errors->has('conference_end')) is-invalid @endif" name="conference_end" value="{{ $proceeding->date['conference_end'] }}" required>
							    </div>
							    <div class="invalid-feedback">{{ $errors->first('conference_start') }}</div>
							    <div class="invalid-feedback">{{ $errors->first('conference_end') }}</div>
							  </div>
							</div>
							{{-- FIELD ORGANIZER --}}
							<div class="form-group row">
							  <div class="col-sm-6">
							    <label for="location">Conference's location</label>
							    <input name="location" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('location')) is-invalid @endif" id="location" value="{{ $proceeding->location }}" required>
							    <div class="invalid-feedback">{{ $errors->first('location') }}</div>
							  </div>
							</div>
							<div class="form-separator mt-5">
								<h5>Identifiers</h5>
							</div>
							{{-- FIELD ONLINE ISBN IDENTIFIER --}}
							<div class="form-group row">
							  <div class="col-sm-6">
							    <label for="isbn">Online ISBN</label>
							    <input name="online_isbn" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('online_isbn')) is-invalid @endif" id="onlineIsbn" value="{{ $isbn['online'] }}">
							    <div class="invalid-feedback">{{ $errors->first('online_isbn') }}</div>
							  </div>
							</div>
							{{-- FIELD PRINT ISBN IDENTIFIER --}}
							<div class="form-group row">
							  <div class="col-sm-6">
							    <label for="isbn">Print ISBN</label>
							    <input name="print_isbn" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('print_isbn')) is-invalid @endif" id="printIsbn" value="{{ $isbn['print'] }}">
							    <div class="invalid-feedback">{{ $errors->first('print_isbn') }}</div>
							  </div>
							</div>
							{{-- FIELD ISSN IDENTIFIER --}}
							<div class="form-group row">
							  <div class="col-sm-6">
							    <label for="issn">ISSN</label>
							    <input name="issn" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('issn')) is-invalid @endif" id="issn" value="{{ $issn }}">
							    <div class="invalid-feedback">{{ $errors->first('issn') }}</div>
							  </div>
							</div>
							{{-- SUBMIT --}}
							<div class="form-group row mt-5">
							  <div class="col-sm-12 text-right">
							    <a type="button" href="{{ route('proceeding.show', ['proceeding' => $proceeding->id]) }}" class="btn btn-warning">Back</a>
							    <button class="btn btn-primary" type="submit">Update</button>
							  </div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
@endsection

@section('script')
	{{-- INITIALIZE TEXT EDITOR. INCLUDE THIS FOR EVERY FORM THAT NEED TEXT EDITOR --}}
	@include('layouts.summernote')
@endsection
