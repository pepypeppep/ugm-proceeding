@extends('dashboard.layouts.master')

@section('title', 'Edit Article')

@section('header')
<section class="header py-5">
  <div class="row justify-content-between">
    <div class="col-md-6 mb-3 mb-md-0">
      <h2 class="m-0">Edit Article</h2>
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
          <input type="hidden" name="proceeding_id" value="">
          <div class="card">
            <div class="card-body" id="cardBody">
              <div class="form-separator">
                <h5>Article details</h5>
              </div>
              <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                  <textarea class="form-control @if($errors->has('title')) is-invalid @endif" name="title" id="title" rows="1">{{ $article->data['title'] }}</textarea>
                  <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                </div>
              </div>
              <div class="form-group row">
                <label for="start_page" class="col-sm-2 col-form-label">Page</label>
                <div class="col-sm-5">
                  <input name="start_page" type="number" class="form-control mb-2 mb-sm-0 @if($errors->has('start_page')) is-invalid @endif" id="start_page" placeholder="Start page" value="{{ $article->data['start_page'] }}" required>
                  <div class="invalid-feedback">{{ $errors->first('start_page') }}</div>
                </div>
                <div class="col-sm-5">
                  <input name="end_page" type="number" class="form-control mb-2 mb-sm-0 @if($errors->has('end_page')) is-invalid @endif" id="end_page" placeholder="End page" value="{{ $article->data['end_page'] }}" required>
                  <div class="invalid-feedback">{{ $errors->first('end_page') }}</div>
                </div>
              </div>
              <div class="form-group row">
                <label for="abstract" class="col-sm-2 col-form-label">Abstract</label>
                <div class="col-sm-10">
                  <textarea id="summernote" class="form-control @if($errors->has('abstract')) is-invalid @endif" name="abstract" id="abstract" rows="5">{{ $article->data['abstract'] }}</textarea>
                  <div class="invalid-feedback">{{ $errors->first('abstract') }}</div>
                </div>
              </div>
              <div class="form-group row" id="keywords">
                <label for="keywords" class="col-sm-2 col-form-label">Keywords</label>
                <div class="col-md-8 col-12">
                  <input type="text" name="keywords" class="form-control @if($errors->has('keywords')) is-invalid @endif" value="{{ $article->keywords->implode(',') }}">
                  <small class="form-text text-muted">Seperate each keyword with comma. Ex: Microbiology, Molecular biology</small>
                  <div class="invalid-feedback">{{ $errors->first('keywords') }}</div>
                </div>
              </div>
              {{-- <div class="form-separator mt-5">
>>>>>>> upstream/master
                <h5>File</h5>
              </div>
              <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">File type</label>
                <div class="col-md-5 col-12">
<<<<<<< HEAD
                @if (!$articles->indexed)
=======
                @if (!$article->indexed)
>>>>>>> upstream/master
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="file_type" id="file_type_pdf" value="pdf"onclick="showPdfInput()" checked>
                    <label class="form-check-label" for="file_type_pdf">
                      PDF File
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="file_type" id="file_type_scopus" value="scopus" onclick="showLinkInput()">
                    <label class="form-check-label" for="file_type_scopus">
                      Indexed by Scopus
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="file_type" id="file_type_doaj" value="doaj" onclick="showLinkInput()">
                    <label class="form-check-label" for="file_type_doaj">
                      Indexed by DOAJ
                    </label>
                  </div>
                @else
<<<<<<< HEAD
                  @if($articles->file['type']=='scopus')
=======
                  @if($article->file['type']=='scopus')
>>>>>>> upstream/master
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="file_type" id="file_type_pdf" value="pdf"onclick="showPdfInput()">
                    <label class="form-check-label" for="file_type_pdf">
                      PDF File
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="file_type" id="file_type_scopus" value="scopus" onclick="showLinkInput()" checked>
                    <label class="form-check-label" for="file_type_scopus">
                      Indexed by Scopus
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="file_type" id="file_type_doaj" value="doaj" onclick="showLinkInput()">
                    <label class="form-check-label" for="file_type_doaj">
                      Indexed by DOAJ
                    </label>
                  </div>
                  @else
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="file_type" id="file_type_pdf" value="pdf"onclick="showPdfInput()">
                    <label class="form-check-label" for="file_type_pdf">
                      PDF File
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="file_type" id="file_type_scopus" value="scopus" onclick="showLinkInput()">
                    <label class="form-check-label" for="file_type_scopus">
                      Indexed by Scopus
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="file_type" id="file_type_doaj" value="doaj" onclick="showLinkInput()" checked>
                    <label class="form-check-label" for="file_type_doaj">
                      Indexed by DOAJ
                    </label>
                  </div>
                  @endif
                @endif
                </div>
              </div>
              <div class="form-group row" id="file_link" style="display: none;">
                <label for="file_link" class="col-sm-2 col-form-label">Link</label>
                <div class="col-md-10 col-12">
<<<<<<< HEAD
                  <input type="text" name="file_link" class="form-control @if($errors->has('file_link')) is-invalid @endif" value="{{ $articles->file['link'] }}">
=======
                  <input type="text" name="file_link" class="form-control @if($errors->has('file_link')) is-invalid @endif" value="{{ $article->file['link'] }}">
>>>>>>> upstream/master
                  <div class="invalid-feedback">{{ $errors->first('file_link') }}</div>
                </div>
              </div>
              <div class="form-group row" id="file_pdf">
                <label for="file_pdf" class="col-sm-2 col-form-label">Upload PDF</label>
                <div class="col-md-5 col-12">
                  <input type="file" name="file_pdf" class="form-control @if($errors->has('file_pdf')) is-invalid @endif" value="{{ request()->old('file_pdf') }}">
                  <div class="invalid-feedback">{{ $errors->first('file_pdf') }}</div>
                </div>
<<<<<<< HEAD
              </div>
              <div class="form-group row" id="doi">
                <label for="doi" class="col-sm-2 col-form-label">DOI</label>
                <div class="col-md-8 col-12">
                  <input type="text" name="doi" class="form-control @if($errors->has('doi')) is-invalid @endif" value="{{ request()->old('doi') }}">
=======
              </div> --}}
              <div class="form-group row" id="doi">
                <label for="doi" class="col-sm-2 col-form-label">DOI</label>
                <div class="col-md-8 col-12">
                  <input type="text" name="doi" class="form-control @if($errors->has('doi')) is-invalid @endif" value="{{ $article->identifiers->where('type', 'doi')->first()['id'] }}">
                  <div class="invalid-feedback">{{ $errors->first('doi') }}</div>
                </div>
              </div>
            <div class="card-footer bg-white mt-5">
              <div class="text-right">
                <button class="btn btn-primary btn-block" type="submit">Save article</button>
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
