@extends('menu.mainmenu')
@section('title','Edit Species')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Species')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ url('master/species/create') }}">Create</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Edit Species')</strong>
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
            <h5> Edit Species </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('master.species.update',['species' => $species->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-sm-6 b-r"> 

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" name="code" value="{{ $species->code }}">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{ $species->name }}">
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
                                <input type="text" class="form-control" name="legend" value="{{ $species->legend }}">
                                @error('legend')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Auto code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="autocode" value="{{ $species->autocode }}">
                                @error('autocode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Spec</label>
                            <div class="col-sm-10">
                                
                                <select name="spec" class="form-control form-control-lg">
                                    <option value="Solid" {{ ($species->spec === 'Solid') ? 'selected' : '' }}> Solid </option>
                                    <option value="2Layer" {{ ($species->spec === '2Layer') ? 'selected' : '' }}> 2 Layer </option>
                                    <option value="3Layer" {{ ($species->spec === '3Layer') ? 'selected' : '' }}> 3 Layer </option>
                                    <option value="4Layer" {{ ($species->spec === '4Layer') ? 'selected' : '' }}> 4 Layer </option>
                                    <!-- @foreach($species as $specc)

                                        <option value="{{ $species->spec }}"> {{$species->spec}}</option>
                                    @endforeach -->
                                </select>

                                @error('spec')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Latin Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="latinname" value="{{ $species->latinname }}">
                                @error('latinname')
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
                        <a href="{{ url('master/species') }}" class="btn btn-white btn-sm"> Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection