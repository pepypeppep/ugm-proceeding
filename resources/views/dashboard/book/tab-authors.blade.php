<div class="tab-pane fade @if(request('tab') == 'authors') {{ 'show active' }} @endif" id="nav-authors" role="tabpanel" aria-labelledby="nav-authors-tab">
  <!-- ARTICLES -->
  <section class="body pb-5">
    <div class="row pt-3">
      <div class="col">
        <button class="btn btn-primary float-right"><i class="fa fa-plus fa-fw"></i>Add Author</button>
      </div>
    </div>
    <div class="row pt-3">
      <div class="col-md-12">
        <div class="mb-3">  
          <div class="card article-card">
            <div class="card-body">
              @empty ($book->data['authors'])
                <div class="mx-3 my-4 text-center">
                  <h4>This Book doesn't have any authors.</h4>
                  <span>Please add one by clicking the Add Author Button.</span> <br>
                </div>
              @else
                @foreach($book->data['authors'] as $author)
                  <div id="fields{{ $author['id'] }}" class="row justify-content-between">
                    <div class="col-lg-7 paper-info d-flex">
                      <i class="far fa-user fa-2x p-3"></i>
                      <p class="m-0 pl-2">
                        <a href="" class="text-primary"><b>{{ $author['name'] }}</b></a> <br>
                        Affiliation : <span class="">{{ $author['affiliation'] }}</span><br>
                        <span class="text-muted">Email : {{ $author['email'] }}</span>
                      </p> 
                    </div>
                    <div class="col text-right">
                      <div class="btn-group" role="group">
                        <a type="button" href="#" onclick="showForm({{ $author['id'] }})" class="btn btn-outline-secondary">Edit</a>
                        <a type="button" href="" class="btn btn-outline-secondary">Delete</a>
                      </div>
                    </div>
                  </div>  
                @endforeach
              @endempty
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
    function cancelForm(id) {
      $('#form'+id).hide();
      $('#fields'+id).show();
    }
  </script>
@endsection
