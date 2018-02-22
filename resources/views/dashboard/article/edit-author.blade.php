@extends('dashboard.layouts.master')

@section('title', 'Edit Article')

@section('header')
<section class="header py-5">
  <div class="row justify-content-between">
    <div class="col-md-6 mb-3 mb-md-0">
      <h2 class="m-0">Edit Author</h2>
      <a href="{{ route('article.show', [$article->id]) }}" class="text-primary" style="font-size: 0.9rem"><i class="fas fa-angle-left fa-fw"></i>Back to article details</a>
    </div>
  </div>
</section>
@endsection

@section('content')
  <!-- BODY -->
  <section class="body pb-5">
    <div class="row">
      <div class="col-lg-8">
        <form id="form" method="POST" action="{{ route('article.update', [$article->id]) }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <input type="hidden" name="proceeding_id" value="{{ $article->id }}">
          <div class="card">
            <div class="card-body" id="cardBody">
              <div class="form-separator">
                <h5>Author details</h5>
              </div>
              @foreach ($author->data['authors'] as $author)
              <div class="form-group row" id="name">
                <label for="name" class="col-sm-2 col-form-label">ID</label>
                <div class="col-md-8 col-12">
                  <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" value="{{ $author['id'] }}">
                  <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                </div>
              </div>
              <div class="form-group row" id="name">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-md-8 col-12">
                  <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" value="{{ $author['name'] }}">
                  <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                </div>
              </div>
              <div class="form-group row" id="affiliation">
                <label for="affiliation" class="col-sm-2 col-form-label">Affiliation</label>
                <div class="col-md-8 col-12">
                  <input type="text" name="affiliation" class="form-control @if($errors->has('affiliation')) is-invalid @endif" value="{{ $author['affiliation'] }}">
                  <div class="invalid-feedback">{{ $errors->first('affiliation') }}</div>
                </div>
              </div>
              <div class="form-group row" id="email">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-md-8 col-12">
                  <input type="text" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" value="{{ $author['email'] }}">
                  <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                </div>
              </div>
              <br><br>
              @endforeach
            <div class="card-footer bg-white mt-5">
              <div class="text-right">
                <button class="btn btn-primary btn-block" type="submit">Save author</button>
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
