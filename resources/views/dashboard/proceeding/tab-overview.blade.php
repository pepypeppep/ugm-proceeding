<div class="tab-pane fade  @if(request('tab') == 'overview' || request('tab') == null) {{ 'show active' }} @endif" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
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
          <i class="far fa-file-alt fa-2x text-primary"></i>
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
              <a href="{{ route('article.show', [$article['id']]) }}">{{ $article['title'] }}</a> <br> <span class="text-muted d-none d-md-block">{{ collect($article['authors'])->implode('name','; ') }}</span>
            </td>
            <td>35 views</td>
          </tr>
        @endforeach
      </tbody>
      </table>
    </div>
  </div>  
</div>
