@extends('dashboard.layouts.master')

@section('title', 'Book Details')
    
@section('header')
  <section class="header py-5">
    <div class="row justify-content-between">
      <div class="col-md-9 mb-3 mb-md-0">
        <h2 class="m-0">{{ $book->title }}</h2>
        {{-- <h3><span class="badge badge-{{ $proceeding->getStatusColor($proceeding->status) }}">{{ $proceeding->status }}</span></h3> --}}
      </div>
      <div class="col-md-3">
        <div class="d-inline float-right">
          <a class="btn btn-primary" href="{{ route('book.edit', [$book->id]) }}" >Edit book details</a>
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
    </nav> 
    <!-- NAV TAB CONTENTS -->
    <div class="tab-content" id="nav-tabContent">
      @include('dashboard.book.tab-details')
    </div>
  </section>
@endsection
