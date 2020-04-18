@extends('menu.mainmenu')
@section('title','Edit Quality')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Quality')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Edit Quality')</strong>
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
            <h5> Edit Quality </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('master.quality.update', ['qa' => $qa->id]) }}" method="POST">
                @csrf
                @method('PUT')
                

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Quality Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('quality_code') is-invalid @enderror" name="quality_code" value="{{ $qa->quality_code }}">
                        @error('quality_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Quality Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('quality_name') is-invalid @enderror" name="quality_name" value="{{ $qa->quality_name }}">
                        @error('quality_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Quality Legend</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('quality_legend') is-invalid @enderror" name="quality_legend" value="{{ $qa->quality_legend }}">
                        @error('quality_legend')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Quality Type</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('quality_type') is-invalid @enderror" name="quality_type" value="{{ $qa->quality_type }}">
                        @error('quality_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        
                        <a href="{{ route('master.quality.index') }}" class="btn btn-white btn-sm"> Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


@endsection