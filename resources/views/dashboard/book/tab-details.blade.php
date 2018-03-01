<div class="tab-pane fade @if(request('tab') == 'details') {{ 'show active' }} @endif" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
  <div class="row pt-4">
    <div class="col-md-3 mb-4">
      <div class="sticky-top sticky-nav">
        <h4 class="text-primary">Cover image</h4>
        @if (empty($book->data['cover']))
          <div class="text-center text-muted py-5">
            <i class="fa fa-camera fa-4x"></i> <br>
            <span>No image available</span>
          </div>
        @else
          <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="rounded img-fluid mb-3">
        @endif
        <label class="btn btn-primary btn-block btn-file">
          Upload cover 
          <form id="changeCoverForm" method="POST" action="{{ route('book.store.cover', [$book->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="cover" style="display: none;" onchange="this.form.submit()">
          </form>
        </label>
      </div>
    </div>
    <div class="col-md-9">
      <div class="mb-4">
        <h4 class="text-primary">Description</h4>
        @empty ($book->data['description'])
          <div class="">
            {{-- <span class="text-muted">This proceeding has no introduction yet. You can create a introduction text by clicking button below.</span> <br> --}}
            <a class="btn btn-sm btn-outline-primary" href="{{ route('book.edit', [$book->id, 'focus' => 'decsription']) }}">Add decsription text</a>
          </div>
        @else
          {!! $book->description !!}
        @endempty
      </div>
      <div class="mb-4">
        <h4 class="text-primary">File</h4>
        @empty ($book->data['file'])
          <span class="mb-2">The file hasn't uploaded</span><br>
        @else
          <a class="btn btn-success" href="{{ $book->download }}">Download file</a>
        @endempty
        <label class="btn btn-primary btn-file m-0">
          Upload file
          <form id="changeCoverForm" method="POST" action="{{ route('book.store.file', $book->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="file" style="display: none;" onchange="this.form.submit()">
          </form>
        </label>
      </div>
    </div>
  </div>
</div>
