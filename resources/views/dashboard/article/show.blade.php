@extends('dashboard.layouts.master')

@section('title', 'Article Details')
    
@section('header')
  <section class="header py-5">
    <div class="row justify-content-between">
      <div class="col-md-10 mb-3 mb-md-0">
        <span class="text-muted">{{ $articles->proceeding['name'] }}</span>
        <h2 class="m-0">{{ $articles->data['title'] }}</h2>
      </div>
    </div>
  </section>
@endsection

@section('content')
  <section class="body pb-5">
    <!-- NAV TAB -->
    <nav class="nav nav-tabs scrollable-nav" id="myTab" role="tablist">
      <a class="nav-item nav-link @if(request('tab') == 'articles' || request('tab') == null) active @endif" id="nav-articles-tab" data-toggle="tab" href="#nav-articles" role="tab" aria-controls="nav-articles" aria-selected="true">Article</a>
      <a class="nav-item nav-link @if(request('tab') == 'authors') active @endif" id="nav-authors-tab" data-toggle="tab" href="#nav-authors" role="tab" aria-controls="nav-authors" aria-selected="false">Authors</a>
    </nav> 
    <!-- NAV TAB CONTENTS -->
    <div class="tab-content" id="nav-tabContent">
      <!-- ARTICLES TAB -->
      @include('dashboard.article.tab-articles')
      <!-- DETAILS TAB -->
      @include('dashboard.article.tab-authors')
    </div>
  </section>
@endsection


