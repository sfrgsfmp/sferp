@extends('menu.mainmenu')
@section('title','TPK')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','TPK')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','TPK')</strong>
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
            <h5> Create TPK </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            <form action="{{ route('master.tpk.store') }}" method="POST">
                @csrf
               
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name TPK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name_tpk') is-invalid @enderror" name="name_tpk">
                                @error('name_tpk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Group of KPH</label>
                            <div class="col-sm-10">
                               
                                <select class="form-control @error('kph') is-invalid @enderror" name="kph_id">
                                    @foreach($kph as $kph)
                                    <option value="{{$kph->id}}"> {{ $kph->name_kph }}</option>
                                    @endforeach


                                </select>
                                
                                @error('kph')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        
                  
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
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List TPK </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <!-- @hasrole(['admin'])
                        <a href="{{ route('master.tpk.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole -->
                    <table class="footable table table-bordered dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name TPK</th>
                                <th>KPH</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($tpk as $tpk)
                            <tr>
                                <td>{{$no++}}</td>
                                
                                <td>{{$tpk['name_tpk']}}</td>
                                <td> {{ implode(',', $tpk->kph()->get()->pluck('name_kph')->toArray()) }}</td>
                                
                                <td>
                                    <a href="{{ route('master.tpk.edit', $tpk->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.tpk.destroy', $tpk->id) }}" method="post">
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