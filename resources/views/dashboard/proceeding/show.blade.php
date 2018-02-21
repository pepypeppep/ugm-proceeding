@extends('dashboard.layouts.master')

@section('title', 'Proceedings Details')
    
@section('header')
  <section class="header py-5">
    <div class="row justify-content-between">
      <div class="col-md-9 mb-3 mb-md-0">
        <h2 class="m-0">{{ $proceeding->name }}</h2>
        <h3><span class="badge badge-{{ $proceeding->getStatusColor($proceeding->status) }}">{{ $proceeding->status }}</span></h3>
        <span class="text-muted">{{ $proceeding->alias }}, {{ $proceeding->date['conference_start'] }}, {{ $proceeding->location }}</span>
      </div>
      <div class="col-md-3">
        <div class="d-inline float-right">
          <a class="btn btn-primary" href="{{ route('proceeding.edit', [$proceeding->id]) }}" >Edit proceeding details</a>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <section class="body pb-5">
    <!-- NAV TAB -->
    <nav class="nav nav-tabs scrollable-nav" id="myTab" role="tablist">
      <a class="nav-item nav-link @if(request('tab') == 'overview' || request('tab') == null) active @endif" id="nav-overview-tab" data-toggle="tab" href="#nav-overview" role="tab" aria-controls="nav-overview" aria-selected="true">Overview</a>
      <a class="nav-item nav-link @if(request('tab') == 'details') active @endif" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Details</a>
      <a class="nav-item nav-link @if(request('tab') == 'articles') active @endif" id="nav-articles-tab" data-toggle="tab" href="#nav-articles" role="tab" aria-controls="nav-articles" aria-selected="false">Articles &nbsp;<span class="badge badge-secondary">{{ $proceeding->total_articles }}</span></a>
    </nav> 
    <!-- NAV TAB CONTENTS -->
    <div class="tab-content" id="nav-tabContent">
      <!-- Overview -->
      @include('dashboard.proceeding.tab-overview')
      <!-- DETAILS TAB -->
      @include('dashboard.proceeding.tab-details')
      <!-- TAB PANE ARTICLES LIST -->
      @include('dashboard.proceeding.tab-articles')
    </div>
  </section>
@endsection

@section('script')
  <script type="text/javascript">
    function deleteSubjects(id, name) {
      $('#deleteSubjectId').attr('value', id);
      $('#subjectName').html(name);
      $('#deleteSubjectModal').modal()
    }
  </script>
@endsection
