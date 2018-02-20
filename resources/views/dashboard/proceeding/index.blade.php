@extends('dashboard.layouts.master')

@section('title', 'Proceedings Management')

@section('header')
  <section class="header py-5">
    <div class="row justify-content-between">
      <div class="col-md-6 mb-3 mb-md-0">
        <h2>Proceedings Management</h2>
      </div>
      <div class="col-md-2">
        <a class="btn btn-block btn-primary" href="{{ route('proceeding.create') }}" >Create new proceeding</a>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <section class="body pb-5">
    <div class="row">
      <!-- SIDEBAR -->
      @include('dashboard.proceeding.sidebar')

      <!-- SEARCH AND SORT -->
      <div class="col-md-10 pl-lg-5">
        <form class="form-inline mb-3" method="GET" action="{{ request()->fullUrl() }}">
          <div class="input-group  mb-2 mb-md-0 mr-sm-3">
            <input class="form-control" value="{{ request('keyword') }}" type="search" name="keyword" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
            </div>
          </div> 
          @foreach (request()->only('tab') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
          @endforeach
          <div class="input-group ml-sm-auto">
            <select class="custom-select mb-2 mb-sm-0" id="sortSelect" name="sort" onchange="this.form.submit()">
              <option value="">Sort by...</option>
              <option value="name.asc" @if(request('sort') == 'name.asc') selected @endif>Name A-Z</option>
              <option value="name.desc" @if(request('sort') == 'name.desc') selected @endif>Name Z-A</option>
              <option value="updated_at.desc" @if(request('sort') == 'updated_at.desc') selected @endif>Last updated</option>
              <option value="created_at.asc" @if(request('sort') == 'created_at.asc') selected @endif>Oldest</option>
              <option value="created_at.desc" @if(request('sort') == 'created_at.desc') selected @endif>Newest</option>
            </select>
          </div>
        </form>
        <!-- SMALL DEVICES MENU -->
        @include('dashboard.proceeding.small-nav')

        <!-- PROCEEDING LIST -->
        <div class="card article-card">
          <div class="card-body">
            @if (!empty($proceedings->data->first()))
              @foreach ($proceedings->data as $proceeding)
                <div class="row justify-content-between">
                  <div class="col-lg-8 paper-info d-flex">
                    <i class="far fa-file-alt fa-2x p-3"></i>
                    <p class="m-0 pl-2">
                      <a href="{{ route('proceeding.show', [$proceeding['id']]) }}" class="text-primary"><b>{{ $proceeding['name'] }}</b></a> <br>
                      {{ $proceeding['date']['conference_start'] }}, {{ $proceeding['location'] }}. <br>
                      <span class="text-muted">Last updated: {{ \Carbon\Carbon::parse($proceeding['updated_at'])->diffForHumans() }}</span>
                    </p>
                  </div>
                  <div class="col-lg-1 text-right">
                    <span class="badge badge-secondary">{{ $proceeding['status'] }}</span>
                  </div>
                  <div class="col action text-right">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                      <a type="button" href="{{ route('proceeding.show', [$proceeding['id']]) }}" class="btn btn-outline-secondary">View</a>
                      <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                          <a class="dropdown-item" href="#">Trash</a>
                          <a class="dropdown-item" href="#">Metrics</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @if (!$loop->last)
                  <hr>
                @endif
              @endforeach
            @else
              <div class="text-center py-4">
                <img src="/img/ilustrations/empty-search.svg" style="height: 250px" class="img-fluid">
                <h2>No records found</h2>
                <h5 style="font-weight: 300">Please try again with different keywords</h5>
              </div>
            @endif            
            <!-- END OF ITEM -->
          </div>
        </div>
        @include('layouts.pagination', ['response' => $proceedings])
      </div>
    </div>
  </section>
@endsection
