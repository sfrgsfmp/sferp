@extends('menu.mainmenu')

@section('title','IPL')

@section('section_title')
  <div class="col-lg-10">
      <h2>@yield('content_title','IPL')</h2>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="{{ route('home') }}">Home</a>
          </li>
          <li class="breadcrumb-item active">
              <strong>@yield('content_title_active','Update IPL')</strong>
          </li>
      </ol>
  </div>
  <div class="col-lg-2"></div>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5> Form Edit </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
        
        <div class="form-group row" >
            <div class="col-sm-2 float-center">
                <button class="btn btn-info dim btn-sm" > <i class="fa fa-warning"> </i> <span class="bold"> GET CODE </span> </button>
            </div>
            <div class="col-sm-10">
                <div class="alert alert-info alert-dismissable">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button"> × </button>
                    <button class="btn btn-info btn-xs"> <i class="fa fa-warning"> </i> <span class="bold"> GET CODE </span> </button>
                    Click this button for get code IPL! 
            
                </div>
                
            </div>
           
        </div>

            <form method="POST" action="{{ route('ipl.update', ['ipls' => $ipls->id]) }}" >
                @csrf
                @method('PUT')
            
                <div class="form-group row">
                    <label class="col-sm-2 ">No. IPL</label>

                           
                    
                            <div id="field_noipl" style="display:block" class="col-sm-8" >
                                <input type="text" id="noipl" name="noipl" class="form-control @error('noipl') is-invalid @enderror" required readonly value="{{$ipls->noipl}}">
                        
                                @error('noipl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                    
                </div>
                

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Transaction</label>
                    <div class="col-sm-8">
                        <div class="input-group date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="date" id="transaction_date" name="transaction_date" class="form-control @error('transaction_date') is-invalid @enderror" value="{{$ipls->transaction_date}}" >
                        </div>
                        @error('transaction_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Vendor</label>
                    <div class="col-sm-8">
                        <select class="form-control @error('vendor_id') is-invalid @enderror" name="vendor_id" id="vendor_id" onchange="show_req()" >
                            @foreach($vendors as $vendor)
        
                                <option value="{{$vendor->id}},{{$vendor->type_vendor}}" {{ $vendor->id == $ipls->vendor_id ?'selected':'' }} > [{{$vendor->type_vendor}}] - {{$vendor->name_vendor}}</option>
                                
                            @endforeach
                        </select>
                        @error('vendor_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                
                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Species</label>
                    <div class="col-sm-8">
                        <select class="form-control @error('species_id') is-invalid @enderror" name="species_id">
                            @foreach($species as $sp)
                            
                            
                            <option value="{{$sp->id}}" {{ $sp->id == $ipls->species_id ?'selected':'' }} > {{$sp->name}}</option>

                            @endforeach
                        </select>
                        @error('species_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Sortimen</label>
                    <div class="col-sm-8">
                        <select class="form-control @error('sortimen') is-invalid @enderror" name="sortimen" id="sortimen" onclick="showMeasure()">
                            <option value=""> ---Choose --- </option>
                            <option value="LOG" {{ ($ipls->sortimen === 'LOG') ? 'selected' : '' }}> Log </option>
                            <option value="BALOK" {{ ($ipls->sortimen === 'BALOK') ? 'selected' : '' }}> Balok </option>
                            <option value="RST" {{ ($ipls->sortimen === 'RST') ? 'selected' : '' }}> RST </option>
                            <option value="FP" {{ ($ipls->sortimen === 'FP') ? 'selected' : '' }}> FP </option>
                            <option value="WIP" {{ ($ipls->sortimen === 'WIP') ? 'selected' : '' }}> WIP </option>
                            <option value="NONKAYU" {{ ($ipls->sortimen === 'NONKAYU') ? 'selected' : '' }}> Non Kayu </option>

                            
                        </select>
                        @error('sortimen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div id="show_diameter">
                    <div class="form-group row"  >
                        <label class="col-sm-2 col-form-label">Diameter</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('diameter_from') is-invalid @enderror" name="diameter_from" value="{{$ipls->diameter_from}}">
                            @error('diameter_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('diameter_to') is-invalid @enderror" name="diameter_to" value="{{$ipls->diameter_to}}">
                            @error('diameter_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control @error('uom_diameter') is-invalid @enderror" name="uom_diameter">
                                <option value=""> -- Choose -- </option>
                                <option value="M2" {{ ($ipls->uom_diameter === 'M2') ? 'selected' : '' }}> M2 </option>
                                <option value="M3" {{ ($ipls->uom_diameter === 'M3') ? 'selected' : '' }}> M3 </option>
                                
                            @error('uom_diameter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </select>
                        </div>
                    </div>
                </div>

                <div id="show_length">
                    <div class="form-group row" >
                        <label class="col-sm-2 col-form-label">Length</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('length_from') is-invalid @enderror" name="length_from"  value="{{$ipls->length_from}}">
                            @error('length_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('length_to') is-invalid @enderror" name="length_to"  value="{{$ipls->length_to}}">
                            @error('length_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-2">
                            <select class="form-control @error('uom_length') is-invalid @enderror" name="uom_length">
                                <option value=""> -- Choose -- </option>
                                <option value="M2" {{ ($ipls->uom_length === 'M2') ? 'selected' : '' }}> M2 </option>
                                <option value="M3" {{ ($ipls->uom_length === 'M3') ? 'selected' : '' }}> M3 </option>
                            @error('uom_length')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </select>
                        </div>
                    </div>
                </div>

                <div id="show_width">
                    <div class="form-group row" >
                        <label class="col-sm-2 col-form-label">Width</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('width_from') is-invalid @enderror" name="width_from" value="{{$ipls->width_from}}">
                            @error('width_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('width_to') is-invalid @enderror" name="width_to" value="{{$ipls->width_to}}">
                            @error('width_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-2">
                            <select class="form-control  @error('uom_width') is-invalid @enderror" name="uom_width">
                                <option value=""> -- Choose -- </option>
                                <option value="M2" {{ ($ipls->uom_width === 'M2') ? 'selected' : '' }}> M2 </option>
                                <option value="M3" {{ ($ipls->uom_width === 'M3') ? 'selected' : '' }}> M3 </option>
                                @error('uom_width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </select>
                        </div>
                    </div>
                </div>

                <div id="show_thick">
                    <div class="form-group row"  >
                        <label class="col-sm-2 col-form-label">Thick</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('thick_from') is-invalid @enderror" name="thick_from" value="{{$ipls->thick_from}}">
                            @error('thick_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('thick_to') is-invalid @enderror" name="thick_to" value="{{$ipls->thick_to}}">
                            @error('thick_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-2">
                            <select class="form-control @error('uom_thick') is-invalid @enderror" name="uom_thick">
                                <option value=""> -- Choose -- </option>
                                <option value="M2" {{ ($ipls->uom_thick === 'M2') ? 'selected' : '' }}> M2 </option>
                                <option value="M3" {{ ($ipls->uom_thick === 'M3') ? 'selected' : '' }}> M3 </option>
                                @error('uom_thick')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </select>
                        </div>
                    </div>
                </div>

                <div id="show_status">
                    <div class="form-group row" >
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-8">
                            <select class="form-control @error('status') is-invalid @enderror" name="status">
                                <option value="Hara" {{ ($ipls->status === 'Hara') ? 'selected' : '' }}> Hara </option>
                                <option value="Industri" {{ ($ipls->status === 'Industri') ? 'selected' : '' }}> Industri </option>
                                <option value="Lokal" {{ ($ipls->status === 'Lokal') ? 'selected' : '' }}> LOkal </option>
                                <option value="Doreng" {{ ($ipls->status === 'Doreng') ? 'selected' : '' }}> Doreng </option>
                                <option value="KBP" {{ ($ipls->status === 'KBP') ? 'selected' : '' }}> KBP </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="show_quality">
                    <div class="form-group row"  >
                        <label class="col-sm-2 col-form-label">Quality</label>
                        <div class="col-sm-8">
                            <select class="form-control @error('quality') is-invalid @enderror" name="quality">
                                <option value="U" {{ ($ipls->quality === 'U') ? 'selected' : '' }}> U </option>
                                <option value="P" {{ ($ipls->quality === 'P') ? 'selected' : '' }}> P </option>
                                <option value="D" {{ ($ipls->quality === 'D') ? 'selected' : '' }}> D </option>
                                <option value="T" {{ ($ipls->quality === 'T') ? 'selected' : '' }}> T </option>
                                <option value="M" {{ ($ipls->quality === 'M') ? 'selected' : '' }}> M </option>
                                <option value="L" {{ ($ipls->quality === 'L') ? 'selected' : '' }}> L </option>
                            </select>
                            @error('quality')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">KWT</label>
                    <div class="col-sm-8">
                        <select class="form-control @error('kwt') is-invalid @enderror" name="kwt">
                            <option value="BSTD" {{ ($ipls->kwt === 'BSTD') ? 'selected' : '' }}> BSTD </option>
                            <option value="AFKIR" {{ ($ipls->kwt === 'AFKIR') ? 'selected' : '' }}> AFKIR </option>
                        </select>
                        @error('kwt')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Wood Drying</label>
                    <div class="col-sm-8">
                        <select class="form-control @error('wood_drying') is-invalid @enderror" name="wood_drying">
                            <option value="KD" {{ ($ipls->wood_drying === 'KD') ? 'selected' : '' }}> KD </option>
                            <option value="NonKD" {{ ($ipls->wood_drying === 'NonKD') ? 'selected' : '' }}> Non KD </option>
                            <option value="KD-NonKD" {{ ($ipls->wood_drying === 'KD-NonKD') ? 'selected' : '' }}> KD and Non KD </option>
                        </select>
                        @error('wood_drying')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Schema</label>
                    <div class="col-sm-8">
                        <select class="form-control @error('schema') is-invalid @enderror" name="schema">
                            <option value="Buy" {{ ($ipls->schema === 'Buy') ? 'selected' : '' }}> Buy </option>
                            <option value="Service" {{ ($ipls->schema === 'Service') ? 'selected' : '' }}> Service </option>
                            
                        </select>
                        @error('schema')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Volume</label>
                    
                    <div class="col-sm-2">
                        <input type="text" class="form-control @error('volume') is-invalid @enderror" name="volume" value="{{$ipls->volume}}">
                        @error('volume')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control @error('uom_volume') is-invalid @enderror" name="uom_volume">
                            <option value=""> -- Choose -- </option>
                            <option value="M2" {{ ($ipls->uom_volume === 'M2') ? 'selected' : '' }}> M2 </option>
                            <option value="M3" {{ ($ipls->uom_volume === 'M3') ? 'selected' : '' }}> M3 </option>
                            
                        </select>
                        @error('uom_volume')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Approval to</label>
                    
                    <div class="col-sm-8">
                        <select class="form-control @error('approvalto_id') is-invalid @enderror" name="approvalto_id">
                            
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $ipls->approvalto_id ?'selected':'' }}> {{$user->username}}</option>
                           
                            @endforeach
                        </select>
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
   
    function show()
    {
        document.getElementById('field_noipl').style.display = 'block';
        document.getElementById('f_noipl').style.display = 'none';
    }

    function hide()
    {
        document.getElementById('noipl').style.display = 'none';
    }


    function showMeasure()
    {
        var s = document.getElementById('sortimen').value;
        if(s == 'LOG')
        {
            document.getElementById('show_thick').style.display = 'none';
            document.getElementById('show_width').style.display = 'none';
            document.getElementById('show_length').style.display = 'block';
            document.getElementById('show_diameter').style.display = 'block';

        }
        else
        {
            document.getElementById('show_thick').style.display = 'block';
            document.getElementById('show_width').style.display = 'block';
            document.getElementById('show_length').style.display = 'block';
            document.getElementById('show_diameter').style.display = 'none';
        }
    }

    // function show_req()
    // {
        // var v = document.getElementById('vendor_id').value;
        // alert(v);
        // var s = document.getElementById('vendor_id');
        // var d = trim(s.options[s.selectedIndex].value);
        // alert($vendor->type_vendor);
        // getTypeVendor();
        // d = document.getElementById('get_typevendor').value;
        // alert(json(document.getElementById('vendor_id').value));
    // }

    function show_req()
    {  
        
        var s = document.getElementById('vendor_id').value;
        var type = s.split(",")[0]; //get id
        var type = s.split(",")[1]; //get type
        if(type == 'Perhutani')
        {
            // alert('a');
            document.getElementById('show_status').style.display = 'block';
            document.getElementById('show_quality').style.display = 'block';
        }
        else
        {
            // alert('b');
            document.getElementById('show_status').style.display = 'none';
            document.getElementById('show_quality').style.display = 'none';
        }
       
    }

    function getTypeVendor()
    {
        document.getElementById('get_typevendor').value;
    }
    
</script>
@endsection