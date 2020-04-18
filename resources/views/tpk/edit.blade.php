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
            <strong>@yield('content_title_active','Update TPK')</strong>
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
            <h5> Edit TPK </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('master.tpk.update', ['tpk' => $tpk->id]) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name TPK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name_tpk') is-invalid @enderror" name="name_tpk" value="{{ $tpk->name_tpk }}">
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
                                    @foreach($kphs as $kph)
                                        <option value="{{$kph->id}}" {{ $kph->id == $tpk->kph_id ?'selected':'' }} > {{ $kph->name_kph }}</option>
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
                        <a href="{{ route('master.tpk.index') }}" class="btn btn-white btn-sm"> Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>



@endsection