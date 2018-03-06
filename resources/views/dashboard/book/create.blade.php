@extends('dashboard.layouts.master')

@section('title', 'Create a new book')

@section('header')
  <section class="header py-5">
    <div class="row justify-content-between">
      <div class="col-md-6 mb-3 mb-md-0">
        <h2>Create a new book</h2>
      </div>
    </div>
  </section>
@endsection

@section('content')
    <section class="body pb-5">
      <div class="row">
        <div class="col-lg-7">
          <form method="POST" action="{{ route('book.store') }}">
            {{ csrf_field() }}
            <div class="card">
              <div class="card-body" id="cardBody">
                <div class="form-separator">
                  <h5>General informations</h5>
                </div>
                {{-- FIELD NAME --}}
                <div class="form-group row">
                  <div class="col-sm-12">
                    <label>Title</label>
                    <textarea class="form-control @if($errors->has('title')) is-invalid @endif" name="title" id="title" rows="2" required autofocus>{{ request()->old('title') }}</textarea>
                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                  </div>
                </div>
                {{-- FIELD DESCRIPTION --}}
                <div class="form-group row">
                  <div class="col-sm-12">
                    <label>Description</label>
                    <textarea id="summernote" class="form-control @if($errors->has('description')) is-invalid @endif" name="description" id="description" rows="5">{{ request()->old('description') }}</textarea>
                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                  </div>
                </div>
                {{-- FIELD CATEGORY --}}
                <div class="form-group row">
                  <div class="col-sm-5">
                    <label>Category</label>
                    <input type="text" id="category" name="category" class="form-control @if($errors->has('category')) is-invalid @endif" value="{{ request()->old('category') }}">
                    <div class="invalid-feedback">{{ $errors->first('category') }}</div>
                  </div>
                </div>
                {{-- FIELD EDITION --}}
                <div class="form-group row">
                  <div class="col-sm-2">
                    <label>Edition</label>
                    <input type="number" id="edition" name="edition" class="form-control @if($errors->has('edition')) is-invalid @endif" value="{{ request()->old('edition') }}">
                    <div class="invalid-feedback">{{ $errors->first('edition') }}</div>
                  </div>
                </div>
                {{-- FIELD PAGES --}}
                <div class="form-group row">
                  <div class="col-sm-3">
                    <label>Pages</label>
                    <input type="number" id="pages" name="pages" class="form-control @if($errors->has('pages')) is-invalid @endif" value="{{ request()->old('pages') }}">
                    <div class="invalid-feedback">{{ $errors->first('pages') }}</div>
                  </div>
                </div>
                {{-- FIELD PUBLICATION YEAR --}}
                <div class="form-group row">
                  <div class="col-sm-3">
                    <label>Publication Year</label>
                    <input type="number" id="publication_year" name="publication_year" class="form-control @if($errors->has('publication_year')) is-invalid @endif" value="{{ request()->old('publication_year') }}">
                    <div class="invalid-feedback">{{ $errors->first('publication_year') }}</div>
                  </div>
                </div>
                {{-- FIELD PUBLISHER --}}
                <div class="form-group row">
                  <div class="col-sm-9">
                    <label>Publisher</label>
                    <input type="text" id="publisher" name="publisher" class="form-control @if($errors->has('publisher')) is-invalid @endif" value="{{ request()->old('publisher') }}">
                    <div class="invalid-feedback">{{ $errors->first('publisher') }}</div>
                  </div>
                </div>
                
                {{-- SUBMIT --}}
                <div class="form-group row mt-5">
                  <div class="col">
                    <button class="btn btn-primary btn-block" type="submit">Save</button>
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

@section('script')
  {{-- INITIALIZE TEXT EDITOR. INCLUDE THIS FOR EVERY FORM THAT NEED TEXT EDITOR --}}
  @include('layouts.summernote')
@endsection
