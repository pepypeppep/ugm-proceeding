@extends('dashboard.layouts.master')

@section('title', 'Proceedings Details')
    
@section('header')
  <section class="header py-5">
    <div class="row justify-content-between">
      <div class="col-md-12 mb-3 mb-md-0">
        <h3><span class="badge badge-secondary">{{ $proceeding->status }}</span></h3>
        <h2 class="m-0">{{ $proceeding->name }}</h2>
        <span class="text-muted">{{ $proceeding->alias }}, {{ $proceeding->date['conference_start'] }}, {{ $proceeding->location }}</span>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <section class="body pb-5">
    <!-- NAV TAB -->
    <nav class="nav nav-tabs scrollable-nav" id="myTab" role="tablist">
      <a class="nav-item nav-link active" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab" aria-controls="nav-overview" aria-selected="true">Overview</a>
      <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Details</a>
      <a class="nav-item nav-link" id="nav-articles-tab" data-toggle="tab" href="#nav-articles" role="tab" aria-controls="nav-articles" aria-selected="false">Articles</a>
    </nav>
    <!-- NAV TAB CONTENTS -->
    <div class="tab-content" id="nav-tabContent">
      <!-- Overview -->
      <div class="tab-pane fade show active" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
        <!-- TOTAL STATS -->
        <div class="row py-4">
          <div class="col-md">
            <div class="card mb-3 mb-md-0">
              <div class="card-body text-center">
                <i class="fa fa-download fa-2x text-primary"></i>
                <h3 class="text-primary m-0"><b>{{ $proceeding->articles->sum('downloads') }}</b></h3>
                <span>Downloads</span>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card mb-3 mb-md-0">
              <div class="card-body text-center">
                <i class="fa fa-eye fa-2x text-primary"></i>
                <h3 class="text-primary m-0"><b>{{ $proceeding->articles->sum('views') }}</b></h3>
                <span>Views</span>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-body text-center">
                <i class="fa fa-file-text-o fa-2x text-primary"></i>
                <h3 class="text-primary m-0"><b>{{ $proceeding->articles->count() }}</b></h3>
                <span>Articles</span>
              </div>
            </div>
          </div>
        </div>
        <!-- TOP VIEWED -->
        <div class="row py-4">
          <div class="col">
            <h4>Top viewed articles</h4>
            <table class="table m-0 table-hover">
              <tbody>
              @foreach($proceeding->articles->sortBy('views')->take(3) as $article)
                <tr>
                  <td>{{ $loop->index+1 }}</td>
                  <td>
                    <a href="#">{{ $article['title'] }}</a> <br> <span class="text-muted d-none d-md-block">{{ collect($article['authors'])->implode('name','; ') }}</span>
                  </td>
                  <td>35 views</td>
                </tr>
              @endforeach
            </tbody>
            </table>
          </div>
        </div>  
      </div>
      <!-- DETAILS TAB -->
      <div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
        <div class="row pt-4">
          <div class="col-md-3 mb-4">
            <div class="sticky-top sticky-nav">
              <h4 class="text-primary">Cover image</h4>
              <img src="{{ $proceeding->front_cover }}" class="rounded img-fluid">
              <button class="btn btn-primary btn-block mt-3">Upload image</button>
            </div>
          </div>
          <div class="col-md-9">
            <div class="mb-3">
              <h4 class="text-primary">Conference Name</h4>
              {{ $proceeding->name }}
            </div>
            <div class="mb-3">
              <h4 class="text-primary">Introduction</h4>
              {{ $proceeding->introduction }}
            </div>
            <div class="mb-3">
              <h4 class="text-primary">Conference info</h4>
              <table class="table">
                <tbody>
                  <tr>
                    <th class="w-25">Conference date</th>
                    <td>{{ $proceeding->date['conference_start'] }}&ndash;{{ $proceeding->date['conference_end'] }}</td>
                  </tr>
                  <tr>
                    <th class="w-25">Location</th>
                    <td>{{ $proceeding->location }}</td>
                  </tr>
                  <tr>
                    <th class="w-25">Added to Online Library</th>
                    <td>{{ $proceeding->articles->first()['date_added'] }}</td>
                  </tr>
                  <tr>
                    @foreach($proceeding->identifiers as $identifier)
                      <th class="w-25">Electronic {{ $identifier['type'] }}</th>
                      <td>{{ $identifier['id'] }}</td>
                    @endforeach
                  </tr>
                  <tr>
                    <th class="w-25">Proceeding status</th>
                    <td>{{ $proceeding->status }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- TAB PANE ARTICLES LIST -->
      <div class="tab-pane fade show " id="nav-articles" role="tabpanel" aria-labelledby="nav-articles-tab">
        <div class="row pt-4">
          <div class="col-md-5 mb-2">
            <form class="form-inline" method="GET" action="/proceedings/{{ $proceeding->id }}">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for..." value="{{ request('keyword') }}" name="keyword">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                </span>
              </div>
              <div class="input-group ml-md-4 ml-0 mt-2 mt-md-0">
                <select class="custom-select" id="inlineFormCustomSelect" name="sort" onchange="this.form.submit()">
                  <option value="title.asc" @if(request('sort') == 'title.asc') selected @endif>Title A~Z</option>
                  <option value="title.desc" @if(request('sort') == 'title.desc') selected @endif>Title Z~A</option>
                  <option value="updated_at.desc" @if(request('sort') == 'updated_at.desc') selected @endif>Last updated</option>
                  <option value="created_at.asc" @if(request('sort') == 'created_at.asc') selected @endif>Oldest</option>
                  <option value="created_at.desc" @if(request('sort') == 'created_at.desc') selected @endif>Newest</option>
                </select>
              </div>
            </form>
          </div>
          <div class="col-md-2 ml-auto mb-2 order-first order-md-3">
            <a class="btn btn-block btn-primary" href="{{ route('article.create', ['proceeding' => $proceeding->id]) }}"><i class="fa fa-plus fa-fw mr-2"></i>Add New Article</a>
          </div>
        </div>
        <hr>
        <!-- ARTICLES LIST -->
        @if (!empty($proceeding->articles))
          @foreach ($proceeding->articles as $article)
            <div class="row article-item">
              <div class="col-md-8">
                <h5 class="text-primary m-0">{{ $article['title'] }}</h5>
                <span class="text-muted">
                    {{ collect($article['authors'])->implode('name','; ') }}
                <br><small>Last updated: 5 hours ago</small></span>
              </div>
              <div class="col-md-2 pt-2 pt-md-0">
                <div class="d-flex">
                  <span class="mr-4">{{ $article['views'] }}<br>views</span>
                  <span>{{ $article['downloads'] }}<br>Downloads</span>
                </div>
              </div>
              <div class="col-md-2 text-right pt-2 pt-md-0">
                <div class="btn-group w-100" role="group" aria-label="Button group with nested dropdown">
                  <button type="button" class="btn btn-outline-secondary w-100">View</button>
                  <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                      <a class="dropdown-item" href="#">Trash</a>
                      <a class="dropdown-item" href="#">Metrics</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @if (!$loop->last)
              <hr>
            @endif
          @endforeach
        @else
          <div class="text-center py-4">
            <i class="fa fa-file-text-o fa-5x p-3"></i>
            <h2>No records found</h2>
            <h5 style="font-weight: 300">Please try again with different keywords or status</h5>
          </div>
        @endif
      </div>
    </div>
  </section>
@endsection