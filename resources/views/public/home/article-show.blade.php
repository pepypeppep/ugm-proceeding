@extends('public.layouts.master')

@section('title', 'Online Proceeding')

@section('content')
<!--article-->
  <div class="container pt-md-4">
    <section class="row mt-md-5 mh-body">
      <!--contents-->
      <div class="col-lg-9 py-3">
        <h5>{{ $article->data['title'] }}</h5>
        @foreach($article->data['authors'] as $author)
        <small class="text-primary">{{ collect($author['name'])->implode('name', '') }}<sup>{{ $author['id'] }}</sup></small>
        @endforeach
        <br>
        @foreach($article->data['authors'] as $author)
          <small><sup>{{ $author['id'] }}</sup>{{ collect($author['affiliation'])->implode('name', '') }}</small><br>
        @endforeach
        <h5 class="pt-3">Abstract</h5>
        {!! $article->data['abstract'] !!}
        <h5>Keywords</h5>
        <p>{{ $article->keywords->implode(', ') }}</p>
      </div>
      <!--details-->
      <div class="col-lg-3 py-3 d-none d-lg-block">
        <!--button-->
        <div class="list-group">
          <button type="button" class="btn list-group-item list-group-item-action"><i class="fa fa-file-pdf pr-3"></i>Download PDF</button>
          <button type="button" class="btn list-group-item list-group-item-action"><i class="fa fa-bookmark pr-3"></i>Cite this article</button>
          <button type="button" class="btn list-group-item list-group-item-action"><i class="fa fa-print pr-2"></i> Print</button>
        </div>
        <!-- information -->
        <br>
        <small><strong>Added to OnLi:</strong><br>{{ $article->data['date_added'] }}<br>
          @foreach($article->data['identifiers'] as $identifiers)
          @if($identifiers['type']=='print_isbn')<strong>{{ 'PRINT ISBN' }}</strong><br>{{ $identifiers['id'] }}<br>
            @elseif($identifiers['type']=='online_isbn')<strong>{{ 'ONLINE ISBN' }}</strong><br>{{ $identifiers['id'] }}<br>
            @else<strong>{{ 'DOI' }}</strong><br>{{ $identifiers['id'] }}<br>
          @endif
          @endforeach
          <strong>Indexed by:</strong><br>
          @if ($article->indexed)
            <a href="{{ $article->file['link'] }}">
              <img src="{{ $article->img[$article->file['type']] }}" class="img-fluid">
            </a>
            @else
            <span>PDF</span>
          @endif
        </small>
      </div>
<!-- modal -->
  <!-- askAuthor -->
      <div class="modal fade" id="askAuthor" tabindex="-1" role="dialog" aria-labelledby="askAuthorLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="askAuthorLabel">Ask author</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="inputEmail">Email address</label>
                  <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="quest">Questions</label>
                  <textarea class="form-control" placeholder="Type your questions here" id="quest" rows="3"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit" data-dismiss="modal" class="btn btn-primary">Send</button>
            </div>
          </div>
        </div>
      </div>
  <!-- shareIt -->
      <div class="modal fade" id="shareIt" tabindex="-1" role="dialog" aria-labelledby="shareItLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="shareItLabel">Share this article</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="list-group">
                <button type="button" class="list-group-item list-group-item-action border-0"><i class="fa fa-facebook pr-2"></i>Facebook</button>
                <button type="button" class="list-group-item list-group-item-action border-0"><i class="fa fa-twitter pr-2"></i>Twitter</button>
                <button type="button" class="list-group-item list-group-item-action border-0"><i class="fa fa-linkedin pr-2"></i>LinkedIn</button>
                <button type="button" class="list-group-item list-group-item-action border-0"><i class="fa fa-envelope pr-2"></i>E-mail</button>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="list-group-item list-group-item-action border-0"><i class="fa fa-link pr-2"></i>Get the link</button>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
  <!-- smaller devices nav -->
  <div>
    <ul class="nav nav-fill fixed-bottom bg-light d-lg-none py-2">
      <li class="nav-item"><a class="nav-link" href="../docs/201709.html"><i class="fa fa-chevron-left"></i></a></li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true">Page 7&ndash;12</a>
        <div class="dropdown-menu dropdown-menu-center">
          <a class="dropdown-item" href="../docs/201709.html"><h6 class="dropdown-header">ICSEAS 2017 Proceeding</h6></a>
          <a class="dropdown-item disabled"><i>Added to OnLi:</i> 21 December 2017</a>
          <a class="dropdown-item disabled"><i>eISBN:</i> 123-4-5678-9012-3</a>
          <a class="dropdown-item disabled"><i>PoD ISBN:</i> 456-7-8901-2345-6</a>
          <a class="dropdown-item disabled"><i>DOI:</i> 456-7-8901-2345-6</a>
          <a class="dropdown-item disabled"><i>Indexed by:</i> Google Scholar</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item disabled" href="#"><i class="fa fa-file-pdf pr-3"></i>Download PDF</a>
          <a class="dropdown-item disabled" href="#"><i class="fa fa-bookmark pr-3"></i>Cite this article</a>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#askAuthor"><i class="fa fa-question pr-3"></i>Ask me!</a>
          <a class="dropdown-item disabled" href="#"><i class="fa fa-print pr-2"></i> Print</a>
          <a class="dropdown-item" href="#"data-toggle="modal" data-target="#shareIt"><i class="fa fa-share-alt pr-2"></i> Share</a>
        </div>
      </li>
  </div>
@endsection
