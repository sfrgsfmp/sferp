@extends('menu.mainmenu')
@section('title','Edit Specification')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Specification')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
              <a href="{{ route('master.specification.create') }}">Create</a>
          </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Edit Specification')</strong>
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
        
           
        <form action="{{ route('master.specification.update',['specs' => $specs->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6 b-r"> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$specs->name}}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Legend</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('legend') is-invalid @enderror" name="legend" value="{{$specs->legend}}">
                                @error('legend')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Auto code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('autocode') is-invalid @enderror" name="autocode" value="{{$specs->autocode}}">
                                @error('autocode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vendor Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('vendorname') is-invalid @enderror" name="vendorname" value="{{$specs->vendorname}}">
                                @error('vendorname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Type Specification</label>
                            <div class="col-sm-10">
                                
                                <select name="type_specification" class="form-control form-control-lg @error('type_specification') is-invalid @enderror">
                                    
                                    <option value="1" {{ ($specs->type_specification === '1') ? 'selected' : '' }}> Specification 1 </option>
                                    <option value="2" {{ ($specs->type_specification === '2') ? 'selected' : '' }}> Specification 2 </option>
                                    <option value="3" {{ ($specs->type_specification === '3') ? 'selected' : '' }}> Specification 3 </option>
                                    
                                    
                                </select>

                                @error('type_specification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        <!-- <button class="btn btn-white btn-sm" type="reset">Cancel</button> -->
                        <a href="{{ url('master/specification') }}" class="btn btn-white btn-sm"> Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection