@section('js')
<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })


var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('submit').disabled = false;
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('submit').disabled = true;
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
</script>
@stop

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>- Laravel -</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/iconfonts/puse-icons-feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
</head>

@extends('layouts.app')

@section('content')
<div class="container-scroller">
<div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
  <div class="content-wrapper d-flex align-items-center auth theme-one">

    <div class="row w-100">
      <div class="col-md-12" style="margin-bottom: 20px;">
        <h2 style="text-align: center; font-weight: bold">SFERP</h2>
        <center>
          <img src="{{ ('image/MIG_logo.png') }}" height="90px" width="90px" />
        </center>
      </div>

      <div class="col-lg-4 mx-auto">
          <div class="auto-form-wrapper">
              <!-- <div class="card"> -->
                  <!-- <div class="card-header">{{ __('Register') }}</div> -->

                  <!-- <div class="card-body"> -->
                      <form method="POST" action="{{ route('register') }}">
                          @csrf

                          <div class="form-group row">
                              <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                              <div class="col-md-7">
                                  <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                  @error('username')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                              <div class="col-md-7">
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                              <div class="col-md-7">
                                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" onkeyup="check()" name="password" required autocomplete="new-password">

                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                              <div class="col-md-7">
                                  <input id="password-confirm" type="password" onkeyup="check()" class="form-control" name="password_confirmation" required autocomplete="new-password">
                              </div>
                          </div>

                            

                          <div class="form-group row">
                              <!-- <div class="col-md-6 offset-md-4"> -->
                                  <button type="submit" class="btn btn-success submit-btn btn-block">
                                      {{ __('Register') }}
                                  </button>
                              <!-- </div> -->
                          </div>
                      </form>
                  <!-- </div> -->
              <!-- </div> -->
          <!-- </div> -->
    </div>
</div>
</div>
@endsection
