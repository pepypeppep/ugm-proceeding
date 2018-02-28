<div class="tab-pane fade @if(request('tab') == 'authors') {{ 'show active' }} @endif" id="nav-authors" role="tabpanel" aria-labelledby="nav-authors-tab">
  <!-- ARTICLES -->
  <section class="body pb-5">
    <div class="row pt-3 justify-content-end">
      <div class="col-md-2">
        <button data-toggle="modal" data-target="#addAuthorModal" class="btn btn-primary btn-block"><i class="fa fa-plus fa-fw mr-2"></i>Add Author</button>
      </div>
    </div>
    <div class="row pt-3">
      <div class="col-md-12">
        <div class="mb-3">  
          <div class="card article-card">
            <div class="card-body">
              @empty ($book->data['authors'])
                <div class="mx-3 my-4 text-center">
                  <h4>This book doesn't have any authors.</h4>
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
  {{-- ADD AUTHOR MODAL --}}
  <div class="modal"  id="addAuthorModal" tabindex="-1" role="dialog" aria-labelledby="addAuthorModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Author</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('book.store.author', $book->id) }}" method="POST">
          {{ csrf_field() }}
          <div class="modal-body">
            <div class="form-group">
              <label class="form-label">Author email</label>
              <input required type="email" name="user_email" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
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
