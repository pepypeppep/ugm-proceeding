<div class="tab-pane fade  @if(request('tab') == 'details') {{ 'show active' }} @endif" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
  <div class="row pt-4">
    <div class="col-md-3 mb-4">
      <div class="sticky-top sticky-nav">
        <h4 class="text-primary">Cover image</h4>
        @if (empty($proceeding->data['front_cover']))
          <div class="text-center text-muted py-5">
            <i class="fa fa-camera fa-4x"></i> <br>
            <span>No image available</span>
          </div>
        @else
          <img src="{{ $proceeding->front_cover }}" class="rounded img-fluid mb-3">
        @endif
        <label class="btn btn-primary btn-block btn-file">
          Upload cover 
          <form id="changeCoverForm" method="POST" action="{{ route('proceeding.cover', [$proceeding->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="front_cover" style="display: none;" onchange="this.form.submit()">
          </form>
        </label>
      </div>
    </div>
    <div class="col-md-9">
      <div class="mb-4">
        <h4 class="text-primary">Introduction</h4>
        @empty ($proceeding->data['introduction'])
          <div class="">
            {{-- <span class="text-muted">This proceeding has no introduction yet. You can create a introduction text by clicking button below.</span> <br> --}}
            <a class="btn btn-sm btn-outline-primary" href="{{ route('proceeding.edit', [$proceeding->id, 'focus' => 'introduction']) }}">Add introduction text</a>
          </div>
        @else
          {!! $proceeding->introduction !!}
        @endempty
      </div>
      <div class="mb-4">
        <h4 class="text-primary mb-2">Subject area</h4>
        @foreach ($proceeding->subjects as $subject)
          <div class="chip mr-2 mb-2">
            {{ $subject['name'] }}
            <input type="hidden" name="subject_id[{{ $loop->index }}]" value="{{ $subject['id'] }}">
            <span class="closebtn" onclick="deleteSubjects({{ $subject['id'] }}, '{{ $subject['name'] }}')">&times;</span>
          </div> 
        @endforeach
        <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addSubjectModal">Add subject</button>

        {{-- ADD SUBECT MODAL --}}
        <div class="modal"  id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Select one or more subjects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('proceeding.update.subjects', [$proceeding->id]) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                  <div class="form-group">
                    @foreach ($subjects as $subject)
                      <div class="form-check">
                        <input class="form-check-input" name="subject_id[{{ $loop->index }}]" type="checkbox" value="{{ $subject['id'] }}" id="subjectCheck{{ $loop->index }}">
                        <label class="form-check-label" for="defaultCheck1">
                          {{ $subject['name'] }}
                        </label>
                      </div>
                    @endforeach
                    <input type="hidden" name="action" value="attach">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Add subject(s)</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        {{-- END ADD SUBJECT MODAL --}}

        {{-- DELETE SUBJECT MODAL --}}
        <div class="modal"  id="deleteSubjectModal" tabindex="-1" role="dialog" aria-labelledby="deleteSubjectModal" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><b>Delete subject</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="deleteSubjectForm" action="{{ route('proceeding.update.subjects', [$proceeding->id]) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="subject_id[0]" id="deleteSubjectId" value="">
                <input type="hidden" name="action" value="detach">
                <div class="modal-body">
                  <b id="subjectName"></b> subject will be removed from {{ $proceeding->name }}. <br> It can be added again later.
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Delete</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        {{-- END OF DELETE SUBJECT MODAL --}}
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
              <td>{{ $proceeding->created_at }}</td>
            </tr>
            @foreach($proceeding->identifiers as $identifier)
              <tr>
                <th class="w-25">{{ $identifier['type'] }}</th>
                <td>{{ $identifier['code'] }}</td>
              </tr>
            @endforeach
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
