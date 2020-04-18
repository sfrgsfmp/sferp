@extends('menu.mainmenu')
@section('title','Certificate')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Certificate')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Certificate')</strong>
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
            <h5> Create Certificate </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            
            <form action="{{ route('master.certificate.store') }}" method="POST">
                @csrf
                <!-- <div class="row"> -->
                    <!-- <div class="col-sm-6 b-r">  -->

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('cert_code') is-invalid @enderror" name="cert_code">
                                @error('cert_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('cert_name') is-invalid @enderror" name="cert_name">
                                @error('cert_name')
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
                    <h5>List Certificate </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <!-- @hasrole(['admin'])
                        <a href="{{ route('master.certificate.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole -->
                    <table class="footable table table-bordered ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($cert as $certificate)
                            <tr>
                                <td>{{$no++}}</td>
                                
                                <td>{{$certificate['cert_code']}}</td>
                                <td>{{$certificate['cert_name']}}</td>
                                
                                <td>
                                    

                                    <a href="{{ route('master.certificate.edit', $certificate->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-sm"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.certificate.destroy', $certificate->id) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"> Delete </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $cert->links() }}
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection