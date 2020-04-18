@extends('menu.mainmenu')
@section('title','Manage Users')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Manage Users')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Create Manage Users')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5> Form Input </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            <form method="POST" action="{{ route('admin.users.store') }}" >
                @csrf
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select id="role" name="role" class="form-control m-b" required>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" onkeyup="check()" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input id="password-confirm" type="password" onkeyup="check()" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                        <button class="btn btn-primary btn-sm" type="submit">Register</button>
                    </div>
                </div>
                
            
            </form>

        </div>
    </div>
</div>

@endsection