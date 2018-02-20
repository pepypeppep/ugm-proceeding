@extends('dashboard.layouts.master')

@section('title', 'Publish proceeding')

@section('header')
  <section class="fixed-top px-3 pt-3 bg-white pb-3 bordered-bottom" style="top: 50px; z-index: 1020">
    <div class="row justify-content-between">
      <div class="col-lg-10">
        <div class="d-flex align-items-center">
          <i class="far fa-file-alt fa-fw" style="font-size: 2rem"></i>
          <h5 class="m-0 pl-3">This proceeding is ready to publish! <br> <small class="text-muted">Draft proceeding</small></h5>
        </div>
      </div>
      <div class="col-lg-2 pt-md-0 pt-2">
        <div class="d-inline float-right">
          <button class="btn btn-sm mr-3">Cancel</button>
          <button class="btn btn-sm btn-primary">Publish now</button>
        </div>
      </div>
    </div>
  </section>
  <section class="header mt-5 pt-5">
    <div class="row justify-content-between py-5">
      <div class="col-md-10 mb-3 mb-md-0">
        <h2>International Conference on Southeast Asia 2017</h2>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <section class="body pb-4">
    <div class="card">
      <div class="card-body">
        <div class="row bordered-bottom justify-content-between pb-4">
          <div class="col-md-10">
            <div class="d-flex align-items-start">
              <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
              <div class="pl-3">
                <h4 class="m-0">Introduction text</h4>
                <span class="text-muted">International conference of Southesast asia is an anuual conference that held...</span>
              </div>
            </div>
          </div>
          <div class="col-md-1 pt-md-0 pt-3">
            <div class="d-inline float-right">
              <button class="btn btn-sm">Edit introduction</button>
            </div>
          </div>
        </div>
        <div class="row bordered-bottom justify-content-between py-4">
          <div class="col-md-10">
            <div class="d-flex align-items-start">
              <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
              <div class="pl-3">
                <h4 class="m-0">Identifiers</h4>
                <span class="text-muted">Print ISBN: 1234488282</span> <br>
                <span class="text-muted">Online ISBN: 1335599382</span>
              </div>
            </div>
          </div>
          <div class="col-md-1 pt-md-0 pt-3">
            <div class="d-inline float-right">
              <button class="btn btn-sm">Edit identifiers</button>
            </div>
          </div>
        </div>
        <div class="row bordered-bottom justify-content-between py-4">
          <div class="col-md-10">
            <div class="d-flex align-items-start">
              <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
              <div class="pl-3">
                <h4 class="m-0">Subjects</h4>
                <span class="text-muted">Forestry, Computer</span>
              </div>
            </div>
          </div>
          <div class="col-md-1 pt-md-0 pt-3">
            <div class="d-inline float-right">
              <button class="btn btn-sm">Edit subjects</button>
            </div>
          </div>
        </div>
        <div class="row bordered-bottom justify-content-between py-4">
          <div class="col-md-10">
            <div class="d-flex align-items-start">
              <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
              <div class="pl-3">
                <h4 class="m-0">Cover</h4>
                <img src="https://lorempixel.com/344/550/technics/?77326" class="img-fluid mt-3" width="200px">
              </div>
            </div>
          </div>
          <div class="col-md-1 pt-md-0 pt-3">
            <div class="d-inline float-right">
              <button class="btn btn-sm">Edit cover</button>
            </div>
          </div>
        </div>
        <div class="row justify-content-between py-4">
          <div class="col-md-10">
            <div class="d-flex align-items-start">
              <i class="fas fa-check-circle fa-2x fa-fw text-primary"></i>
              <div class="pl-3">
                <h4 class="m-0">Articles</h4>
                <span class="text-muted">
                  8 articles indexed in Scopus <br>
                  4 articles are not indexed <br>
                  45 total authors
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-1 pt-md-0 pt-3">
            <div class="d-inline float-right">
              <button class="btn btn-sm">Add more articles</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
