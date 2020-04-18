@extends('menu.mainmenu')

@section('title','Manage Users')

@section('section_title')
  <div class="col-lg-10">
      <h2>@yield('content_title','Manage Users')</h2>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="{{ route('home') }}">Home</a>
          </li>
          <li class="breadcrumb-item">
              <a href="{{ route('admin.users.index')}}"> List</a>
            </li>
          <li class="breadcrumb-item active">
              <strong>@yield('content_title_active','Update Manage Users')</strong>
          </li>
      </ol>
  </div>
  <div class="col-lg-2"></div>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="tabs-container">
        <ul class="nav nav-tabs" role="tablist">
            <li><a class="nav-link {{ request()->is('admin/users/profile/'.$user->id) ? 'active' : null }}" href="{{ url('admin/users/profile/'.$user->id) }}"> Profile</a></li>
            <li><a class="nav-link {{ request()->is('admin/users/password/'.$user->id) ? 'active' : null }}" href="{{ url('admin/users/password/'.$user->id) }}"> Password</a></li>
        </ul>
        <div class="tab-content">
            <div id="{{ url('admin/users/profile/'.$user->id) }}" class="tab-pane {{ request()->is('admin/users/profile/'.$user->id) ? 'active' : null }}">
                <div class="panel-body">
                    
                    <form action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus readonly>

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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

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
                                
                                <select id="role" name="role" class="form-control" >
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role->id == $user->hasAnyRole($role->name)?'selected':'' }}>  
                                    {{$role->name }}
                                    </option>
                                @endforeach
                                </select>
                                
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Save </button>
                                    <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

            <div id="{{ url('admin/users/password/'.$user->id) }}" class="tab-pane {{ request()->is('admin/users/password/'.$user->id) ? 'active' : null }}">
                <div class="panel-body">
                    <form method="POST" action="{{ route('admin.changepswd.update', $user->id) }}">
                        @csrf
                        {{ method_field('PUT') }}

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Old Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required>

                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary" onclick="showOldPassword()"><i class="fa fa-eye"> </i></button>
                                        </span>

                                       
                                    </div>
                                    @error('old_password')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">New Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>

                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary" onclick="showNewPassword()"><i class="fa fa-eye"> </i></button>
                                        </span>
                                       
                                    </div>
                                    @error('new_password')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Confirm Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="confrim_password" type="password" class="form-control @error('confrim_password') is-invalid @enderror" name="confrim_password" required>

                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary" onclick="showConfirmPassword()"><i class="fa fa-eye"> </i></button>
                                        </span>
                                       
                                    </div>
                                    @error('confrim_password')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Save </button>
                                    <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>       
        </div>
    </div>
</div>

<!-- ----------------------------------------------------------------------------------------- -->
<script type="text/javascript">
// Visibility for password
function showOldPassword() {
    var field = document.getElementById("old_password");
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}

function showNewPassword() {
    var field = document.getElementById("new_password");
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}

function showConfirmPassword() {
    var field = document.getElementById("confrim_password");
    if (field.type === "password") {
        field.type = "text";
    } else {
        field.type = "password";
    }
}

</script>
@endsection