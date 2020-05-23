@extends('menu.mainmenu')
@section('title','Tanda Terima')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Tanda Terima')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Tanda Terima')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="ibox-content">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li><a class="nav-link active" data-toggle="tab" href="#tab-1">General</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2" id="tab2">Other</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-3" id="tab3">Information</a></li>
                <!-- <li><a class="nav-link" data-toggle="tab" href="#tab-4" id="tab4">Barcode</a></li> -->
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <form action="{{ route('tt.store')}}" method="POST">
                        @csrf 
                            <div class="row">        
                                <div class="col-sm-9">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"> TT Date</label>
                                        <div class="col-sm-10">
                                            <div class="input-daterange input-group" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type='text' class="form-control datepicker-here @error('tt_date') is-invalid @enderror" name="tt_date" id="tt_date" data-language='en' />
                                                @error('tt_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"> TT No</label>
                                        <div class="col-sm-10">
                                            <input type='text' class="form-control @error('tt_no') is-invalid @enderror" name="tt_no" id="tt_no">
                                            @error('tt_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"> Form No</label>
                                        <div class="col-sm-10">
                                            <input type='text' class="form-control @error('form_no') is-invalid @enderror" name="form_no" id="form_no">
                                            @error('form_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Division</label>
                                        <div class="col-sm-7">
                                            <select class="form-control @error('division') is-invalid @enderror" id="division" name="division">
                                                @foreach($company as $com)
                                                    <option value="{{$com->code}}">{{$com->code}}</option>
                                                @endforeach
                                            </select>
                                            @error('division')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Item Group</label>
                                        <div class="col-sm-7">
                                            <select class="form-control @error('itemgroup_id') is-invalid @enderror" id="itemgroup_id" name="itemgroup_id" onchange="get_nmitemgroup(this)">
                                                <option value=""> Choose</option>
                                                @foreach($itemgroup as $ig)
                                                    <option value="{{$ig->id}}">{{$ig->itemgroup_code}}</option>
                                                @endforeach
                                            </select>
                                            @error('itemgroup_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        <!-- //name item group -->
                                        <input type="hidden" id="itemgroup" name="itemgroup" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 b-r">
                                    <h4 class="m-t-none m-b">PIM</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">PIM Code</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">

                                                <input type="hidden" class="form-control" id="pimid" name="pimid" readonly>

                                                <input type="text" class="form-control" id="pim_code" name="pim_code" readonly>

                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal5"> <i class="fa fa-search" id="window"> </i> </button>
                                                </span>
                                            </div>
                                            @error('pim_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">PIM No</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="pim_no" name="pim_no" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">PRM No</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="prm_no" name="prm_no" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Parcel No</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="parcel_no" name="parcel_no" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SJ No</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="sj_no" name="sj_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">DKP No</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="dkp_no" name="dkp_no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Species</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="species" name="species" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Objective</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="objective" name="objective" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Doc Dt</label>
                                        <div class="col-sm-8">
                                            <div class="input-daterange input-group" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type='text' class="form-control datepicker-here @error('doc_dt') is-invalid @enderror" name="doc_dt" id="doc_dt" data-language='en' />
                                                @error('doc_dt')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="m-t-none m-b">Document</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Code</label>
                                        <div class="col-sm-8">
                                            
                                                <input type='text' class="form-control @error('code_document') is-invalid @enderror" name="code_document" id="code_document"/>
                                                @error('code_document')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">No</label>
                                        <div class="col-sm-8">
                                            
                                            <input type='text' class="form-control @error('no_document') is-invalid @enderror" name="no_document" id="no_document">
                                            @error('no_document')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Doc No</label>
                                        <div class="col-sm-8">
                                            
                                            <input type='text' class="form-control @error('doc_no') is-invalid @enderror" name="doc_no" id="doc_no">
                                            @error('doc_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="m-t-none m-b">Certificate</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Type Certificate</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="type_certificate" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Kode FSC</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="kode_fsc" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Cert Claim</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control @error('cert_claim') is-invalid @enderror" id="cert_claim">
                                                @error('cert_claim')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">WWF Type</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" class="form-control @error('wwf_type') is-invalid @enderror" id="wwf_type" name="wwf_type" readonly>
                                                
                                                @error('wwf_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- //vendor -->
                                    <h4 class="m-t-none m-b">Vendor</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Code</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="vendor_id" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">TPK</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="tpk_id" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">KPH</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="kph_id" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="m-t-none m-b">Concession</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Code</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="code_concession">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="name_concession">
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="m-t-none m-b">Handling</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Contractor</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="contractor" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Work Shift</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="workshift" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Rate Used</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="rateused" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Handling</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                               <input type="text" class="form-control" id="handling" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                           
                        <!-- </form> -->  
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div  class="panel-body">
                        <div class="row">
                            <div class="col-sm-6 b-r">
                                <h4 class="m-t-none m-b">Item</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Grade Qty</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('grade_qty') is-invalid @enderror" id="grade_qty" name="grade_qty" >
                                        @error('grade_qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Phisic Qty</label>
                                    <div class="col-sm-8">
                                        <div class="input-daterange input-group">
                                            <input type="text" class="form-control @error('phisic_qty') is-invalid @enderror" id="phisic_qty" name="phisic_qty" >
                                            @error('phisic_qty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <!-- //0 batang, 1 pallet -->
                                            <select class="form-control @error('format_phisicqty') is-invalid @enderror" id="format_phisicqty" name="format_phisicqty">
                                                <option value="0"> Batang</option>
                                                <option value="1"> Pallet</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Doc Qty</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('doc_qty') is-invalid @enderror" id="doc_qty" name="doc_qty" >
                                        @error('doc_qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Doc M3</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('docm3') is-invalid @enderror" id="docm3" name="docm3" >
                                        @error('docm3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Height</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('height') is-invalid @enderror" id="height" name="height">
                                        @error('height')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Width</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('width') is-invalid @enderror" id="width" name="width">
                                        @error('width')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Length</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('length') is-invalid @enderror" id="length" name="length">
                                        @error('length')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <h4 class="m-t-none m-b">Unit Location</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Province</label>
                                    <div class="col-sm-8">
                                        <select class="form-control @error('province') is-invalid @enderror" id="province" name="province">
                                            <option value=""></option>
                                            @foreach($provs as $prov)
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
                                    <label class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-8">
                                        <select class="form-control @error('city') is-invalid @enderror" id="city" name="city">
                                            <option value=""> </option>
                                        </select>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">District</label>
                                    <div class="col-sm-8">
                                        <select class="form-control @error('district') is-invalid @enderror" id="district" name="district">
                                            <option value=""> </option>
                                        </select>
                                        @error('district')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Village</label>
                                    <div class="col-sm-8">
                                        <select type="text" class="form-control @error('village') is-invalid @enderror" id="village" name="village">
                                            <option value=""> </option>
                                        </select>
                                        @error('village')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <h4 class="m-t-none m-b">Transportation</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Type</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('type_transportation') is-invalid @enderror" id="type_transportation" name="type_transportation" readonly>
                                            <!-- <option value=""></option>
                                        </select> -->
                                        @error('type_transportation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('no_transportation') is-invalid @enderror" id="no_transportation" name="no_transportation" readonly>
                                            <!-- <option value=""></option>
                                        </select> -->
                                        @error('no_transportation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="m-t-none m-b">Capacity</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">WH Bongkar</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="chosen-select form-control @error('WH Bongkar') is-invalid @enderror" id="whbongkar" name="whbongkar" readonly>
                                         
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">WH Stapel</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="chosen-select form-control @error('WH Stapel') is-invalid @enderror" id="whstapel" name="whstapel" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Time</label>
                                    <div class="col-sm-9">
                                        <div class="calculate">
                                            <div class="input-daterange input-group">
                                                <input type="time" class="form-control @error('starttime') is-invalid @enderror" id="starttime" name="starttime" step="1" readonly>
                                               
                                                <span class="input-group-addon">to</span>
                                                <input type="time" class="form-control @error('endtime') is-invalid @enderror" id="endtime" name="endtime" step="1" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Head Count</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="headcount" name="headcount" class="form-control @error('headcount') is-invalid @enderror" onkeypress="return isNumber(event)" readonly>
                                        @error('headcount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Grade Dt</label>
                                    <div class="col-sm-9">
                                        <div class="input-daterange input-group" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type='text' class="form-control datepicker-here @error('grade_dt') is-invalid @enderror" name="grade_dt" id="grade_dt" data-language='en'>
                                            @error('grade_dt')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <h4 class="m-t-none m-b">Description</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Dari</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="dari" name="dari" class="form-control @error('dari') is-invalid @enderror">
                                        @error('dari')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"> </textarea>
                                        @error('keterangan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">No SPB</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="no_spb" name="no_spb" class="form-control @error('no_spb') is-invalid @enderror" readonly>
                                        @error('no_spb')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"> Pay Date</label>
                                    <div class="col-sm-9">
                                        <div class="input-daterange input-group" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type='text' class="form-control datepicker-here @error('paydate') is-invalid @enderror" name="paydate" id="paydate" data-language='en' />
                                            @error('paydate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"> Discharge Date</label>
                                    <div class="col-sm-9">
                                        <div class="input-daterange input-group" >
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type='text' class="form-control datepicker-here @error('dischargedate') is-invalid @enderror" name="dischargedate" id="dischargedate" data-language='en' />
                                            @error('dischargedate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <h4 class="m-t-none m-b">Spec1</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Spec1</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="spec1" name="spec1" class="form-control @error('spec1') is-invalid @enderror" readonly>
                                        @error('spec1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sortimen</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="sortimen" name="sortimen" class="form-control @error('sortimen') is-invalid @enderror" readonly>
                                        @error('sortimen')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <div class="row">        
                            <div class="col-sm-9">
                                <h4 class="m-t-none m-b">Asal</h4>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">No Dokumen</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="no_dokumen" name="no_dokumen" class="form-control @error('no_dokumen') is-invalid @enderror">
                                        @error('no_dokumen')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jenis</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="jenis" name="jenis" class="form-control @error('jenis') is-invalid @enderror">
                                        @error('jenis')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tipe</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="tipe" name="tipe" class="form-control @error('tipe') is-invalid @enderror">
                                        @error('tipe')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>      
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Btg</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="btg" name="btg" class="form-control @error('btg') is-invalid @enderror" onkeypress="return isNumber(event)">
                                        @error('btg')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">M3</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="m3" name="m3" class="form-control @error('m3') is-invalid @enderror" onkeypress="return isNumber(event)">
                                        @error('m3')
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
                </div>
                <!-- <div id="tab-4" class="tab-pane"> -->
                    <!-- <div class="panel-body">
                        <span id="result"></span>
                        <form method="POST" id="dynamicform">
                        @csrf 
                            <div class="row">        
                                <div class="col-sm-9">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"> TT ID</label>
                                        <div class="col-sm-10">
                                            <select class="form-control @error('tt_id') is-invalid @enderror" name="tt_id" id="tt_id">
                                                @foreach($tts as $t)
                                                    <option value="{{ $t['id'] }}"> {{$t['code_tt'] }}</option>
                                                @endforeach
                                            </select>
                                                @error('tt_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"> Barcode List</label>
                                        <table class="table table-stripped" id="tblbarcode">
                                            <thead>
                                                <th width="50%"> Barcode </th>
                                                <th width="12%"> Action </th>
                                            </thead>
                                            <tbody id="bodybarcode">
                                                <tr>
                                                    <td> </td>
                                                </tr>
                                            </tbody>
                                            <tfoot id="footbarcode">
                                                <tr>
                                                    <td> <input type="submit" name="save" id="save" class="btn btn-primary btn-sm" value="Save" /> </td>
                                                </tr>
                                            </tfoot>

                                        
                                        </table>
                                        
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 text-center">
                                            <button class="btn btn-default btn-sm" type="reset">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div> -->
                <!-- </div> -->

            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                    <thead>
                        <tr>
                            <th data-toggle="true">Code TT</th>
                            <th>No TT</th>
                            <th data-hide="all">Form No</th>
                            <th data-hide="all">TT Date</th>
                            <th> Division</th>
                            <th> Item Group</th>
                            <th data-hide="all"> PIM</th>
                            <th data-hide="all"> No SJ</th>
                            <th data-hide="all"> No DKP</th>
                            <th> Doc Date</th>
                            <th> Code Document</th>
                            <th data-hide="all"> No Document</th>
                            <th data-hide="all"> Cert Claim</th>
                            <th data-hide="all"> Grade Qty</th>
                            <th data-hide="all"> Phisic Qty</th>
                            <th data-hide="all"> Doc Qty</th>
                            <th data-hide="all"> Doc M3</th>
                            <th data-hide="all"> Height</th>
                            <th data-hide="all"> Width</th>
                            <th data-hide="all"> Length</th>
                            <th data-hide="all"> Province</th>
                            <th data-hide="all"> City</th>
                            <th data-hide="all"> District</th>
                            <th data-hide="all"> Village</th>
                            <th data-hide="all"> No SPB</th>
                            <th data-hide="all"> No Dokumen</th>
                            <th data-hide="all"> Jenis</th>
                            <th data-hide="all"> Tipe</th>
                            <th data-hide="all"> Btg</th>
                            <th data-hide="all"> M3</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                        @foreach($tts as $tt)
                        <tr>
                            <td> {{$tt->code_tt}}</td>
                            <td> {{$tt->tt_no}}</td>
                            <td> {{$tt->form_no}}</td>
                            <td> {{$tt->tt_date}}</td>
                            <td> {{$tt->division}}</td>
                            <td> {{ implode(',', $tt->itemgroups()->get()->pluck('itemgroup_name')->toArray()) }}</td>
                            <td> {{ implode(',', $tt->pims()->get()->pluck('code_pim')->toArray()) }}</td>
                            <td> {{$tt->sj_no}}</td>
                            <td> {{$tt->dkp_no}}</td>
                            <td> {{$tt->doc_dt}}</td>
                            <td> {{$tt->code_document}}</td>
                            <td> {{$tt->no_document}}</td>
                            <td> {{$tt->cert_claim}}</td>
                            <td> {{$tt->grade_qty}}</td>
                            <td> {{$tt->phisic_qty}}</td>
                            <td> {{$tt->doc_qty}}</td>
                            <td> {{$tt->docm3}}</td>
                            <td> {{$tt->height}}</td>
                            <td> {{$tt->width}}</td>
                            <td> {{$tt->length}}</td>
                            <td> {{$tt->province}}</td>
                            <td> {{$tt->city}}</td>
                            <td> {{$tt->district}}</td>
                            <td> {{$tt->village}}</td>
                            <td> {{$tt->no_spb}}</td>
                            <td> {{$tt->no_dokumen}}</td>
                            <td> {{$tt->jenis}}</td>
                            <td> {{$tt->tipe}}</td>
                            <td> {{$tt->btg}}</td>
                            <td> {{$tt->m3}}</td>
                            <td align="center">
                                <a href="{{ route('tt.edit', $tt->id) }}" class='float-center' title="Edit">                      
                                    <i class="fa fa-edit"> </i>
                                </a>
                                &nbsp
                                <a class="demo1" data-id="{{$tt->id}}" title="Delete"> <i class="fa fa-trash text-red"> </i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- //MODAL SEARCH PIM -->
<div class="modal inmodal fade" id="myModal5" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">PIM</h4>
                <small class="font-bold">Planning Income Material</small>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <th data-toggle="true">PIM</th>
                                <th>No PIM</th>
                                <th> Apply Date </th>
                                <th>PO</th>
                                <th data-hide="all"> No PRM</th>
                                <th data-hide="all"> No Parcel</th>
                                <th data-hide="all"> BP</th>
                                <th> Vendor</th>
                                <th> Sortimen</th>
                                <th> Specs</th>
                                <th> Informasi Lain</th>
                                <th data-hide="all"> NoTransport</th>
                                <th> Estdocm3</th>
                                <th> SPB</th>
                                <th> Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pims as $pim)
                            <tr>
                                <td>{{$pim->code_pim}} </td>
                                <td>{{$pim->pimno}} </td>
                                <td>{{$pim->applydate}}</td>
                                <td>{{ implode(',', $pim->po()->get()->pluck('code')->toArray()) }}</td>
                                <td>{{$pim->noprocurement}}</td>
                                <td>{{$pim->noparcel}}</td>
                                <td>{{$pim->bp}}</td>
                                <td>{{ implode(',', $pim->vendor()->get()->pluck('name_vendor')->toArray()) }}</td>
                                <td>{{$pim->sortimen}}</td>
                                <td>{{$pim->specs}}</td>
                                <td>{{$pim->informasilain}}</td>
                                <td>{{$pim->notransport}}</td>
                                <td>{{$pim->estdocm3}}</td>
                                <td>{{$pim->spb}}</td>
                                <td align=center> 
                                    <!-- <a class='selectpim' id="selectpim" data-id="{{$pim->id}}" title="Choose">                        
                                        <i class="fa fa-check-square-o"> </i>
                                    </a> -->
                                    <button type="button" id="selectpim" class="btn btn-outline btn-link" onclick="selectpim({{$pim->id}})"  title="Choose">
                                        <i class="fa fa-square-o"> </i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){

    var count = 1;

    tblbarcode(count);

    function tblbarcode(number)
    {
            html = '<tr>';
            html += '<td><input type="text" name="barcode[]" class="form-control" /></td>';
           

            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove">Remove</button></td></tr>';
                $('#bodybarcode').append(html);
            }
            else
            {   
                html += '<td><button type="button" name="add" id="add" class="btn btn-success btn-sm">Add</button></td></tr>';
                $('#bodybarcode').html(html);
            }

            
    }

    $(document).on('click', '#add', function(){
        count++;
        tblbarcode(count);
    });

    $(document).on('click', '.remove', function(){
        count--;
        $(this).closest("tr").remove();
    });

    $('#save').on('click', function(event){
            event.preventDefault();
            $.ajax({
                url:'{{ route("tt.storebarcode") }}',
                method:'post',
                data:$(this).serialize(),
                dataType:'json',
                // beforeSend:function(){
                //     $('#save').attr('disabled','disabled');
                // },
                success:function(data)
                {
                    if(data.error)
                    {
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++)
                        {
                            error_html += '<p>'+data.error[count]+'</p>';
                        }
                        
                        $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                    }
                    else
                    {
                        tblbarcode(1);
                        $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                    }
                    // $('#save').attr('disabled', false);
                }
            })
    });

    });
</script>

<script>
//SELECT PIM FROM MODAL
    function selectpim($id)
    {
        if($id)
        {
            console.log('id = '+$id);
            // alert($id);

            $.ajax({
                url: '/TT/selectpim/'+$id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $('#pimid').val(data[0]);
                    $('#pim_code').val(data[1]);
                    $('#pim_no').val(data[2]);
                    $('#prm_no').val(data[3]);
                    $('#parcel_no').val(data[4]);
                    $('#species').val(data[5]);
                    $('#type_certificate').val(data[6]);
                    $('#kode_fsc').val(data[7]);
                    $('#wwf_type').val(data[8]);
                    $('#vendor_id').val(data[9]);
                    $('#tpk_id').val(data[10]);
                    $('#kph_id').val(data[11]);
                    $('#objective').val(data[12]);
                    $('#whbongkar').val(data[13]);
                    $('#whstapel').val(data[14]);
                    $('#type_transportation').val(data[15]);
                    $('#no_transportation').val(data[16]);
                    $('#starttime').val(data[17]);
                    $('#endtime').val(data[18]);
                    $('#headcount').val(data[19]);
                    $('#no_spb').val(data[20]);
                    $('#sortimen').val(data[21]);
                    $('#spec1').val(data[22]);
                    $('#contractor').val(data[23]);
                    $('#workshift').val(data[24]);
                    $('#rateused').val(data[25]);
                    $('#handling').val(data[26]);

                    $('#myModal5').modal('hide');
                }
            })
        }
    }


</script>
<script>
$(document).ready(function(){
    $('select[name="province"]').on('change', function(){
        var provid = $(this).val();
        if(provid)
        {
            console.log('prov'+provid);
            $.ajax({
                url: '/master/vendor/getcity/'+provid,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $('select[name="city"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="city"]').append('<option value="'+key+'">'+value+'</option>');
                    })
                }
            })
        }
    })
})

$(document).ready(function(){
    $('select[name="city"]').on('change', function(){
        var cityid = $(this).val();
        console.log('cityid'+cityid);
        if(cityid)
        {
            $.ajax({
                url: '/TT/getdistrict/'+cityid,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $('select[name="district"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="district"]').append('<option value="'+key+'">'+value+'</option>');
                    })
                }
            })
        }
    })
})

$(document).ready(function(){
    $('select[name="district"]').on('change', function(){
        var district = $(this).val();
        console.log('district'+district);
        if(district)
        {
            $.ajax({
                url: '/TT/getvillage/'+district,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $('select[name="village"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="village"]').append('<option value="'+key+'">'+value+'</option>');
                    })
                }
            })
        }
    })
})

</script>
<script>
    function get_nmitemgroup(i)
    {
        var result = i.options[i.selectedIndex].text;
        document.getElementById('itemgroup').value = result;
    }
    function isNumber(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        {
            return false;
        }
        return true;
    }
</script>
<script>
    $(document).ready(function () {

        $('.demo1').click(function (e)
        {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(id);
            swal(
            {
                title: "Are you sure want to delete this TT?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                },
                    function (isConfirm)
                    {
                        if (isConfirm)
                        {
                            $.ajax({
                                type : "GET",
                                url : "{{ url('TT/delete')}}" + '/' + id,
                                data : {id:id},
                                success: function (data)
                                {
                                    swal("Done!", "Your data has been delete.", "success");
                                    location.reload();
                                }   
                            });
                        }
                        else
                        {
                            swal("Cancelled", "Your data is safe :)", "error");
                            
                        }
                    }
                );
        }); 
    });
</script>
@endsection