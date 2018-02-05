<!doctype html>
<html lang="en">
  <head>
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/custom.css">
    <!-- Font Swesome CSS -->
    <link rel="stylesheet" href="/css/font-awesome.css">
    {{-- DATEPICKER CSS --}}
    <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-touch-icon.png?v=3eKR9vjrYw">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicons/favicon-32x32.png?v=3eKR9vjrYw">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicons/favicon-16x16.png?v=3eKR9vjrYw">
    <link rel="manifest" href="/img/favicons/manifest.json?v=3eKR9vjrYw">
    <link rel="mask-icon" href="/img/favicons/safari-pinned-tab.svg?v=3eKR9vjrYw" color="#3b77a4">
    <link rel="shortcut icon" href="/img/favicons/favicon.ico?v=3eKR9vjrYw">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 
    <meta name="msapplication-config" content="/img/favicons/browserconfig.xml?v=3eKR9vjrYw">
    <meta name="theme-color" content="#ffffff">

  </head>
  <body>
    @include('dashboard.layouts.navbar')
    
    <div class="container-fluid pt-5 px-md-5">

      <!-- HEADER -->
      @yield('header')

      {{-- FEEDBACK --}}
      @include('dashboard.layouts.alerts')

      <!-- BODY -->
      @yield('content')

      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.js"></script>
    {{-- DATE PICKER JS --}}
    <script src="/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
      });
    </script>

    @yield('script')
  </body>
</html>