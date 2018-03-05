<section class="px-3 py-5 bg-white pb-3">
  <div class="row justify-content-between">
    @if ($errors->has('proceeding_id'))
    <div class="col-lg-10">
      <div class="d-flex align-items-center">
        <i class="fas fa-exclamation-circle fa-fw text-danger" style="font-size: 2rem"></i>
        <h5 class="m-0 pl-3">Sorry, you can't publish this proceeding yet. Please fix the problem below: <br> <small class="">{{ $errors->first('proceeding_id') }}</small></h5>
      </div>
    </div>
    @elseif ($proceeding->readyToPublish($proceeding))
    <div class="col-lg-10">
      <div class="d-flex align-items-center">
        <i class="far fa-file-alt fa-fw" style="font-size: 2rem"></i>
        <h5 class="m-0 pl-3">This proceeding is ready to publish! <br> <small>Draft proceeding</small></h5>
      </div>
    </div>
    <div class="col-lg-2 pt-md-0 pt-2">
      <div class="d-inline float-right">
        <!-- The Modal -->
        <div class="modal fade" id="publish_confirmation_modal">
          <div class="modal-dialog" style="margin-top: 260.5px;">
            <div class="modal-content col-3 col-md-12">
              <form action="{{ route('proceeding.publish') }}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="proceeding_id" value="{{ $proceeding->id }}">
              <div class="modal-header">
                <h4 class="modal-title">Publish proceeding?</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <h5>Total Articles : {{ $proceeding->articles->count() }} </h5>
                <span>*If proceedings have been published, articles can't be changed</span>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Publish</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </form>
            </div>
          </div>
        </div>
        {{-- <form action="{{ route('proceeding.publish') }}" method="POST">
          {{ csrf_field() }} --}}
          <input type="hidden" name="proceeding_id" value="{{ $proceeding->id }}">
          <button type="button" class="btn btn-sm btn-primary" onclick="confirmPublish()">Publish now</button>
        {{-- </form> --}}
      </div>
    </div>
    @else
    <div class="col-lg-10">
      <div class="d-flex align-items-center">
        <i class="fas fa-exclamation-circle fa-fw" style="font-size: 2rem"></i>
        <h5 class="m-0 pl-3">This proceeding is not ready to publish! <br> <small>Please complete these fields below</small></h5>
      </div>
    </div>
    @endif
    
  </div>
</section>
<section class="body pb-3">
  <div class="card">
    <div class="card-body">
      <div class="row bordered-bottom justify-content-between pb-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            @empty($proceeding->data['introduction'])
            <i class="fas fa-times-circle fa-2x fa-fw text-danger"></i>
            <div class="pl-3">
              <h4 class="m-0">Introduction text</h4>
              <span>The introduction text is not available. You can add it by clicking Edit Introduction Button</span>
            </div>
            @else
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Introduction text</h4>
              <span>{!! substr($proceeding->introduction, 0, 200) !!}...</span>
            </div>
            @endisset
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <a href="{{ route('proceeding.edit', $proceeding->id) }}" class="btn btn-sm bg-light">Edit introduction</a>
          </div>
        </div>
      </div>
      <div class="row bordered-bottom justify-content-between py-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            @empty ($proceeding->data['identifiers'])
            <i class="fas fa-times-circle fa-2x fa-fw text-danger"></i>
            <div class="pl-3">
              <h4 class="m-0">Identifiers</h4>
              <span>We can find any identifiers on this proceeding. Please add some identifiers by clicking the next button</span>
            </div>
            @else
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Identifiers</h4>
              @foreach ($proceeding->identifiers as $identifier)
              <span>{{ $identifier['type'] }}: {{ $identifier['code'] }}</span>
              @if (!$loop->last)
              <br>
              @endif
              @endforeach
            </div>
            @endempty
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <a href="{{ route('proceeding.edit', $proceeding->id) }}" class="btn btn-sm bg-light">Edit identifiers</a>
          </div>
        </div>
      </div>
      <div class="row bordered-bottom justify-content-between py-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            @empty ($proceeding->data['subjects'])
            <i class="fas fa-times-circle fa-2x fa-fw text-danger"></i>
            <div class="pl-3">
              <h4 class="m-0">Subjects</h4>
              <span>This proceeding doesn't have any subjects. Please add one by clicking the next button</span>
            </div>
            @else
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Subjects</h4>
              <span>{{ $proceeding->subjects->pluck('name')->implode(", ") }}</span>
            </div>
            @endempty
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <a href="{{ route('proceeding.show', [$proceeding->id, 'tab' => 'details']) }}" class="btn btn-sm bg-light">Add subjects</a>
          </div>
        </div>
      </div>
      <div class="row bordered-bottom justify-content-between py-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            @empty ($proceeding->data['front_cover'])
            <i class="fas fa-times-circle fa-2x fa-fw text-danger"></i>
            <div class="pl-3">
              <h4 class="m-0">Cover</h4>
              <span>You haven't add a cover for this proceeding. Add one by clicking Edit cover button</span>
            </div>
            @else
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Cover</h4>
              <img src="https://lorempixel.com/344/550/technics/?77326" class="img-fluid mt-3" width="200px">
            </div>
            @endempty
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <a href="{{ route('proceeding.show', [$proceeding->id, 'tab' => 'details']) }}" class="btn btn-sm bg-light">Add cover</a>
          </div>
        </div>
      </div>
      <div class="row justify-content-between py-4">
        <div class="col-md-10">
          <div class="d-flex align-items-start">
            @empty ($proceeding->data['articles'])
            <i class="fas fa-times-circle fa-2x fa-fw text-danger"></i>
            <div class="pl-3">
              <h4 class="m-0">Articles</h4>
              <span>This proceeding has no article. Add an article by clicking Add More Articles button</span>
            </div>
            @else
            <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
            <div class="pl-3">
              <h4 class="m-0">Articles</h4>
              <span>
                {{ $proceeding->articles->where('indexed', true)->count() }} articles indexed in Scopus <br>
                {{ $proceeding->articles->where('indexed', false)->count() }} articles are not indexed
              </span>
            </div>
            @endempty
          </div>
        </div>
        <div class="col-md-1 pt-md-0 pt-3">
          <div class="d-inline float-right">
            <a href="{{ route('article.create', [$proceeding->id]) }}" class="btn btn-sm bg-light">Add article</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function confirmPublish() {
  //Say - $('p').get(0).id - this delete item id
  //$("#delete_item_id").val( $('p').get(0).id );
  $('#publish_confirmation_modal').modal('show');
}
</script>
