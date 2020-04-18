@extends('menu.mainmenu')
@section('title','KPH')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','KPH')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('master.kph.show')}}">List</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('master.kph.create')}}">Create</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Update KPH')</strong>
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
            <h5> Update KPH </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('master.kph.update', ['kph' => $kph->id]) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name KPH</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name_kph') is-invalid @enderror" name="name_kph" value="{{ $kph->name_kph }}">
                                @error('name_kph')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Type KPH</label>
                            <div class="col-sm-10">
                                <select name="kphtype_id" class="form-control @error('kphtype_id') is-invalid @enderror">
                                    @foreach($kphtype as $type)
                                        <option value="{{ $type->id}}" {{$type->id == $kph->kphtype_id ? 'selected':'' }}> {{ $type->code }} </option>
                                    @endforeach
                                </select>
                                @error('kphtype_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Group of KBM</label>
                            <div class="col-sm-10">
                               
                                <select class="form-control @error('kbm_id') is-invalid @enderror" name="kbm_id">
                                    @foreach($kbms as $kbm)
                                        <option value="{{$kbm->id}}" {{ $kbm->id == $kph->kbm_id ?'selected':'' }} > {{ $kbm->name_kbm }}</option>
                                    @endforeach

                                    
                                
                                </select>
                                
                                @error('kbm_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        
                  
                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        <a href="{{ route('master.kph.index') }}" class="btn btn-white btn-sm"> Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>



@endsection