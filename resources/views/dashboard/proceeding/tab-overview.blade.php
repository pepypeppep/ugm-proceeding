<div class="tab-pane fade  @if(request('tab') == 'overview' || request('tab') == null) {{ 'show active' }} @endif" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
  @if ($proceeding->status == 'draft')
    @include('dashboard.proceeding.tab-content-publish')
  @else
    @include('dashboard.proceeding.tab-content-overview')
  @endif
</div>
