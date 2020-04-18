@extends('menu.mainmenu')

@section('title','Handling')

@section('section_title')
  <div class="col-lg-10">
      <h2>@yield('content_title','Handling')</h2>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="{{ route('home') }}">Home</a>
          </li>
          <li class="breadcrumb-item active">
              <strong>@yield('content_title_active','Handling')</strong>
          </li>
      </ol>
  </div>
  <div class="col-lg-2"></div>
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
        
           
        <form action="{{ route('master.handling.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6 b-r"> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code">
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe">
                                @error('tipe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div id="getuom">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">UOM</label>
                                <div class="col-sm-10">
                                    
                                    <select class="form-control @error('id_measurement') is-invalid @enderror" name="id_measurement" id="id_measurement">

                                        <option value=""> --- Unit/Measurement --- </option>

                                        @foreach($uom as $unit)
                                            <option value="{{ $unit->id }}"> {{ $unit->measurement_name }} </option>
                                        @endforeach
                                    </select>

                                    @error('id_measurement')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="getcurrency">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Currency</label>
                                <div class="col-sm-10">
                                    
                                    <select class="form-control @error('id_currency') is-invalid @enderror" name="id_currency" id="id_currency">

                                        <option value=""> --- Currency --- </option>

                                        @foreach($cry as $uang)
                                            <option value="{{ $uang->id }}"> {{ $uang->name }} </option>
                                        @endforeach
                                    </select>

                                    @error('id_currency')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Rate 10</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('rate10') is-invalid @enderror" value=0 name="rate10">
                                @error('rate10')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Rate 15</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('rate15') is-invalid @enderror" value=0 name="rate15">
                                @error('rate15')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Rate 20</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('rate20') is-invalid @enderror" value=0 name="rate20">
                                @error('rate20')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-sm-6">

                        <div id="getseksinya">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Section</label>
                                <div class="col-sm-10">
                                    
                                    <select class="form-control @error('id_section') is-invalid @enderror" name="id_section" id="id_section">

                                        <option value=""> --- Choose Section --- </option>

                                        @foreach($seksinya as $sks)
                                            <option value="{{ $sks->id }}"> {{ $sks->name }} </option>
                                        @endforeach
                                    </select>

                                    @error('id_section')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Reference</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('reference') is-invalid @enderror" name="reference">
                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Group</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('group') is-invalid @enderror" name="group">
                                @error('group')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                
                                <select name="is_status" class="form-control form-control-lg @error('is_status') is-invalid @enderror">
                                    <option value="0"> Inactive</option>
                                    <option value="1"> Active</option>
                                </select>

                                @error('is_status')
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
                        <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function getUOM()
    {
        document.getElementById('getuom').style.display = 'none';
        
    }
    function getcurrency()
    {
        document.getElementById('getcurrency').style.display = 'none';
        
    }
    function getseksinya()
    {
        document.getElementById('getseksinya').style.display = 'none';
        
    }
</script>

@endsection