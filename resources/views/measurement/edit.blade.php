@extends('menu.mainmenu')
@section('title','Edit Measurement')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Measurement')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Edit Measurement')</strong>
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
            <h5> Edit Measurement </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('master.measurement.update', ['uom' => $uom->id]) }}" method="POST">
                @csrf
                @method('PUT')
                

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Measurement Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('measurement_code') is-invalid @enderror" name="measurement_code" value="{{ $uom->measurement_code }}">
                        @error('measurement_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Measurement Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('measurement_name') is-invalid @enderror" name="measurement_name" value="{{ $uom->measurement_name }}">
                        @error('measurement_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                
                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        
                        <!-- <button class="btn btn-white btn-sm" onclick="window.location='{{ URL::previous() }}'">Cancel</button> -->
                        <a href="{{ route('master.measurement.index') }}" class="btn btn-white btn-sm"> Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


@endsection