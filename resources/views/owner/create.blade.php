@extends('menu.mainmenu')
@section('title','Owner')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Owner')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Owner')</strong>
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
            <h5> Create Owner </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            
            <form action="{{ route('master.owner.store') }}" method="POST">
                @csrf
                <!-- <div class="row"> -->
                    <!-- <div class="col-sm-6 b-r">  -->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Owner Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('owner_code') is-invalid @enderror" name="owner_code">
                                @error('owner_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Owner Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('owner_name') is-invalid @enderror" name="owner_name">
                                @error('owner_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Owner Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('owner_legend') is-invalid @enderror" name="owner_legend">
                                @error('owner_legend')
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
                    <h5>List Owner </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <!-- @hasrole(['admin'])
                        <a href="{{ route('master.owner.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole -->
                    <table class="footable table-bordered toggle-arrow-tiny dataTables-example ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Owner Code</th>
                                <th>Owner Name</th>
                                <th>Owner Legend</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($own as $owner)
                            <tr>
                                <td>{{$no++}}</td>
                                
                                <td>{{$owner['owner_code']}}</td>
                                <td>{{$owner['owner_name']}}</td>
                                <td>{{$owner['owner_legend']}}</td>
                                <td>
                                    

                                    <a href="{{ route('master.owner.edit', $owner->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.owner.destroy', $owner->id) }}" method="post">
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