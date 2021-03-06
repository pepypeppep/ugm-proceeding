@extends('dashboard.layouts.master')

@section('style')
  <style type="text/css">
    body {
      background: #efefef;
    }
  </style>
@endsection

@section('title', 'Login')

@section('navbar')
  
@endsection

@section('body')
  <section>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <center>
                <img src="/img/logos/logo.svg" class="img-fluid" height="70%">
                <h2 class="mt-3">Login</h2>
              </center>
              <form class="pt-4 px-3" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <label><strong>Email</strong></label>
                  <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                  <label><strong>Password</strong></label>
                  <input type="password" name="password" class="form-control" id="password">
                  <a href="#" style="text-decoration: none;" class="form-text text-primary text-right" onclick="showHidePaswd()"><i class="fas fa-eye fa-fw" id="eyeIcon"></i> Show</a>
                </div>
                <div class="form-group">
                  <button class="btn btn-block btn-primary" type="submit">Login</button>
                </div>
              </form>
              <div class="text-center">
                <a href="{{ route('password.request') }}">Forgot password?</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script type="text/javascript">
  function showHidePaswd() {
    var pwd = document.getElementById("password");
    var eye = document.getElementById("eyeIcon");
    if (pwd.type === "password") {
        pwd.type = "text";
        eye.classList.remove("fa-eye");
        eye.classList.add("fa-eye-slash");
    } else {
        pwd.type = "password";
        eye.classList.remove("fa-eye-slash");
        eye.classList.add("fa-eye");
    }
  }
  </script>
@endsection
