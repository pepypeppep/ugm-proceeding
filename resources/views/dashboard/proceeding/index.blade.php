@extends('dashboard.layouts.master')

@section('title', 'Proceedings Management')

@section('header')
  <section class="header py-5">
    <div class="row justify-content-between">
      <div class="col-md-6 mb-3 mb-md-0">
        <h2>Proceedings Management</h2>
      </div>
      <div class="col-md-2">
        <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#mydaftar" >Create new proceeding</button>
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
        <form class="form-inline mb-3" method="GET">
          <input class="form-control mb-2 mb-md-0 mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
          <div class="input-group">
            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
              <option selected>Subject...</option>
              <option>Web development</option>
              <option>Microbiology</option>
              <option>Food and Nutrition</option>
            </select>
          </div>
          <div class="input-group ml-sm-auto">
            <select class="custom-select mb-2 mb-sm-0" id="inlineFormCustomSelect">
              <option selected>Sort by...</option>
              <option>Creation date</option>
              <option>Last updated</option>
            </select>
          </div>
        </form>
        <!-- SMALL DEVICES MENU -->
        @include('dashboard.proceeding.small-nav')

        <!-- ARTICLE LIST -->
        <div class="card article-card">
          <div class="card-body">
            @if (!empty($proceedings->data->first()))
              @foreach ($proceedings->data as $proceeding)
                <div class="d-md-flex flex-row justify-content-between">
                  <div class="paper-info d-flex">
                    <i class="fa fa-file-text-o fa-2x p-3"></i>
                    <p class="m-0 pl-2">
                      <a href="detail.html" class="text-primary"><b>{{ $proceeding['name'] }}</b></a> <br>
                      {{ $proceeding['date']['conference_start'] }}, {{ $proceeding['location'] }}. <br>
                      <span class="text-muted">{{ $proceeding['status'] }}</span>
                    </p>
                  </div>
                  <div class="action text-right">
                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                      <button type="button" class="btn btn-outline-secondary">View</button>
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
                <i class="fa fa-file-text-o fa-5x p-3"></i>
                <h2>No records found</h2>
                <h5 style="font-weight: 300">Please try again with different keywords or status</h5>
              </div>
            @endif            
            <!-- END OF ITEM -->
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
