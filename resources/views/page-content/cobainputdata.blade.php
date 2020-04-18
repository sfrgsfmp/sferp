@extends('menu.mainmenu')
@section('title','Input Data')


@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Karyawan')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Input Karyawan')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection


@section('content')

<!-- alert notification -->
<div class="col-lg-12">
@if ($errors->any())
    <div class="alert alert-danger alert-dismissable">

        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <strong>Oops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>

<div class="col-lg-12">
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ $message }}
    </div>
@endif
</div>

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
            <form action="{{ route('karyawans.store') }}" method="POST">
                @csrf
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="namakaryawan" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tlp</label>
                    <div class="col-sm-10">
                        <input type="text" name="notlp" class="form-control" placeholder="Tlp">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                    </div>
                </div>
                
            
            </form>

            <div class="col-lg-12 text-left" style="margin-top:10px;margin-bottom: 10px;">
                <a class="btn btn-primary" href="{{ route('karyawans.index') }}"> Back</a>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->

@endsection

