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
              <strong>@yield('content_title_active','Manage Users')</strong>
          </li>
      </ol>
  </div>
  <div class="col-lg-2"></div>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h5>Manage Users</h5>
        </div>
        <div class="card-body">
            @hasrole(['admin'])
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-rounded btn-fw float-left btn-xs" ><i class="fa fa-plus"></i> Add</a>
            @endhasrole
            
          <div class="table-responsive">
          <table class="footable table-bordered dataTables-example">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
              <td>{{$user['username']}}</td>
              <td>{{$user['email']}}</td>
              <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
              <td>
                  <!-- <a href="{{ route('admin.users.edit', $user->id) }}" class="float-left"> -->
                  <a href="{{ url('admin/users/profile/'.$user->id) }}" class="float-left">
                    <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                  </a>

                  <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                    {{ method_field('DELETE') }}
                    @csrf
                    <button type="submit" class="btn btn-danger btn-xs ml-1"> Delete </button>
                  </form>
              </td>
            </tr>
            
            @endforeach
            </tbody>
          </table>
          </div>

          <!-- coba pdf -->
            <!-- action('Admin\UserController@generatePDF') -->
            <!-- <a href="{{ route('generatePDF', $user->id) }}" class="float-right">
              <button type="button" class="btn btn-primary btn-sm"> PDF </button>
            </a> -->

            <!-- <a href="{{ route('PDF') }}" class="float-right">
              <button type="button" class="btn btn-primary btn-sm"> PDF </button>
            </a>
           -->

          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection