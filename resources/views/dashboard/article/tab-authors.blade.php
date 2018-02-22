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
              <form action="{{ route('author.update', $author['id']) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div id="form{{ $author['id'] }}" style="display: none" class="row">
                  <div class="col-lg-10">
                    <div class="form-group row">
                      <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" name="email" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
                      </div>
                    </div>
                  </div>
                  <div class="col text-right">
                    <button class="btn btn-success" type="submit">Save</button>
                  </div>
                </div>
              </form>
              <div id="fields{{ $author['id'] }}" class="row justify-content-between">
                <div class="col-lg-7 paper-info d-flex">
                  <i class="far fa-user fa-2x p-3"></i>
                  <p class="m-0 pl-2">
                    <a href="" class="text-primary"><b>{{ $author['name'] }}</b></a> <br>
                    Affiliation : <span class="">{{ $author['affiliation'] }}</span><br>
                    <span class="text-muted">Email : {{ $author['email'] }}</span>
                  </p> 
                </div>
                <div class="col action text-right">
                  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a type="button" href="#" onclick="showForm({{ $author['id'] }})" class="btn btn-outline-secondary">Edit</a>
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

@section('script')
  <script type="text/javascript">
    function showForm(id) {
      $('#fields'+id).hide();
      $('#form'+id).show();
    }
  </script>
@endsection
