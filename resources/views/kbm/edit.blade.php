@extends('menu.mainmenu')
@section('title','Edit KBM')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','KBM')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Edit KBM')</strong>
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
            <h5> Edit KBM </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('master.kbm.update', ['kbms' => $kbms->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Provinsi</label>
                    <div class="col-sm-10">
                    <!-- //provinsi -->
                        <select id="province_id" name="province_id" class="form-control @error('province') is-invalid @enderror">
                        @foreach($prov as $prov)
                            <option value="{{$prov->id}}" {{ $prov->id == $kbms->province_id ? 'selected':''}}> {{$prov->name}}</option>
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
                        <input type="text" class="form-control @error('name_kbm') is-invalid @enderror" name="name_kbm" value="{{ $kbms->name_kbm }}">
                        @error('name_kbm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                
                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        <a href="{{ route('master.kbm.index') }}" class="btn btn-white btn-sm"> Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


@endsection