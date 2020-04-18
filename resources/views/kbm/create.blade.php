@extends('menu.mainmenu')
@section('title','KBM')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','KBM')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','KBM')</strong>
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
            <h5> Create KBM </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">

            <form action="{{ route('master.kbm.store') }}" method="POST">
                @csrf
                <!-- <div class="row"> -->
                    <!-- <div class="col-sm-6 b-r">  -->
                    <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Provinsi</label>
                            <div class="col-sm-10">
                            <!-- //provinsi -->
                                <select id="province_id" name="province_id" class="form-control @error('province') is-invalid @enderror">
                                @foreach($prov as $prov)
                                    <option value="{{$prov->id}}"> {{$prov->name}}</option>
                                @endforeach
                                </select>
                                @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name KBM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name_kbm') is-invalid @enderror" name="name_kbm">
                                @error('name_kbm')
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
                    <h5>List KBM </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <!-- @hasrole(['admin'])
                        <a href="{{ route('master.kbm.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole -->
                    <table class="footable table table-bordered dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Province</th>
                                <th>Name KBM</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($kbms as $kbm)
                            <tr>
                                <td>{{$no++}}</td>
                                <td> {{ implode(',', $kbm->province()->get()->pluck('name')->toArray()) }}</td>
                                <td>{{$kbm['name_kbm']}}</td>
                                
                                <td>
                                    <a href="{{ route('master.kbm.edit', $kbm->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.kbm.destroy', $kbm->id) }}" method="post">
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