@extends('menu.mainmenu')
@section('title','Receipt ')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Receipt')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('receipt.create') }}">Create</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Update Receipt Log')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection



@section('content')
    
<!-- <div class="row"> -->
    <div class="col-sm-12">
        <div class="ibox-content">
            
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li><a class="nav-link active" data-toggle="tab" href="#tab-1">General</a></li>
                    <li><a class="nav-link {{ request()->is('receipt/info') ? 'active' : null }}" href="{{ url('receipt/info') }}">Additional Info</a></li>
                    <li> <a class="nav-link {{ request()->is('receipt/vendor') ? 'active' : null }}" href="{{ url('receipt/vendor') }}">Vendor </a> </li>
                    <li> <a class="nav-link {{ request()->is('receipt/graderout') ? 'active' : null }}" href="{{ url('receipt/graderout') }}">Grader-Out</a> </li>
                    <li> <a class="nav-link {{ request()->is('receipt/graderin') ? 'active' : null }}" href="{{ url('receipt/graderin') }}">Grader-In</a> </li>
                    <li> <a class="nav-link {{ request()->is('receipt/document') ? 'active' : null }}" href="{{ url('receipt/document') }}">Document</a> </li>
                    <li> <a class="nav-link {{ request()->is('receipt/external') ? 'active' : null }}" href="{{ url('receipt/external') }}">External</a></li>
                    <li> <a class="nav-link {{ request()->is('receipt/invoicing') ? 'active' : null }}" href="{{ url('receipt/invoicing') }}">Invoicing by Parcel </a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                    <!-- <div id="{{ url('receipt/tab-1') }}" class="tab-pane {{ request()->is('receipt/tab-1') ? 'active' : null }}"> -->
                        <div class="panel-body">
                        
                            <form action="{{ route('receipt.updategeneral', ['receipt' => $receipt->id] ) }}" method="POST">
                            @csrf 
                                <div class="row">        
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Code</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" id="id" name="id" readonly class="form-control" value="{{$receipt->id}}">
                                                <input type="text" id="code" name="code" class="form-control" readonly value="{{$receipt->code}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Code TT</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">

                                                    <input type="hidden" class="form-control-sm form-control" id="tt_id" name="tt_id" readonly value="{{$tt_id}}">

                                                    <input type="text" class="form-control-sm form-control" id="tt_code" name="tt_code" readonly value="{{$tt_code}}">
                                                </div>
                                                @error('tt_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">PIM </label>
                                            <div class="col-sm-9">
                                                <div class="input-group">

                                                    <input type="hidden" class="form-control-sm form-control" id="pimid" name="pimid" readonly value="{{$receipt->pimid}}">

                                                    <input type="text" class="form-control-sm form-control" id="codepim" name="codepim" readonly value="{{ $pim }}">

                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">No PIM </label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control-sm form-control" id="nopim" name="nopim" readonly value="{{ $no_pim }}">
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Status</label>
                                            <div class="col-sm-7">
                                                <select class="form-control-sm form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                    <option value="Approved" {{ ($receipt->status === 'Approved') ? 'selected' : '' }}>Approved</option>
                                                    <option value="Hold" {{ ($receipt->status === 'Hold') ? 'selected' : '' }}> Hold</option>
                                                    <option value="Cancel" {{ ($receipt->status === 'Cancel') ? 'selected' : '' }}> Cancel</option>
                                                </select>
                                                @error('status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Item Group</label>
                                            <div class="col-sm-7">
                                                <select class="form-control-sm form-control @error('itemgroup') is-invalid @enderror" id="itemgroup_id" name="itemgroup_id">
                                                    @foreach($itemgroup as $ig)
                                                        <option value="{{$ig->id}}" {{ $ig->id == $receipt->itemgroup_id ?'selected':'' }}> {{$ig->itemgroup_code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('itemgroup')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Division</label>
                                            <div class="col-sm-7">
                                                <select class="form-control-sm form-control @error('division') is-invalid @enderror" id="division" name="division">
                                                    <option value=""> Division </option>
                                                    @foreach($company as $com)
                                                        <option value="{{$com->code}}" {{ $com->code == $receipt->division ?'selected':'' }}>{{$com->code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('division')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="hidden" class="form-control @error('division_id') is-invalid @enderror" id="division_id" name="division_id" readonly>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 b-r">
                                        <h4 class="m-t-none m-b">Instruction</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Apply Date</label>
                                            <div class="col-sm-9">
                                                <div class="input-daterange input-group" >
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type='text' class="form-control datepicker-here @error('applydate') is-invalid @enderror" name="applydate" id="applydate" data-language='en' value="{{$receipt->applydate }}"/>
                                                    @error('applydate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">WarehouseFrom</label>
                                            <div class="col-sm-9">
                                                
                                                    <select class="chosen-select form-control @error('from_warehouse') is-invalid @enderror" name="from_warehouse" id="from_warehouse">
                                                        @foreach($warehouse as $wh)
                                                            <option value="{{$wh->id}}" {{ $wh->id == $receipt->from_warehouse ?'selected':'' }}> {{$wh->warehouse_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('from_warehouse')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">WarehouseTo</label>
                                            <div class="col-sm-9">
                                                <select class="chosen-select form-control @error('to_warehouse') is-invalid @enderror" name="to_warehouse" id="to_warehouse">
                                                        @foreach($warehouse as $wh)
                                                            <option value="{{$wh->id}}" {{ $wh->id == $receipt->to_warehouse ?'selected':'' }}> {{$wh->warehouse_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('to_warehouse')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Objective</label>
                                            <div class="col-sm-9">
                                                <select class="chosen-select form-control @error('objective') is-invalid @enderror" name="objective" id="objective">
                                                        @foreach($objective as $obj)
                                                            <option value="{{$obj->id}}" {{ $obj->id == $receipt->objective ?'selected':'' }}> {{$obj->objective_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('objective')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">PPC</label>
                                            <div class="col-sm-9">
                                                
                                                <input type="text" class="form-control-sm form-control @error('ppc') is-invalid @enderror" name="ppc" id="ppc" value="{{$receipt->ppc}}">
                                                    
                                                @error('ppc')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Remarks</label>
                                            <div class="col-sm-9">
                                                
                                                <select class="chosen-select form-control @error('remarks') is-invalid @enderror" name="remarks" id="remarks">
                                                    @foreach($remarks as $remark)
                                                        <option value="{{$remark->id}}" {{ $remark->id == $receipt->remarks ?'selected':'' }}> {{$remark->name}}</option>
                                                    @endforeach
                                                </select>
                                                    
                                                @error('remarks')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">PO</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" class="form-control" name="po_id" id="po_id" readonly value="{{$po_id}}">
                                                <input type="text" class="form-control-sm form-control @error('po') is-invalid @enderror" name="po" id="po" readonly value="{{$po}}">
                                                    
                                                @error('po')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Procurement</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('procurement') is-invalid @enderror" name="procurement" id="procurement" readonly value="{{$prm}}">
                                                    
                                                @error('procurement')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>

                                        <h4 class="m-t-none m-b">Vendor</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Code</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" class="form-control" id="vendorid" name="vendorid" value="{{$vendor_id}}">
                                                <input type="text" class="form-control-sm form-control @error('code_vendor') is-invalid @enderror" name="code_vendor" id="code_vendor" readonly value="{{$vendor_name}}">
                                                @error('code_vendor')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <!-- TPK -->
                                                <input type="hidden" class="form-control" id="tpkid" name="tpkid" value="{{$tpk_id}}">
                                                <!-- NAME TPK -->
                                                <input type="text" class="form-control-sm form-control @error('vendor') is-invalid @enderror" name="vendor" id="vendor" readonly value="{{$tpkname}}">
                                                @error('vendor')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <h4 class="m-t-none m-b">Concession</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Concession</label>
                                            <div class="col-sm-9">
                                                <!-- //KPH -->
                                                <input type="text" class="form-control-sm form-control @error('concession') is-invalid @enderror" name="concession" id="concession" readonly value="{{$kph}}">
                                                @error('concession')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <h4 class="m-t-none m-b">Beneficiary</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('code_beneficiary') is-invalid @enderror" id="code_beneficiary" name="code_beneficiary" readonly value="{{$receipt->division}}">
                                                   
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('name_beneficiary') is-invalid @enderror" id="name_beneficiary" name="name_beneficiary" readonly value="{{$name_beneficiary}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control @error('address_beneficiary') is-invalid @enderror" id="address_beneficiary" name="address_beneficiary" readonly> {{$address_beneficiary}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Province</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="province_beneficiary" id="province_beneficiary" class="form-control-sm form-control @error('province_beneficiary') is-invalid @enderror" readonly value="{{$name_province}}">
                                            </div>
                                            <div class="col-sm-5">
                                                <input typle="text" name="city_beneficiary" id="city_beneficiary" class="form-control-sm form-control @error('city_beneficiary') is-invalid @enderror" readonly value="{{$name_city}}">
                                            </div>
                                        </div>

                                        <h4 class="m-t-none m-b">Information</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Species</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" class="form-control" id="speciesid" name="speciesid" readonly value="{{$speciesid}}">
                                                <input type="text" class="form-control-sm form-control @error('species') is-invalid @enderror" id="species" name="species" readonly value="{{$species}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">SKSKB No</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('skskb_no') is-invalid @enderror" id="skskb_no" name="skskb_no" readonly value="{{$skskb_no}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">SKSKB Qty</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('skskb_qty') is-invalid @enderror" id="skskb_qty" name="skskb_qty" readonly value="{{$skskb_qty}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">SKSKB M3</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('skskb_m3') is-invalid @enderror" id="skskb_m3" name="skskb_m3" readonly value="{{$skskb_m3}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Parcel</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('parcel') is-invalid @enderror" id="parcel" name="parcel" readonly value="{{$noparcel}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Certificate</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('certificate') is-invalid @enderror" id="certificate" name="certificate" readonly value="{{$certificate}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Perni</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('perni') is-invalid @enderror" id="perni" name="perni" value="{{$receipt->perni}}">
                                                @error('perni')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Fakb/Fako</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control-sm form-control @error('fakb') is-invalid @enderror" id="fakb" name="fakb" value="{{$receipt->fakb}}">
                                                @error('fakb')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row">        
                                    <div class="col-sm-6 b-r">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Document</label>
                                            <div class="col-sm-9">
                                                <textarea id="document" name="document" class="form-control" readonly> {{$doc}} </textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">NPWP</label>
                                            <div class="col-sm-7">
                                                <div class="input-group">
                                                    <input type="text" id="npwp" name="npwp" class="form-control" readonly value="{{$npwp}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Incoterms</label>
                                            <div class="col-sm-7">
                                                <div class="input-group">
                                                    <input type="text" id="incoterms" name="incoterms" class="form-control" readonly value="{{$incoterms}}">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Measurement</label>
                                            <div class="col-sm-9">
                                                    <textarea id="measurement" name="measurement" class="form-control" readonly> {{$measu}}</textarea>
                                               
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">TT No</label>
                                            <div class="col-sm-7">
                                                <div class="input-group">
                                                    <input type="text" id="tt_no" name="tt_no" class="form-control" readonly value="{{$tt_no}}">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Transport No</label>
                                            <div class="col-sm-7">
                                                <div class="input-group">
                                                    <input type="text" id="transport_no" name="transport_no" class="form-control" readonly value="{{$notransport}}">
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6 b-r">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Unit (Size)</label>
                                            <div class="col-sm-9">
                                                <select id="unitsize" name="unitsize" class="chosen-select form-control">
                                                    @foreach($measurement as $ms)
                                                        <option value="{{$ms->id}}" {{ $ms->id == $receipt->unitsize ?'selected':'' }}> {{$ms->measurement_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Unit (Price)</label>
                                            <div class="col-sm-9">
                                                <select id="unitprice" name="unitprice" class="chosen-select form-control">
                                                    @foreach($measurement as $ms)
                                                        <option value="{{$ms->id}}" {{ $ms->id == $receipt->unitprice ?'selected':'' }}> {{$ms->measurement_name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Source Price</label>
                                            <!-- 0 = PurchaseOrder / 1 = HJD Detail -->
                                            <div class="i-checks col-sm-9">
                                                <label> <input type="radio" id="source_price" name="source_price" value="0" {{ $receipt->source_price == '0' ? 'checked' : ''}}> <i></i> Purchase Order </label>
                                                &nbsp
                                                <label> <input type="radio" id="source_price" name="source_price" value="1" {{ $receipt->source_price == '1' ? 'checked' : ''}}> <i></i> HJD Detail </label>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <br>
                            <div class="row">
                            <div class="col-sm-6 b-r">
                                <h4 class="m-t-none m-b">Invoicing</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PPh23</label>
                                    <div class="col-sm-9">

                                        <select class="chosen-select form-control @error('pph23') is-invalid @enderror" name="pph23" id="pph23">
                                                @foreach($taxs as $tax)
                                                    <option value="{{$tax->id}}" {{ $tax->id == $receipt->pph23 ?'selected':'' }} > {{$tax->name}}</option>
                                                @endforeach
                                        </select>
                                        @error('pph23')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PPh22</label>
                                    <div class="col-sm-9">
                                        <select class="chosen-select form-control @error('pph22') is-invalid @enderror" name="pph22" id="pph22">
                                                @foreach($taxs as $t)
                                                    <option value="{{$t->id}}"  {{ $t->id == $receipt->pph22 ?'selected':'' }}> {{$t->name}}</option>
                                                @endforeach
                                        </select>
                                        @error('pph22')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PPh21</label>
                                    <div class="col-sm-9">
                                        <select class="chosen-select form-control @error('pph21') is-invalid @enderror" name="pph21" id="pph21">
                                                @foreach($taxs as $tax)
                                                    <option value="{{$tax->id}}"  {{ $tax->id == $receipt->pph21 ?'selected':'' }}> {{$tax->name}}</option>
                                                @endforeach
                                        </select>
                                        @error('pph21')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">PPN</label>
                                    <div class="col-sm-9">
                                        <select class="chosen-select form-control @error('ppn') is-invalid @enderror" name="ppn" id="ppn">
                                                @foreach($taxs as $tax)
                                                    <option value="{{$tax->id}}" {{ $tax->id == $receipt->ppn ?'selected':'' }}> {{$tax->name}}</option>
                                                @endforeach
                                        </select>
                                        @error('ppn')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="m-t-none m-b">Description</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Trucking</label>
                                    <div class="col-sm-9">
                                        <input type='text' class="form-control form-control-sm @error('trucking') is-invalid @enderror" name="trucking" id="trucking" value="{{$receipt->trucking}}"/>
                                        @error('trucking')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Administration</label>
                                    <div class="col-sm-9">
                                        <input type='text' class="form-control form-control-sm @error('pph23') is-invalid @enderror" name="administration" id="administration" value="{{$receipt->administration}}"/>
                                        @error('administration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Lain-lain</label>
                                    <div class="col-sm-9">
                                        <input type='text' class="form-control form-control-sm @error('lainlain') is-invalid @enderror" name="lainlain" id="lainlain" value="{{$receipt->lainlain}}"/>
                                        @error('lainlain')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Unit (trucking) </label>
                                    <div class="col-sm-9">
                                        <select class="chosen-select form-control @error('unit_trucking') is-invalid @enderror" name="unit_trucking" id="unit_trucking">
                                            @foreach($measurement as $me)
                                                <option value="{{ $me->id}}"  {{ $me->id == $receipt->unit_trucking ?'selected':'' }}> {{$me->measurement_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('unit_trucking')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                            <br>

                                <div class="form-group row">
                                    <div class="col-lg-12 text-center">
                                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                        <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="panel-body">
                            <label class="col-sm-2 col-form-label"> <b> List General </b> </label>
                                
                                
                                <div class="table-responsive">
                                    <table id="example" class="footable table-bordered toggle-arrow-tiny dataTables-example">
                                        <thead>
                                            <tr>
                                                <th data-toggle="true"> Number</th>
                                                <th> Apply Date </th>
                                                <th> TT</th>
                                                <th> PIM</th>
                                                <th> PIM No </th>
                                                <th> Parcel </th>
                                                <th data-hide="all"> Status</th>
                                                <th data-hide="all"> Item Group</th>
                                                <th data-hide="all"> Division</th>
                                                <th data-hide="all"> Warehouse</th>
                                                <th data-hide="all"> Objective</th>
                                                <th> PPC</th>
                                                <th> Remarks</th>
                                                <th> Perni</th>
                                                <th> FAKB</th>
                                                <th> Unit Size</th>
                                                <th> Unit Price</th>
                                                <th> Source Price</th>

                                                <th data-hide="all"> PPh23</th>
                                                <th data-hide="all"> PPh22</th>
                                                <th data-hide="all"> PPh21</th>
                                                <th data-hide="all"> PPn</th>
                                                <th data-hide="all"> Trucking</th>
                                                <th data-hide="all"> Administration</th>
                                                <th data-hide="all"> Lain-lain</th>
                                                <th data-hide="all"> Unit Trucking</th>

                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($receipts as $r)
                                            <tr>
                                                <td> {{ $r->code}}</td>
                                                <td> {{ $r->applydate }}</td>
                                                <td> {{ implode(',', $r->tts()->get()->pluck('code_tt')->toArray()) }}</td>
                                                <td> {{ implode(',', $r->pims()->get()->pluck('code_pim')->toArray()) }} </td>
                                                <td> {{ implode(',', $r->pims()->get()->pluck('pimno')->toArray()) }} </td>
                                                <td> {{ implode(',', $r->pims()->get()->pluck('noparcel')->toArray()) }}</td>
                                                <td> {{ $r->status }} </td>
                                                <td> {{ implode(',', $r->itemgroup()->get()->pluck('itemgroup_name')->toArray()) }} </td>
                                                <td> {{ $r->division }} </td>
                                                <td> From {{ implode(',', $r->warehouseFrom()->get()->pluck('warehouse_name')->toArray()) }}. To {{ implode(',', $r->warehouseTo()->get()->pluck('warehouse_name')->toArray()) }}</td>
                                                <td> {{ implode(',', $r->objective()->get()->pluck('objective_name')->toArray()) }} </td>
                                                <td> {{ $r->ppc }} </td>
                                                <td> {{ implode(',', $r->remarks()->get()->pluck('name')->toArray()) }}</td>
                                                <td> {{ $r->perni }} </td>
                                                <td> {{ $r->fakb }} </td>
                                                <td> {{ implode(',', $r->measu()->get()->pluck('measurement_name')->toArray()) }} </td>
                                                <td> {{ implode(',', $r->measur()->get()->pluck('measurement_name')->toArray()) }} </td>
                                                <td> 
                                                    @if($r->source_price == '0')
                                                        Purchase Order
                                                    @else
                                                        HJD Detail
                                                    @endif
                                                </td>
                                                <td> {{ implode(',', $r->pph23()->get()->pluck('name')->toArray()) }} </td>
                                                <td> {{ implode(',', $r->pph22()->get()->pluck('name')->toArray()) }} </td>
                                                <td> {{ implode(',', $r->pph21()->get()->pluck('name')->toArray()) }} </td>
                                                <td> {{ implode(',', $r->ppn()->get()->pluck('name')->toArray()) }} </td>
                                                <td> {{ $r->trucking}}</td>
                                                <td> {{ $r->administration}}</td>
                                                <td> {{ $r->lainlain}}</td>
                                                <td>  {{ implode(',', $r->unitrucking()->get()->pluck('measurement_code')->toArray()) }}</td>
                                                <td align=center> 
                                                    <a href="{{ route('receipt.editgeneral', $r->id) }}" class='float-center' title="Edit">
                                                        <i class="fa fa-edit"> </i>
                                                    </a>
                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                               
                                
                            
                        </div>
                    </div>

                    <div id="{{ url('receipt/info') }}" class="tab-pane {{ request()->is('receipt/info') ? 'active' : null }}">
                        <div class="panel-body">
                           
                            <span id="result"></span>

                            <div class="row">        
                                <div class="col-sm-6 b-r">
                                    <!-- <form action="{{ route('receipt.storegraderin') }}" method="POST" id="dynamicformgraderin"> -->
                                    <form method="POST" id="dynamicformgraderin">
                                    @csrf 

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">No Receipt Log</label>
                                            <div class="col-sm-9">
                                                <select id="noreceiptlog" name="noreceiptlog" class="chosen-select form-control">
                                                    @foreach($remarks as $remark)
                                                        <option vlaue="{{$remark->id}}"> {{$remark->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <h4 class="m-t-none m-b">Grader In</h4>
                                        <div class="form-group row">
                                            
                                            <div class="col-sm-12">
                                                <table class="table table-stripped" id="tblgraderin">
                                                    <thead>
                                                        <th width="50%"> Name </th>
                                                        <th width="50%"> Location </th>
                                                    </thead>
                                                    <tbody id="bodygraderin">
                                                        <tr>
                                                            <td> </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot id="footgraderin">
                                                        <tr>
                                                            <!-- <td> <button class="btn btn-primary btn-sm" type="submit" id="savegraderin">Save</button> </td> -->
                                                            <td> <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" /></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-6">
                                    <form method="POST" id="dynamicformgraderout">
                                    @csrf 

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">No Receipt Log</label>
                                            <div class="col-sm-9">
                                                <!-- <input type="text" class="form-control" id="noreceiptlog_graderout" name="noreceiptlog_graderout" value="2"> -->
                                                <select id="noreceiptlog_graderout" name="noreceiptlog_graderout" class="chosen-select form-control">
                                                    @foreach($receipts as $r)
                                                        <option value="{{$r->id}}"> {{$r->code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <h4 class="m-t-none m-b">Grader Out</h4>
                                        <div class="form-group row">
                                            
                                            <div class="col-sm-12">
                                                <table class="table table-stripped" id="tblgraderout">
                                                    <thead>
                                                        <th width="50%"> Name </th>
                                                        <th width="50%"> Location </th>
                                                    </thead>
                                                    <tbody id="bodygraderout">
                                                        <tr>
                                                            <td> </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot id="footgraderout">
                                                        <tr>
                                                            <td> <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" /></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="grader_receipt" class="footable table-bordered dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> No Receipt Log </th>
                                            <th> Name </th>
                                            <th> Location </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($rgrader as $rg)
                                            <tr>
                                                <td> {{ implode(',', $rg->receiptlog()->get()->pluck('code')->toArray()) }}</td>
                                                <td> {{$rg->name}}</td>
                                                <td> {{$rg->location}}</td>
                                                <td> 
                                                    @if( $rg->statusgrader == '0' )
                                                        Grader In
                                                    @else
                                                        Grader Out
                                                    @endif
                                                </td>
                                                <td align="center"> <a class="demo2" data-id="{{$rg->id}}" title="Delete"> <i class="fa fa-trash text-red"> </i></a></td>
                                            </tr>
                                        
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div id="{{ url('receipt/vendor') }}" class="tab-pane {{ request()->is('receipt/vendor') ? 'active' : null }}">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No Receipt Log </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        
                                        <input type="text" class="form-control" id="code_receipt" name="code_receipt" readonly>

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>
                            <button data-toggle="button" class="btn btn-primary btn-outline" type="button" id="export_vendorreceipt" value="">Export</button>

                            <form action="{{ route('receipt.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="import_file" >
                                <input type="submit" class="btn btn-primary btn-outline" value="Import">
                            </form>
                            <br>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="vendor_receipt" class="footable table-bordered dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> Code </th>
                                            <th> NextMap</th>
                                            <th> No Kayu</th>
                                            <th> Dia</th>
                                            <th> Length</th>
                                            <th> Height</th>
                                            <th> Width</th>
                                            <th> M3</th>
                                            <th> Barcode</th>
                                            <th> No Pohon</th>
                                            <th> No Petak</th>
                                            <th> Quality </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rvendors as $rv)
                                        <tr>
                                            <td> {{ implode(',', $rv->receiptlog()->get()->pluck('code')->toArray()) }} </td>
                                            <td> {{$rv->nextmap}} </td>
                                            <td> {{$rv->nokayu}} </td>
                                            <td> {{$rv->dia}} </td>
                                            <td> {{$rv->length}} </td>
                                            <td> {{$rv->height}} </td>
                                            <td> {{$rv->width}} </td>
                                            <td> {{$rv->m3}} </td>
                                            <td> {{$rv->nobarcode}} </td>
                                            <td> {{$rv->nopohon}} </td>
                                            <td> {{$rv->nopetak}} </td>
                                            <td> {{$rv->quality}} </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>

                    <div id="{{ url('receipt/graderout') }}" class="tab-pane {{ request()->is('receipt/graderout') ? 'active' : null }}">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No Receipt Log </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        
                                        <input type="text" class="form-control" id="code_receipt2" name="code_receipt2" readonly>

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>
                            <button data-toggle="button" class="btn btn-primary btn-outline" type="button" id="export_graderoutreceipt" value="">Export</button>

                            <form action="{{ route('receipt.importgraderout') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="importgraderout_file" >
                                <input type="submit" class="btn btn-primary btn-outline" value="Import">
                            </form>
                            <br>
                           
                            <br>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="graderout_receipt" class="footable table-bordered dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> Code </th>
                                            <th> NextMap</th>
                                            <th> No Kayu</th>
                                            <th> Kwt</th>
                                            <th> Dia 1</th>
                                            <th> Dia 2</th>
                                            <th> Dia 3</th>
                                            <th> Dia 4</th>
                                            <th> Dia Avg</th>
                                            <th> Class</th>
                                            <th> Height Full</th>
                                            <th> Width Full</th>
                                            <th> Len Full</th>
                                            <th> Len Min</th>
                                            <th> Len Nett</th>
                                            <th> Height Trim</th>
                                            <th> Width Trim</th>
                                            <th> Len Gr</th>
                                            <th> Len Km</th>
                                            <th> Len Trim</th>
                                            <th> Height Min</th>
                                            <th> Height Nett</th>
                                            <th> Width Min</th>
                                            <th> Width Nett</th>
                                            <th> P Len</th>
                                            <th> P M3</th>
                                            <th> Dia Gr</th>
                                            <th> No Barcode</th>
                                            <th> No Pohon</th>
                                            <th> No Petak</th>
                                            <th> PO Price</th>
                                            <th> Gross Price</th>
                                            <th> Discount%</th>
                                            <th> Discount Value</th>
                                            <th> Surcharges%</th>
                                            <th> Surcharges Value</th>
                                            <th> Adj</th>
                                            <th> Dia 1 (teras)</th>
                                            <th> Dia 2 (teras)</th>
                                            <th> Dia 3 (teras)</th>
                                            <th> Dia 4 (teras)</th>
                                            <th> Dia Avg (teras)</th>
                                            <th> P M3 (teras)</th>
                                            <th> PO Price (teras)</th>
                                            <th> Gross Price (teras)</th>
                                            <th> Discount% (teras)</th>
                                            <th> Discount Value (teras)</th>
                                            <th> Surcharges% Value</th>
                                            <th> Adj% (teras)</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rgraderout as $ro)
                                        <tr>
                                            <td> {{ implode(',', $ro->receiptlog()->get()->pluck('code')->toArray()) }} </td>
                                            <td> {{$ro->nextmap}} </td>
                                            <td> {{$ro->nokayu}} </td>
                                            <td> {{$ro->kwt}} </td>
                                            <td> {{$ro->dia1}} </td>
                                            <td> {{$ro->dia2}} </td>
                                            <td> {{$ro->dia3}} </td>
                                            <td> {{$ro->dia4}} </td>
                                            <td> {{$ro->dia_avg}} </td>
                                            <td> {{$ro->class}} </td>
                                            <td> {{$ro->heightfull}} </td>
                                            <td> {{$ro->widthfull}} </td>
                                            <td> {{$ro->lenfull}} </td>
                                            <td> {{$ro->lenmin}} </td>
                                            <td> {{$ro->lennett}} </td>
                                            <td> {{$ro->heighttrim}} </td>
                                            <td> {{$ro->widthtrim}} </td>
                                            <td> {{$ro->lengr}} </td>
                                            <td> {{$ro->lenkm}} </td>
                                            <td> {{$ro->lentrim}} </td>
                                            <td> {{$ro->heightmin}} </td>
                                            <td> {{$ro->heightnett}} </td>
                                            <td> {{$ro->widthmin}} </td>
                                            <td> {{$ro->widthnett}} </td>
                                            <td> {{$ro->p_len}} </td>
                                            <td> {{$ro->p_m3}} </td>
                                            <td> {{$ro->dia_gr}} </td>
                                            <td> {{$ro->nobarcode}} </td>
                                            <td> {{$ro->nopohon}} </td>
                                            <td> {{$ro->nopetak}} </td>
                                            <td> {{$ro->po_price}} </td>
                                            <td> {{$ro->gross_price }} </td>
                                            <td> {{$ro->discount }} </td>
                                            <td> {{$ro->discount_value}} </td>
                                            <td> {{$ro->surcharges }} </td>
                                            <td> {{$ro->surcharges_value }}</td>
                                            <td> {{$ro->adj}} </td>
                                            <td> {{$ro->dia1_teras}} </td>
                                            <td> {{$ro->dia2_teras}} </td>
                                            <td> {{$ro->dia3_teras}} </td>
                                            <td> {{$ro->dia4_teras}} </td>
                                            <td> {{$ro->diaavg_teras}} </td>
                                            <td> {{$ro->p_m3_teras}} </td>
                                            <td> {{$ro->po_price_teras}}</td>
                                            <td> {{$ro->gross_price_teras}}</td>
                                            <td> {{$ro->discount_teras}}</td>
                                            <td> {{$ro->discountvalue_teras}}</td>
                                            <td> {{$ro->surcharges_value_teras}}</td>
                                            <td> {{$ro->adj_teras}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="{{ url('receipt/graderin') }}" class="tab-pane {{ request()->is('receipt/graderin') ? 'active' : null }}">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No Receipt Log </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        
                                        <input type="text" class="form-control" id="code_receipt3" name="code_receipt3" readonly>

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>
                            <button data-toggle="button" class="btn btn-primary btn-outline" type="button" id="export_graderinreceipt" value="">Export</button>

                            <form action="{{ route('receipt.importgraderin') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="importgraderin_file" >
                                <input type="submit" class="btn btn-primary btn-outline" value="Import">
                            </form>
                            <br>
                           
                            <br>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="graderin_receipt" class="footable table-bordered dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> Code </th>
                                            <th> NextMap</th>
                                            <th> No Kayu</th>
                                            <th> Kwt</th>
                                            <th> Dia 1</th>
                                            <th> Dia 2</th>
                                            <th> Dia 3</th>
                                            <th> Dia 4</th>
                                            <th> Dia Avg</th>
                                            <th> Class</th>
                                            <th> Height Full</th>
                                            <th> Width Full</th>
                                            <th> Len Full</th>
                                            <th> Len Min</th>
                                            <th> Len Nett</th>
                                            <th> Height Trim</th>
                                            <th> Width Trim</th>
                                            <th> Len Gr</th>
                                            <th> Len Km</th>
                                            <th> Len Trim</th>
                                            <th> Height Min</th>
                                            <th> Height Nett</th>
                                            <th> Width Min</th>
                                            <th> Width Nett</th>
                                            <th> P Len</th>
                                            <th> P M3</th>
                                            <th> Dia Gr</th>
                                            <th> No Barcode</th>
                                            <th> No Pohon</th>
                                            <th> No Petak</th>
                                            <th> PO Price</th>
                                            <th> Gross Price</th>
                                            <th> Discount%</th>
                                            <th> Discount Value</th>
                                            <th> Surcharges%</th>
                                            <th> Surcharges Value</th>
                                            <th> Adj</th>
                                            <th> Dia 1 (teras)</th>
                                            <th> Dia 2 (teras)</th>
                                            <th> Dia 3 (teras)</th>
                                            <th> Dia 4 (teras)</th>
                                            <th> Dia Avg (teras)</th>
                                            <th> P M3 (teras)</th>
                                            <th> PO Price (teras)</th>
                                            <th> Gross Price (teras)</th>
                                            <th> Discount% (teras)</th>
                                            <th> Discount Value (teras)</th>
                                            <th> Surcharges% Value</th>
                                            <th> Adj% (teras)</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rgraderin as $ri)
                                        <tr>
                                            <td> {{ implode(',', $ri->receiptlog()->get()->pluck('code')->toArray()) }} </td>
                                            <td> {{$ri->nextmap}} </td>
                                            <td> {{$ri->nokayu}} </td>
                                            <td> {{$ri->kwt}} </td>
                                            <td> {{$ri->dia1}} </td>
                                            <td> {{$ri->dia2}} </td>
                                            <td> {{$ri->dia3}} </td>
                                            <td> {{$ri->dia4}} </td>
                                            <td> {{$ri->dia_avg}} </td>
                                            <td> {{$ri->class}} </td>
                                            <td> {{$ri->heightfull}} </td>
                                            <td> {{$ri->widthfull}} </td>
                                            <td> {{$ri->lenfull}} </td>
                                            <td> {{$ri->lenmin}} </td>
                                            <td> {{$ri->lennett}} </td>
                                            <td> {{$ri->heighttrim}} </td>
                                            <td> {{$ri->widthtrim}} </td>
                                            <td> {{$ri->lengr}} </td>
                                            <td> {{$ri->lenkm}} </td>
                                            <td> {{$ri->lentrim}} </td>
                                            <td> {{$ri->heightmin}} </td>
                                            <td> {{$ri->heightnett}} </td>
                                            <td> {{$ri->widthmin}} </td>
                                            <td> {{$ri->widthnett}} </td>
                                            <td> {{$ri->p_len}} </td>
                                            <td> {{$ri->p_m3}} </td>
                                            <td> {{$ri->dia_gr}} </td>
                                            <td> {{$ri->nobarcode}} </td>
                                            <td> {{$ri->nopohon}} </td>
                                            <td> {{$ri->nopetak}} </td>
                                            <td> {{$ri->po_price}} </td>
                                            <td> {{$ri->gross_price }} </td>
                                            <td> {{$ri->discount }} </td>
                                            <td> {{$ri->discount_value}} </td>
                                            <td> {{$ri->surcharges }} </td>
                                            <td> {{$ri->surcharges_value }}</td>
                                            <td> {{$ri->adj}} </td>
                                            <td> {{$ri->dia1_teras}} </td>
                                            <td> {{$ri->dia2_teras}} </td>
                                            <td> {{$ri->dia3_teras}} </td>
                                            <td> {{$ri->dia4_teras}} </td>
                                            <td> {{$ri->diaavg_teras}} </td>
                                            <td> {{$ri->p_m3_teras}} </td>
                                            <td> {{$ri->po_price_teras}}</td>
                                            <td> {{$ri->gross_price_teras}}</td>
                                            <td> {{$ri->discount_teras}}</td>
                                            <td> {{$ri->discountvalue_teras}}</td>
                                            <td> {{$ri->surcharges_value_teras}}</td>
                                            <td> {{$ri->adj_teras}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>

                    <div id="{{ url('receipt/document') }}" class="tab-pane {{ request()->is('receipt/document') ? 'active' : null }}">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No Receipt Log </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        
                                        <input type="text" class="form-control" id="code_receipt4" name="code_receipt4" readonly>

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>
                            <button data-toggle="button" class="btn btn-primary btn-outline" type="button" id="export_documentreceipt" value="">Export</button>

                            <form action="{{ route('receipt.importdocument') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="importdocument_file" >
                                <input type="submit" class="btn btn-primary btn-outline" value="Import">
                            </form>
                            <br>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="document_receipt" class="footable table-bordered dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> Code </th>
                                            <th> NextMap</th>
                                            <th> No Kayu</th>
                                            <th> Dia</th>
                                            <th> Length</th>
                                            <th> Height</th>
                                            <th> Width</th>
                                            <th> M3</th>
                                            <th> Barcode</th>
                                            <th> No Pohon</th>
                                            <th> No Petak</th>
                                            <th> Quality </th>
                                            <th> No Kapling</th>
                                            <th> No BP</th>
                                            <th> Umur Kapling </th>
                                            <th> Kayu No2</th>
                                            <th> Partai BP</th>
                                            <th> Asal Tahun</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rdocument as $rd)
                                        <tr>
                                            <td> {{ implode(',', $rd->receiptlog()->get()->pluck('code')->toArray()) }} </td>
                                            <td> {{$rd->nextmap}} </td>
                                            <td> {{$rd->nokayu}} </td>
                                            <td> {{$rd->dia}} </td>
                                            <td> {{$rd->length}} </td>
                                            <td> {{$rd->height}} </td>
                                            <td> {{$rd->width}} </td>
                                            <td> {{$rd->m3}} </td>
                                            <td> {{$rd->nobarcode }} </td>
                                            <td> {{$rd->nopohon }} </td>
                                            <td> {{$rd->nopetak }} </td>
                                            <td> {{$rd->quality }} </td>
                                            <td> {{$rd->nokapling}}</td>
                                            <td> {{$rd->nobp}}</td>
                                            <td> {{$rd->umurkapling}}</td>
                                            <td> {{$rd->kayuno2}}</td>
                                            <td> {{$rd->partaibp}}</td>
                                            <td> {{$rd->asaltahun}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>

                    <div id="{{ url('receipt/external') }}" class="tab-pane {{ request()->is('receipt/external') ? 'active' : null }}">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No Receipt Log </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="code_receipt5" name="code_receipt5" readonly>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-outline" type="button" id="view_external" value="">View</button>
                            <button data-toggle="button" class="btn btn-primary btn-outline" type="button" id="generate_itemcode" value="">Generate Receipt</button>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="external_receipt" class="footable table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Code </th>
                                            <th> NextMap</th>
                                            <th> No Product</th>
                                            <th> No Kayu (doc)</th>
                                            <th> Dia (doc)</th>
                                            <th> Length (doc)</th>
                                            <th> Height (doc)</th>
                                            <th> Width (doc)</th>
                                            <th> M3 (doc)</th>
                                            <th> Barcode (doc)</th>
                                            <th> No Pohon (doc)</th>
                                            <th> No Petak (doc)</th>
                                            <th> Quality (doc)</th>
                                            <th> No Kapling (doc)</th>
                                            <th> No BP (doc)</th>
                                            <th> Umur Kapling (doc)</th>
                                            <th> Kayu no2 (doc)</th>
                                            <th> Partai BP (doc)</th>
                                            <th> Asal Tahun (doc) </th>

                                            <th> No Kayu (ven)</th>
                                            <th> Dia (ven)</th>
                                            <th> Length (ven)</th>
                                            <th> Height (ven)</th>
                                            <th> Width (ven)</th>
                                            <th> M3 (ven)</th>
                                            <th> Barcode (ven)</th>
                                            <th> No Pohon (ven)</th>
                                            <th> No Petak (ven)</th>
                                            <th> Quality (ven)</th>

                                            <th> No Kayu</th>
                                            <th> Kwt</th>
                                            <th> Dia 1</th>
                                            <th> Dia 2</th>
                                            <th> Dia 3</th>
                                            <th> Dia 4</th>
                                            <th> Dia Avg</th>
                                            <th> Class</th>
                                            <th> Height Full</th>
                                            <th> Width Full</th>
                                            <th> Len Full</th>
                                            <th> Len Min</th>
                                            <th> Len Nett</th>
                                            <th> Height Trim</th>
                                            <th> Width Trim</th>
                                            <th> Len Gr</th>
                                            <th> Len Km</th>
                                            <th> Len Trim</th>
                                            <th> Height Min</th>
                                            <th> Height Nett</th>
                                            <th> Width Min</th>
                                            <th> Width Nett</th>
                                            <th> P Len</th>
                                            <th> P M3</th>
                                            <th> Dia Gr</th>
                                            <th> No Barcode</th>
                                            <th> No Pohon</th>
                                            <th> No Petak</th>
                                            <th> PO Price</th>
                                            <th> Gross Price</th>
                                            <th> Discount%</th>
                                            <th> Discount Value</th>
                                            <th> Surcharges%</th>
                                            <th> Surcharges Value</th>
                                            <th> Adj</th>
                                            <th> Dia 1 (teras)</th>
                                            <th> Dia 2 (teras)</th>
                                            <th> Dia 3 (teras)</th>
                                            <th> Dia 4 (teras)</th>
                                            <th> Dia Avg (teras)</th>
                                            <th> P M3 (teras)</th>
                                            <th> PO Price (teras)</th>
                                            <th> Gross Price (teras)</th>
                                            <th> Discount% (teras)</th>
                                            <th> Discount Value (teras)</th>
                                            <th> Surcharges% Value</th>
                                            <th> Adj% (teras)</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="{{ url('receipt/invoicing') }}" class="tab-pane {{ request()->is('receipt/invoicing') ? 'active' : null }}">
                   

                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No Receipt Log </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="code_receipt6" name="code_receipt6" readonly>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- //UNIT PRICING -->
                            <!-- <button class="btn btn-primary btn-sm btn-outline"> -->
                            <!-- //PRICING PO -->
                            <button class="btn btn-primary btn-sm btn-outline" type="button" id="generate_pricing" name="generate_pricing">Generate Pricing</button>
                            <!-- //INVOICING -->
                            <button class="btn btn-primary btn-sm btn-outline" type="button" id="generate_invoicing">Generate Invoicing</button>

                        

                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="invoicing_receipt" class="footable table-bordered dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> No Receipt Log </th>
                                            <th> Range Diameter</th>
                                            <th> Range Length</th>
                                            <th> Quality</th>
                                            <th> Sortimen</th>
                                            <th> Kph Type</th>

                                            <th> Price</th>

                                            <th> Graderin Qty</th>
                                            <th> Graderin M3</th>
                                            <th> Graderin TotPrice</th>

                                            <th> Graderout Qty</th>
                                            <th> Graderout M3</th>
                                            <th> Graderout TotPrice</th>

                                            <th> Vendor Qty</th>
                                            <th> Vendor M3</th>
                                            <th> Vendor TotPrice</th>

                                            <th> Document Qty</th>
                                            <th> Document M3</th>
                                            <th> Document TotPrice</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoicing as $inv)
                                        <tr>
                                            <td> {{ implode(',', $inv->receiptlog()->get()->pluck('code')->toArray()) }} </td>
                                            <td> {{ $inv->range_size }} </td>
                                            <td> {{ $inv->range_length }} </td>
                                            <td> {{ implode(',', $inv->quality()->get()->pluck('quality_code')->toArray()) }} </td>
                                            <td> {{ implode(',', $inv->sortimen()->get()->pluck('code')->toArray()) }} </td>
                                            <td> {{ implode(',', $inv->kphtype()->get()->pluck('code')->toArray()) }} </td>
                                            <td> {{ $inv->price }}</td>
                                            <td> {{ $inv->in_qty }}</td>
                                            <td> {{ $inv->in_m3 }}</td>
                                            <td> {{ $inv->in_totprice }}</td>

                                            <td> {{ $inv->out_qty }}</td>
                                            <td> {{ $inv->out_m3 }}</td>
                                            <td> {{ $inv->out_totprice }}</td>

                                            <td> {{ $inv->ven_qty }}</td>
                                            <td> {{ $inv->ven_m3 }}</td>
                                            <td> {{ $inv->ven_totprice }}</td> 

                                            <td> {{ $inv->doc_qty }}</td>
                                            <td> {{ $inv->doc_m3 }}</td>
                                            <td> {{ $inv->doc_totprice }}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    
                </div>
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
                                <th data-toggle="true"> Apply Date </th>
                                <th>PIM</th>
                                <th>No PIM</th>
                                <th>TT</th>
                                <th>No TT</th>
                                <th>No Form</th>
                                <th data-hide="all"> No Document</th>
                                <th data-hide="all"> No Dok Asal</th>
                                <th> PO</th>
                                <th> Spesies</th>
                                <th> Sortimen</th>
                                <th> No Parcel</th>
                                <th> Vendor</th>
                                
                                <th> Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pims as $pim)
                            <tr>
                                <td> {{ $pim->applydate }} </td>
                                <td> {{ $pim->code_pim }} </td>
                                <td> {{ $pim->pimno }} </td>
                                <td> {{ implode(',', $pim->tandaterima()->get()->pluck('code_tt')->toArray()) }} </td>
                                <td> {{ implode(',', $pim->tandaterima()->get()->pluck('tt_no')->toArray()) }} </td>
                                <td> {{ implode(',', $pim->tandaterima()->get()->pluck('form_no')->toArray()) }} </td>
                                <td> {{ implode(',', $pim->tandaterima()->get()->pluck('no_document')->toArray()) }} </td>
                                <td> {{ implode(',', $pim->tandaterima()->get()->pluck('no_dokumen')->toArray()) }} </td>
                                <td> {{ implode(',', $pim->po()->get()->pluck('code')->toArray()) }}</td>
                                <td> {{ implode(',', $pim->po()->get()->pluck('speciess')->toArray()) }}</td>
                                <td> {{ $pim->sortimen }}</td>
                                <td> {{$pim->noparcel}}</td>
                                <td> {{ implode(',', $pim->vendor()->get()->pluck('name_vendor')->toArray()) }} {{ implode(',', $pim->tpk()->get()->pluck('name_tpk')->toArray()) }} </td>
                                <td align=center> 
                                    <a class='selectpim' id="selectpim" data-id="{{$pim->id}}" title="Choose">                        
                                        <i class="fa fa-check-square-o"> </i>
                                    </a>
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

<!-- //MODAL SEARCH NO-RECEIPT LOG -->
<div class="modal inmodal fade" id="myModal1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Receipt Log</h4>
               
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <th data-toggle="true"> No Receipt Log </th>
                                <th>PIM</th>
                                <th>No PIM</th>

                                <th>TT</th>
                                <th>No TT</th>
                                <th>Species</th>
                                <!-- <th> PO</th> -->
                                <th data-hide="all"> No Document</th>
                                <th> Sortimen</th>
                                <th> No Parcel</th>
                                <!-- <th> Vendor</th> -->
                                
                                <th> Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receipts as $rc)
                            <tr>
                                <td> {{ $rc->code }} </td>
                                <td> {{ implode(',', $rc->pim()->get()->pluck('code_pim')->toArray()) }} </td>
                                <td> {{ implode(',', $rc->pim()->get()->pluck('pimno')->toArray()) }} </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>

                                <td> {{ implode(',', $pim->tandaterima()->get()->pluck('form_no')->toArray()) }} </td>
                                
                                <td> {{ implode(',', $rc->pim()->get()->pluck('sortimen')->toArray()) }} </td>
                                <td> {{ implode(',', $rc->pim()->get()->pluck('noparcel')->toArray()) }} </td>
                               
                                <td align=center> 
                                    <a class='select_receiptlog' id="select_receiptlog" data-id="{{$rc->id}}" title="Choose">                        
                                        <i class="fa fa-check-square-o"> </i>
                                    </a>
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
        $('#generate_itemcode').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/generate_itemcode/"+id;
                // $.ajax({
                //     url: '/receipt/generate_itemcode/'+id,
                //     type: 'GET',
                //     dataType: 'json',
                //     success: function(data){
                //         console.log(data);
                //     }
                // })
            }
            // return false;
        })
    })
</script>
<script>
    // $(document).ready(function(){
    //     $('#generate_itemcode').on('click', function(e){
    //         e.preventDefault();
    //         // var id = $(this).val();
    //         // if(id)
    //         // {
    //         //     console.log('idnya = '+id);
               
    //                 $('#external_receipt').DataTable({
    //                     "processing": true,
    //                     "serverSide": true,
    //                     "ajax": "{{ route('receipt.view_external') }}",
    //                     "columns":[
    //                         // { "data": "nextmap"},
    //                         // { "data": "receiptlog_id"}
    //                         { "data": "code"},
    //                         { "data": "enextmap"},
    //                         { "data": "enoproduct"},
    //                         { "data": "dnokayu"},
    //                         { "data": "ddia"},
    //                         { "data": "dlength"},
    //                         { "data": "dheight"},
    //                         { "data": "dwidth"},
    //                         { "data": "dm3"},
    //                         { "data": "dnobarcode"},
    //                         { "data": "dnopohon"},
    //                         { "data": "dnopetak"},
    //                         { "data": "dquality"},
    //                         { "data": "dnokapling"},
    //                         { "data": "dnobp"},
    //                         { "data": "dumurkapling"},
    //                         { "data": "dkayuno2"},
    //                         { "data": "dpartaibp"},
    //                         { "data": "dasaltahun"},
    //                         { "data": "vnokayu"},
    //                         { "data": "vdia"},
    //                         { "data": "vlength"},
    //                         { "data": "vheight"},
    //                         { "data": "vwidth"},
    //                         { "data": "vm3"},
    //                         { "data": "vnobarcode"},
    //                         { "data": "vnopohon"},
    //                         { "data": "vnopetak"},
    //                         { "data": "vquality"},
    //                         { "data": "innokayu"},
    //                         { "data": "inkwt"},
    //                         { "data": "india1"},
    //                         { "data": "india2"},
    //                         { "data": "india3"},
    //                         { "data": "india4"},
    //                         { "data": "indiaavg"},
    //                         { "data": "inclass"},
    //                         { "data": "inheightfull"},
    //                         { "data": "inwidthfull"},
    //                         { "data": "inlenfull"},
    //                         { "data": "inlenmin"},
    //                         { "data": "inlennett"},
    //                         { "data": "inheighttrim"},
    //                         { "data": "inwidthtrim"},
    //                         { "data": "inlengr"},
    //                         { "data": "inlenkm"},
    //                         { "data": "inlentrim"},
    //                         { "data": "inheightmin"},
    //                         { "data": "inheightnett"},
    //                         { "data": "inwidthmin"},
    //                         { "data": "inwidthnett"},
    //                         { "data": "inp_len"},
    //                         { "data": "inp_m3"},
    //                         { "data": "india_gr"},
    //                         { "data": "innobarcode"},
    //                         { "data": "innopohon"},
    //                         { "data": "innopetak"},
    //                         { "data": "inpo_price"},
    //                         { "data": "ingross_price"},
    //                         { "data": "indiscount"},
    //                         { "data": "indiscountvalue"},
    //                         { "data": "insurcharges"},
    //                         { "data": "insurcharges_value"},
    //                         { "data": "inadj"},
    //                         { "data": "india1_teras"},
    //                         { "data": "india2_teras"},
    //                         { "data": "india3_teras"},
    //                         { "data": "india4_teras"},
    //                         { "data": "indiaavg_teras"},
    //                         { "data": "inp_m3_teras"},
    //                         { "data": "inpo_price_teras"},
    //                         { "data": "ingross_price_teras"},
    //                         { "data": "indiscountteras"}
    //                         // { "data": "indiscountvalue_teras"},
    //                         // { "data": "insurcharges_value_teras"},
    //                         // { "data": "inadj_teras"}

    //                     ]
    //                 });
                
    //         // }
    //     });
    // });
</script>

<script>

    $(document).ready(function(){
        $('#view_external').on('click', function(){
            // e.preventDefault();
            
                    $('#external_receipt').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": "{{ route('receipt.view_external') }}",
                        "columns":[
                            // { "data": "nextmap"},
                            // { "data": "receiptlog_id"}
                            { "data": "code"},
                            { "data": "enextmap"},
                            { "data": "enoproduct"},
                            { "data": "dnokayu"},
                            { "data": "ddia"},
                            { "data": "dlength"},
                            { "data": "dheight"},
                            { "data": "dwidth"},
                            { "data": "dm3"},
                            { "data": "dnobarcode"},
                            { "data": "dnopohon"},
                            { "data": "dnopetak"},
                            { "data": "dquality"},
                            { "data": "dnokapling"},
                            { "data": "dnobp"},
                            { "data": "dumurkapling"},
                            { "data": "dkayuno2"},
                            { "data": "dpartaibp"},
                            { "data": "dasaltahun"},
                            { "data": "vnokayu"},
                            { "data": "vdia"},
                            { "data": "vlength"},
                            { "data": "vheight"},
                            { "data": "vwidth"},
                            { "data": "vm3"},
                            { "data": "vnobarcode"},
                            { "data": "vnopohon"},
                            { "data": "vnopetak"},
                            { "data": "vquality"},
                            { "data": "innokayu"},
                            { "data": "inkwt"},
                            { "data": "india1"},
                            { "data": "india2"},
                            { "data": "india3"},
                            { "data": "india4"},
                            { "data": "indiaavg"},
                            { "data": "inclass"},
                            { "data": "inheightfull"},
                            { "data": "inwidthfull"},
                            { "data": "inlenfull"},
                            { "data": "inlenmin"},
                            { "data": "inlennett"},
                            { "data": "inheighttrim"},
                            { "data": "inwidthtrim"},
                            { "data": "inlengr"},
                            { "data": "inlenkm"},
                            { "data": "inlentrim"},
                            { "data": "inheightmin"}
                            // { "data": "inheightnett"},
                            // { "data": "inwidthmin"},
                            // { "data": "inwidthnett"},
                            // { "data": "inp_len"},
                            // { "data": "inp_m3"},
                            // { "data": "india_gr"},
                            // { "data": "innobarcode"},
                            // { "data": "innopohon"},
                            // { "data": "innopetak"},
                            // { "data": "inpo_price"},
                            // { "data": "ingross_price"},
                            // { "data": "indiscount"},
                            // { "data": "indiscountvalue"},
                            // { "data": "insurcharges"},
                            // { "data": "insurcharges_value"},
                            // { "data": "inadj"}
                            // { "data": "india1_teras"},
                            // { "data": "india2_teras"},
                            // { "data": "india3_teras"},
                            // { "data": "india4_teras"},
                            // { "data": "indiaavg_teras"},
                            // { "data": "inp_m3_teras"},
                            // { "data": "inpo_price_teras"},
                            // { "data": "ingross_price_teras"},
                            // { "data": "indiscountteras"},
                            // { "data": "indiscountvalue_teras"}
                            // { "data": "insurcharges_value_teras"},
                            // { "data": "inadj_teras"}

                        ]
                    });
                
            // }
        });
    });
</script>

<script>
    // GRADER IN
    $(document).ready(function(){

    var count = 1;

    tblgraderin(count);

    function tblgraderin(number)
    {
            html = '<tr>';
            html += '<td><input type="text" name="graderin[]" class="form-control" /></td>';
            html += '<td><input type="text" name="location_graderin[]" class="form-control" /></td>';
           

            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger btn-sm remove">Remove</button></td></tr>';
                $('#bodygraderin').append(html);
            }
            else
            {   
                html += '<td><button type="button" name="add" id="add" class="btn btn-success btn-sm">Add</button></td></tr>';
                $('#bodygraderin').html(html);
            }

            
    }

    $(document).on('click', '#add', function(){
        count++;
        tblgraderin(count);
    });

    $(document).on('click', '.remove', function(){
        count--;
        $(this).closest("tr").remove();
    });

    $('#dynamicformgraderin').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:'{{ route("receipt.storegraderin") }}',
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
                        tblgraderin(1);
                        $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                        location.reload();
                    }
                    // $('#save').attr('disabled', false);
                }
            })
    });

    });
</script>

<script>
    //GRADER OUT
    $(document).ready(function(){

    var count = 1;

    tblgraderout(count);

    function tblgraderout(number)
    {
            html = '<tr>';
            html += '<td><input type="text" name="graderout[]" class="form-control" /></td>';
            html += '<td><input type="text" name="location_graderout[]" class="form-control" /></td>';
           

            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="removegraderout" class="btn btn-danger btn-sm remove">Remove</button></td></tr>';
                $('#bodygraderout').append(html);
            }
            else
            {   
                html += '<td><button type="button" name="add" id="addgraderout" class="btn btn-success btn-sm">Add</button></td></tr>';
                $('#bodygraderout').html(html);
            }

            
    }

    $(document).on('click', '#addgraderout', function(){
        count++;
        tblgraderout(count);
    });

    $(document).on('click', '#removegraderout', function(){
        count--;
        $(this).closest("tr").remove();
    });

    $('#dynamicformgraderout').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:'{{ route("receipt.storegraderout") }}',
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
                        tblgraderout(1);
                        $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                        location.reload();
                    }
                    // $('#save').attr('disabled', false);
                }
            })
    });

    });
</script>

<script>
$(document).ready(function () {

$('.demo2').click(function (e)
{
    e.preventDefault();
    var id = $(this).data('id');
    console.log(id);
    swal(
    {
        title: "Are you sure want to delete this?",
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
                        url : "{{ url('receipt/grader')}}" + '/' + id,
                        data : {id:id},
                        // dataType: 'json',
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

<script>
    $(document).ready(function(){
        $(".select2_demo_1").select2();
        $(".select2_demo_2").select2();
        $(".select2_demo_3").select2({
            placeholder: "Select a state",
            allowClear: true
        });

        $('.chosen-select').chosen({width: "100%"});

        
    });
</script>
<script>
    

    //select PIM
    $(document).ready(function(){
        $('.selectpim').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            if(id)
            {
                console.log('id = '+id);

                $.ajax({
                    url: '/receipt/selectpim/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        $('#tt_id').val(data[0]);
                        $('#tt_code').val(data[1]);
                        $('#pimid').val(data[2]);
                        $('#codepim').val(data[3]);
                        $('#nopim').val(data[4]);
                        $('#po_id').val(data[5]);
                        $('#po').val(data[6]);
                        $('#procurement').val(data[7]);
                        $('#vendorid').val(data[8]);
                        $('#code_vendor').val(data[9]);
                        $('#tpkid').val(data[10]);
                        $('#vendor').val(data[11]);
                        $('#concession').val(data[12]);
                        $('#document').val(data[13]);
                        $('#measurement').val(data[14]);
                        $('#npwp').val(data[15]);
                        $('#incoterms').val(data[16]);
                        $('#tt_no').val(data[17]);
                        $('#parcel').val(data[18]);
                        $('#transport_no').val(data[19]);
                        $('#speciesid').val(data[20]);
                        $('#species').val(data[21]);
                        $('#skskb_no').val(data[22]);
                        $('#skskb_qty').val(data[23]);
                        $('#skskb_m3').val(data[24]);
                        $('#certificate').val(data[25]);

                        
                        $('#myModal5').modal('hide');
                    }
                })
            }
        })
    })
</script>

<script>
    //select RECEIPT LOG
    $(document).ready(function(){
        $('.select_receiptlog').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            if(id)
            {
                console.log('id = '+id);

                $.ajax({
                    url: '/receipt/select_receiptlog/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        $('#code_receipt').val(data[0]); //vendor
                        $('#code_receipt2').val(data[0]); //grader out
                        $('#code_receipt3').val(data[0]); //garader in
                        $('#code_receipt4').val(data[0]); //document
                        $('#code_receipt5').val(data[0]); //external rececipt
                        $('#generate_itemcode').val(data[1]); //view external receipt
                        $('#view_external').val(data[1]);
                        $('#export_vendorreceipt').val(data[1]); //vendor
                        $('#import_vendorreceipt').val(data[1]); //vendor

                        $('#export_graderoutreceipt').val(data[1]);
                        $('#export_graderinreceipt').val(data[1]);
                        $('#export_documentreceipt').val(data[1]);

                        $('#myModal1').modal('hide');
                    }
                })
            }
        })
    })
</script>

<script>
    //ekspor vendor receipt
    $(document).ready(function(){
        $('#export_vendorreceipt').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/export_vendorreceipt/"+id;
                //location.reload();
                

            }
            return false;
        })
    })
</script>

<script>
    //import vendor receipt
    $(document).ready(function(){
        $('#import_vendorreceipt').click(function(){
            // e.preventDefault();
            // var id = $(this).val();
            // if(id)
            // {
            //     window.location = "/receipt/import/"+id;
            // }
            // return false;
            
        })
    })
</script>

<script>
    //ekspor grader out receipt
    $(document).ready(function(){
        $('#export_graderoutreceipt').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/export_graderoutreceipt/"+id;
                
            }
            return false;
        })
    })
</script>

<script>
    //ekspor grader in receipt
    $(document).ready(function(){
        $('#export_graderinreceipt').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/export_graderinreceipt/"+id;
                
            }
            return false;
        })
    })
</script>

<script>
    //ekspor document receipt
    $(document).ready(function(){
        $('#export_documentreceipt').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/export_documentreceipt/"+id;
                
            }
            return false;
        })
    })
</script>

<script>
    $(document).ready(function(){
        $('#division').on('change', function(){
            var division = $(this).val();
            if(division)
            {
                console.log('division '+division);
                $.ajax({
                url: '/po/getbeneficiary/'+division,
                type: 'GET',
                dataType: 'json',
                success: function(divs){
                    console.log(divs);
                        $('#name_beneficiary').val(divs[0]);
                        $('#address_beneficiary').val(divs[1]);
                        $('#contactperson_beneficiary').val(divs[2]);
                        $('#code_beneficiary').val(divs[3]);
                        $("#province_beneficiary").val(divs[5]);
                        $("#city_beneficiary").val(divs[7]);
                        $('#division_id').val(divs[8]);
                    }
                })
                
            }
        })
    })
</script>
@endsection