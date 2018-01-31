@extends('dashboard.layouts.master')

@section('title', 'Create a new proceeding')

@section('header')
  <section class="header py-5">
    <div class="row justify-content-between">
      <div class="col-md-6 mb-3 mb-md-0">
        <h2>Create a new proceeding</h2>
      </div>
    </div>
  </section>
@endsection

@section('content')
	<section class="body pb-5">
		<div class="row">
      <div class="col-lg-8">
        <form method="POST" action="{{ route('proceeding.store') }}">
          {{ csrf_field() }}
          <div class="card" style="border: none;">
            <div class="card-body" id="cardBody">
              <div class="form-separator">
                <h5>General informations</h5>
              </div>
              <div class="form-group row">
                <div class="col-sm-9">
                  <label>Name</label>
                  <textarea class="form-control @if($errors->has('name')) is-invalid @endif" name="name" id="name" rows="1" required autofocus>{{ request()->old('name') }}</textarea>
                  <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="alias">Conference's Alias</label>
                  <input name="alias" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('alias')) is-invalid @endif" id="alias" value="{{ request()->old('alias') }}" required>
                  <small id="aliasHelp" class="form-text text-muted">e.g. ICST 2017</small>
                  <div class="invalid-feedback">{{ $errors->first('alias') }}</div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <label for="organizer">Organizer</label>
                  <input name="organizer" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('organizer')) is-invalid @endif" id="organizer" value="{{ request()->old('organizer') }}" required>
                  <div class="invalid-feedback">{{ $errors->first('organizer') }}</div>
                </div>
              </div>
              <div class="form-separator mt-5">
                <h5>Conference date</h5>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="conference_start">Start date</label>
                  <input name="conference_start" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('conference_start')) is-invalid @endif" id="conference_start" value="{{ request()->old('conference_start') }}" required>
                  <div class="invalid-feedback">{{ $errors->first('conference_start') }}</div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="conference_end">End date</label>
                  <input value="{{ request()->old('conference_end') }}" name="conference_end" type="text" class="form-control mb-2 mb-sm-0 @if($errors->has('conference_end')) is-invalid @endif" id="conference_end">
                  <div class="invalid-feedback">{{ $errors->first('conference_end') }}</div>
                </div>
              </div>
              <div class="form-group row mt-5">
                <div class="col-sm-2">
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>
              </div>
            </div>
            {{-- END CARD BODY --}}
          </div>
        </form>
      </div>
    </div>
	</section>
@endsection