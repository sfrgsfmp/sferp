@extends('menu.mainmenu')
@section('title','Edit Data')

@if ($errors->any())

    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Karyawan')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Update Karyawan')</strong>
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
            <h5> Form Update </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            <form action="{{ route('karyawans.update',$karyawan->id) }}" method="post">
            @csrf
            @method('PUT') 
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="namakaryawan" class="form-control" placeholder="Name" value="{{ $karyawan->namakaryawan }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tlp</label>
                    <div class="col-sm-10">
                        <input type="text" name="notlp" class="form-control" placeholder="Tlp" value="{{ $karyawan->notlp }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $karyawan->alamat }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 text-center">
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

    

@endsection