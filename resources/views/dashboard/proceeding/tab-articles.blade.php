<div class="tab-pane fade  @if(request('tab') == 'articles') {{ 'show active' }} @endif" id="nav-articles" role="tabpanel" aria-labelledby="nav-articles-tab">
  <div class="row pt-4">
    <div class="col-md-5 mb-2">
      <form class="form-inline" method="GET" action="/proceedings/{{ $proceeding->id }}">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for..." value="{{ request('keyword') }}" name="keyword">
          <div class="input-group-prepend">
            <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
        <input type="hidden" name="tab" value="articles">
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
      <a class="btn btn-block btn-primary" href="{{ route('article.create', ['proceeding' => $proceeding->id]) }}"><i class="fa fa-plus fa-fw mr-2"></i>Create New Article</a>
    </div>
  </div>
  <hr>
  <!-- ARTICLES LIST -->
  @if ($proceeding->total_articles == 0)
    <div class="text-center py-4">
      <i class="far fa-file-alt fa-5x mb-3"></i>
      <h2>This proceeding has no articles</h2>
      <h5 style="font-weight: 300">Go add a new one!</h5>
    </div>
  @else
    @if (!empty($proceeding->articles->first()))
      @foreach ($proceeding->articles as $article)
        <div class="row article-item">
          <div class="col-md-8">
            <h5 class="text-primary m-0">{{ $article['title'] }}</h5>
            <span class="text-muted">
              {{ collect($article['authors'])->implode('name','; ') }}
            <br><small>Last updated: {{ \Carbon\Carbon::parse($article['updated_at'])->diffForHumans() }}</small></span>
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
        <img src="/img/ilustrations/empty-search.svg" style="height: 250px" class="img-fluid">
        <h2>No records found</h2>
        <h5 style="font-weight: 300">Please try again with different keywords</h5>
      </div>
    @endif
  @endif
</div>