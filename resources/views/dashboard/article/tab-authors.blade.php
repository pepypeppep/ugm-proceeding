<div class="tab-pane fade @if(request('tab') == 'authors') {{ 'show active' }} @endif" id="nav-authors" role="tabpanel" aria-labelledby="nav-authors-tab">
  <!-- ARTICLES -->
  <section class="body pb-5">
    <div class="row pt-4">
      <div class="col-md-8">
        <div class="mb-3">
          <h4 class="text-primary">Authors info</h4>
          <div class="card article-card">
            <div class="card-body">
              @foreach($article->data['authors'] as $no => $author)
              <div class="row justify-content-between">
                <div class="col-lg-7 paper-info d-flex">
                  <i class="far fa-user fa-2x p-3"></i>
                  <p class="m-0 pl-2">
                    <a href="" class="text-primary"><b>{{ $author['name'] }}</b></a> <br>
                    Affiliation : <span class="badge badge-secondary">{{ $no+1 }}</span><br>
                    <span class="text-muted">Email : {{ $author['email'] }}</span>
                  </p>
                </div>
                <div class="col-lg-1">
                  @empty ($author['email'])
                    <span class="badge badge-secondary">Not Correspondence</span>
                  @else
                    <span class="badge badge-primary">Correspondence</span>
                  @endempty
                </div>
                <div class="col action text-right">
                  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a type="button" href="" class="btn btn-outline-secondary">Edit</a>
                    <a type="button" href="" class="btn btn-outline-secondary">Delete</a>
                  </div>
                </div>
              </div>  
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="mb-3">
          <h4 class="text-primary">Affiliation list</h4>
          <div class="card">
            <div class="card-body">
              @foreach($article->data['authors'] as $no => $author)
              <span>{{ $no+1 }}.&emsp;{{ $author['affiliation'] }}</span><br>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
