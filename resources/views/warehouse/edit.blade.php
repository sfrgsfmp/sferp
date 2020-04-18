@extends('menu.mainmenu')
@section('title','Edit Warehouse')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Warehouse')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Edit Warehouse')</strong>
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
        
           
        <form action="{{ route('master.warehouse.update',['gudang' => $gudang->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6 b-r"> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('warehouse_code') is-invalid @enderror" name="warehouse_code" value="{{$gudang->warehouse_code}}">
                                @error('warehouse_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('warehouse_name') is-invalid @enderror" name="warehouse_name" value="{{$gudang->warehouse_name}}">
                                @error('warehouse_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                
                                <select name="warehouse_type" class="form-control form-control-lg @error('warehouse_type') is-invalid @enderror">
                                    
                                    <option value="1" {{ ($gudang->warehouse_type == 1) ? 'selected' : '' }}> Standard Warehouse </option>
                                    <option value="2" {{ ($gudang->warehouse_type == 2) ? 'selected' : '' }}> Work In Progress </option>
                                    <option value="3" {{ ($gudang->warehouse_type == 3) ? 'selected' : '' }}> Work In Progress Store </option>
                                    <option value="4" {{ ($gudang->warehouse_type == 4) ? 'selected' : '' }}> Third Party Warehouse </option>

                                </select>

                                @error('warehouse_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Location</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('warehouse_loc') is-invalid @enderror" name="warehouse_loc" value="{{$gudang->warehouse_loc}}">
                                @error('warehouse_loc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>


                    </div>
                    <div class="col-sm-6">
                        

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Group</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('warehouse_group') is-invalid @enderror" name="warehouse_group" value="{{$gudang->warehouse_group}}">
                                @error('warehouse_group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('warehouse_desc') is-invalid @enderror" name="warehouse_desc" value="{{$gudang->warehouse_desc}}">
                                @error('warehouse_desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Objective</label>
                            <div class="col-sm-10">
                               
                                <select class="form-control @error('id_objective') is-invalid @enderror" name="id_objective">
                                    @foreach($objek as $obj)
                                        <option value="{{$obj->id}}" {{ $obj->id == $gudang->id_objective ?'selected':'' }} > {{ $obj->objective_name }}</option>
                                    @endforeach
                                </select>
                                
                                @error('id_objective')
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
                        <button class="btn btn-white btn-sm" onclick="window.location='{{ URL::previous() }}'">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function getObjek()
    {
        document.getElementById('getobjective').style.display = 'none';
        
    }
</script>

@endsection