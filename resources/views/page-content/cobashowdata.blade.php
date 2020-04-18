@extends('menu.mainmenu')
@section('title','List Data Karyawan')




@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Karyawan')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List Karyawan')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection


@section('content')

<div class="col-lg-12">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox">
        <div class="ibox-title">
          <h5>Data Table Karyawan</h5>
          <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
          <div class="table-responsive">
            <table class="table table-bordered dataTables-example">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Karyawan</th>
                  <th>Alamat</th>
                  <th>No Tlp</th>

                  @hasrole(['admin','manager'])
                  <th>Action</th>
                  @endhasrole
                
                </tr>
              </thead>
              <tbody>
              @foreach($karyawans as $karyawan)
              <tr>
                <td>{{$karyawan['id']}}</td>
                <td>{{$karyawan['namakaryawan']}}</td>
                <td>{{$karyawan['alamat']}}</td>
                <td>{{$karyawan['notlp']}}</td>
                
                @hasrole(['admin','manager'])
                <td class="text-left">
                
                  <div class="btn-group">
                    <a href="{{action('CrudController@edit', $karyawan['id'])}}" class="btn btn-primary btn-xs">Edit</a>

                    <form action="{{action('CrudController@destroy', $karyawan['id'])}}" method="post">
                      @csrf
                      <input name="_method" type="hidden" value="DELETE">
                      <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                    </form>
                  </div>
                </td>
                @endhasrole

              </tr>
              @endforeach

              </tbody>
            </table>
            <div class="col-lg-2">
                <a href="{{ route('karyawans.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Add</a>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>

<div class="col-lg-12">
<div class="row">
    <div class="col-lg-12">
      <div class="ibox">
          <div class="ibox-title">
            <h5>Trying send email</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
          </div>
          <div class="ibox-content">
            <form method="POST" action="{{ url('/users/sendemail/send') }}" >
                @csrf
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Message</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="message" name="message">

                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label"> Send Email to</label>
                  <div class="col-sm-10">
                    <select name="emailto" class="form-control">
                    @foreach($users as $user)
                      <option value="{{ $user->email }}">{{ $user->username }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <input type="submit" name="send" value="Send" class="btn btn-info">
                </div>
            </form>
          </div>
      </div>
    </div>
</div>
@endsection

