<section class="px-3 py-5 bg-white pb-3">
  <div class="row justify-content-between">
    <div class="col-lg-10">
      <div class="d-flex align-items-center">
        <i class="far fa-file-alt fa-fw" style="font-size: 2rem"></i>
        <h5 class="m-0 pl-3">This proceeding is ready to publish! <br> <small class="text-muted">Draft proceeding</small></h5>
      </div>
    </div>
    <div class="col-lg-2 pt-md-0 pt-2">
      <div class="d-inline float-right">
        <button class="btn btn-sm btn-primary">Publish now</button>
      </div>
    </div>
  </div>
</section>
<section class="body pb-3">
  <div class="card">
    <div class="card-body">
      <div class="row bordered-bottom justify-content-between pb-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Introduction text</h4>
              <span class="text-muted">{{ substr($proceeding->introduction, 0, 200) }}...</span>
            </div>
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <button class="btn btn-sm">Edit introduction</button>
          </div>
        </div>
      </div>
      <div class="row bordered-bottom justify-content-between py-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Identifiers</h4>
              @foreach ($proceeding->identifiers as $identifier)
                <span class="text-muted">{{ $identifier['type'] }}: {{ $identifier['id'] }}</span>
                @if (!$loop->last)
                  <br>
                @endif
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <button class="btn btn-sm">Edit identifiers</button>
          </div>
        </div>
      </div>
      <div class="row bordered-bottom justify-content-between py-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Subjects</h4>
              <span class="text-muted">{{ $proceeding->subjects->pluck('name')->implode(", ") }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <button class="btn btn-sm">Edit subjects</button>
          </div>
        </div>
      </div>
      <div class="row bordered-bottom justify-content-between py-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Cover</h4>
              <img src="https://lorempixel.com/344/550/technics/?77326" class="img-fluid mt-3" width="200px">
            </div>
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <button class="btn btn-sm">Edit cover</button>
          </div>
        </div>
      </div>
      <div class="row justify-content-between py-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Articles</h4>
              <span class="text-muted">
                {{ $proceeding->articles->where('indexed', true)->count() }} articles indexed in Scopus <br>
                {{ $proceeding->articles->where('indexed', false)->count() }} articles are not indexed <br>
                {{ $proceeding->articles->pluck('authors')->map(function ($item)
                {
                  return collect($item)->count();
                })->sum() }} total authors
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <button class="btn btn-sm">Add more articles</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
