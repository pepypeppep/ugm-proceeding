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
        <form id="form" method="POST" action="" enctype="multipart/form-data">
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
                <h5>File</h5>
              </div>
              <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">File type</label>
                <div class="col-md-5 col-12">
                @if (!$article->indexed)
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
                  @if($article->file['type']=='scopus')
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
                  <input type="text" name="file_link" class="form-control @if($errors->has('file_link')) is-invalid @endif" value="{{ $article->file['link'] }}">
                  <div class="invalid-feedback">{{ $errors->first('file_link') }}</div>
                </div>
              </div>
              <div class="form-group row" id="file_pdf">
                <label for="file_pdf" class="col-sm-2 col-form-label">Upload PDF</label>
                <div class="col-md-5 col-12">
                  <input type="file" name="file_pdf" class="form-control @if($errors->has('file_pdf')) is-invalid @endif" value="{{ request()->old('file_pdf') }}">
                  <div class="invalid-feedback">{{ $errors->first('file_pdf') }}</div>
                </div>
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
  <script type="text/javascript">
    $(window).scroll(function() {
      if($(this).scrollTop() > window.innerHeight*1.05)
      {
          $('.author-custom > h5').text('Authors');
      } else {
          $('.author-custom > h5').text('Author #1');
      }
    });
      
    function showLinkInput() {
      $('#file_link').show();
      $('#file_pdf').hide();
    }

    function showPdfInput() {
      $('#file_link').hide();
      $('#file_pdf').show();
    }

    function toggleInput(index) {
      var inputOther = $('#inputOther'+index)
      var radioOther = $('#radioOther'+index)

      if (radioOther.is(':checked')) {
        inputOther.attr("disabled", false)
        inputOther.focus()
      } else {
        inputOther.attr("disabled", "disabled")
        inputOther.val('')
      }
    }

    var affiliations = [];
    var index = 1

    function addAuthor() {
      var lastInput = $('#inputOther'+index).val();
      index++

      if (affiliations.indexOf(lastInput) == -1 && lastInput != '' && lastInput != undefined) {
        affiliations.push(lastInput);
      }

      $('#cardBody').append('<div class="form-separator mt-4 bg-white authors'+index+'"><div class="d-flex justify-content-between align-items-baseline"><h5 >Author #'+index+'</h5><button type="button" class="close" aria-label="Close" onclick="deleteAuthor('+index+')"><span aria-hidden="true">&times;</span></button></div></div><div class="form-group row authors'+index+'"><label for="name" class="col-sm-2 col-form-label">Name</label><div class="col-md-5 col-12"><input type="text" name="authors['+index+'][name]" class="form-control"></div><div class="col-md-3 mt-md-2 mt-4"><div class="form-check"><input type="checkbox" class="form-check-input" id="checkbox'+index+'" onclick="toggleCorresponding('+index+')"><label class="form-check-label">Corresponding Author </label></div></div></div><div class="form-group row authors'+index+'" id="email_form'+index+'" style="display: none;"><label for="email" class="col-sm-2 col-form-label">Email</label><div class="col-md-5 col-12"><input type="email" name="authors['+index+'][email]" class="form-control"></div></div><div class="form-group row authors'+index+'"><label for="affiliation" class="col-sm-2 col-form-label">Affiliation</label><div class="col-sm-10" id="affiliationsGroup'+index+'"></div></div>')

      function appendItems(item, key) {
        $('#affiliationsGroup'+index).append('<div class="form-check mb-2"><input class="form-check-input" onChange="toggleInput('+index+')" name="authors['+index+'][affiliation]" type="radio" value="'+item+'" id="check'+index+'"><label class="form-check-label" for="check'+index+'">'+item+'</label></div>');
      }

      affiliations.forEach(appendItems)
      $('#affiliationsGroup'+index).append('<div class="form-check"><input class="form-check-input" name="authors['+index+'][affiliation]" type="radio" id="radioOther'+index+'" onChange="toggleInput('+index+')"><label class="form-check-label" for="radioOther'+index+'">Other<input type="text" placeholder="Other" name="authors['+index+'][affiliation]" class="form-control mt-2" id="inputOther'+index+'" disabled="true"></label></div>');
  }

  function toggleCorresponding(id){
    $("#email_form"+id).toggle();
  }

  function deleteAuthor(id){
    $(".authors"+id).remove();
  }
</script>
  {{-- INITIALIZE TEXT EDITOR. INCLUDE THIS FOR EVERY FORM THAT NEED TEXT EDITOR --}}
  @include('layouts.summernote')
@endsection
