@extends('menu.mainmenu')
@section('title','Quality')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Quality')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Quality')</strong>
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
            <h5> Create Quality </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            
            <form action="{{ route('master.quality.store') }}" method="POST">
                @csrf
                <!-- <div class="row"> -->
                    <!-- <div class="col-sm-6 b-r">  -->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Quality Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('quality_code') is-invalid @enderror" name="quality_code">
                                @error('class_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Quality Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('quality_name') is-invalid @enderror" name="quality_name">
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
                                <input type="text" class="form-control @error('quality_legend') is-invalid @enderror" name="quality_legend">
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
                                <input type="text" class="form-control @error('quality_type') is-invalid @enderror" name="quality_type">
                                @error('quality_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    <!-- </div> -->
                    
                <!-- </div> -->
                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- SHOW -->
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List Quality </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <!-- @hasrole(['admin'])
                        <a href="{{ route('master.quality.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole -->
                    <table class="footable table table-bordered dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Quality Code</th>
                                <th>Quality Name</th>
                                <th>Quality Legend</th>
                                <th>Quaility Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($qa as $quality)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$quality['quality_code']}}</td>
                                <td>{{$quality['quality_name']}}</td>
                                <td>{{$quality['quality_legend']}}</td>
                                <td> {{$quality['quality_type']}}</td>
                                <td>
                                    <a href="{{ route('master.quality.edit', $quality->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                                    </a>
                                    <form action="{{ route('master.quality.destroy', $quality->id) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-xs ml-1"> Delete </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection