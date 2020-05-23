@extends('menu.mainmenu')
@section('title','Receipt Non Log')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Receipt Non Log')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Create Receipt Non Log')</strong>
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
                <li><a class="nav-link {{ request()->is('receipt/nonlog') ? 'active' : null }}" href="{{ url('receipt/nonlog') }}">General</a></li>
                <li><a class="nav-link {{ request()->is('receipt/nonlog/info') ? 'active' : null }}" href="{{ url('receipt/nonlog/info') }}">Info</a></li>
                <li> <a class="nav-link {{ request()->is('receipt/nonlog/vendor') ? 'active' : null }}" href="{{ url('receipt/nonlog/vendor') }}">Vendor </a> </li>
                <!-- <li> <a class="nav-link {{ request()->is('receipt/nonlog/graderout') ? 'active' : null }}" href="{{ url('receipt/nonlog/graderout') }}">Grader-Out</a> </li> -->
                <li> <a class="nav-link {{ request()->is('receipt/nonlog/graderin') ? 'active' : null }}" href="{{ url('receipt/nonlog/graderin') }}">Grader-In</a> </li>
                <li> <a class="nav-link {{ request()->is('receipt/nonlog/document') ? 'active' : null }}" href="{{ url('receipt/nonlog/document') }}">Document</a> </li>
                <li> <a class="nav-link {{ request()->is('receipt/nonlog/external') ? 'active' : null }}" href="{{ url('receipt/nonlog/external') }}">External</a></li>
                <li> <a class="nav-link {{ request()->is('receipt/nonlog/invoicing') ? 'active' : null }}" href="{{ url('receipt/nonlog/invoicing') }}">Invoicing</a></li>
            </ul>
            <div class="tab-content">
                <div id="{{ url('receipt/nonlog') }}" class="tab-pane {{ request()->is('receipt/nonlog') ? 'active' : null }}">
                    <div class="panel-body">
                        <form id="savegeneral" action="{{ route('receipt.nonlog.store') }}" method="POST">
                        @csrf 
                            <div class="row" id="topgeneral">        
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Code TT </label>
                                        <div class="col-sm-9">
                                            <div class="input-group">

                                                <input type="text" class="form-control-sm form-control" id="tt_id" name="ttid" readonly>
                                                

                                                <input type="text" class="form-control-sm form-control @error('tt_id') is-invalid @enderror" id="tt_code" name="tt_id" readonly>
                                                
                                                
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2"> <i class="fa fa-search" id="window"> </i> </button>
                                                </span>
                                                @error('tt_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                                
                                           
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">PIM </label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control-sm form-control" id="pimid" name="pimid" readonly>
                                                <input type="text" class="form-control-sm form-control" id="codepim" name="codepim" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">No PIM </label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="text" class="form-control-sm form-control" id="nopim" name="nopim" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Status</label>
                                        <div class="col-sm-7">
                                            <select class="form-control-sm form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                <option value="Approved">Approved</option>
                                                <option value="Hold"> Hold</option>
                                                <option value="Cancel"> Cancel</option>
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
                                                    <option value="{{$ig->id}}">{{$ig->itemgroup_code}}</option>
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
                                                    <option value="{{$com->code}}">{{$com->code}}</option>
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
                                                <input type='text' class="form-control datepicker-here @error('applydate') is-invalid @enderror" name="applydate" id="applydate" data-language='en' />
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
                                                        <option value="{{$wh->id}}"> {{$wh->warehouse_name}}</option>
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
                                                    @foreach($warehouse as $whh)
                                                        <option value="{{$whh->id}}"> {{$whh->warehouse_name}}</option>
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
                                                        <option value="{{$obj->id}}"> {{$obj->objective_name}}</option>
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
                                            <input type="text" class="form-control-sm form-control @error('ppc') is-invalid @enderror" name="ppc" id="ppc">
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
                                                    <option value="{{$remark->id}}"> {{$remark->name}}</option>
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
                                            <input type="hidden" class="form-control" name="po_id" id="po_id" readonly>
                                            <input type="text" class="form-control-sm form-control @error('po') is-invalid @enderror" name="po" id="po" readonly>
                                                
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
                                            <input type="text" class="form-control-sm form-control @error('procurement') is-invalid @enderror" name="procurement" id="procurement" readonly>
                                                
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
                                            <input type="hidden" class="form-control" id="vendorid" name="vendorid">
                                            <input type="text" class="form-control-sm form-control @error('code_vendor') is-invalid @enderror" name="code_vendor" id="code_vendor" readonly>
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
                                            <input type="hidden" class="form-control" id="tpkid" name="tpkid">
                                            <!-- NAME TPK -->
                                            <input type="text" class="form-control-sm form-control @error('vendor') is-invalid @enderror" name="vendor" id="vendor" readonly>
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
                                            <input type="text" class="form-control-sm form-control @error('concession') is-invalid @enderror" name="concession" id="concession" readonly>
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
                                            <input type="text" class="form-control-sm form-control @error('code_beneficiary') is-invalid @enderror" id="code_beneficiary" name="code_beneficiary" readonly>
                                                
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-sm form-control @error('name_beneficiary') is-invalid @enderror" id="name_beneficiary" name="name_beneficiary" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('address_beneficiary') is-invalid @enderror" id="address_beneficiary" name="address_beneficiary" readonly> </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Province</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="province_beneficiary" id="province_beneficiary" class="form-control-sm form-control @error('province_beneficiary') is-invalid @enderror" readonly>
                                        </div>
                                        <div class="col-sm-5">
                                            <input typle="text" name="city_beneficiary" id="city_beneficiary" class="form-control-sm form-control @error('city_beneficiary') is-invalid @enderror" readonly>
                                        </div>
                                    </div>

                                    <h4 class="m-t-none m-b">Information</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Species</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" class="form-control" id="speciesid" name="speciesid" readonly>
                                            <input type="text" class="form-control-sm form-control @error('species') is-invalid @enderror" id="species" name="species" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SKSKB No (Doc No)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-sm form-control @error('skskb_no') is-invalid @enderror" id="skskb_no" name="skskb_no" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"> Phisic Qty</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control-sm form-control" id="phisicqty" name="phisicqty" readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="format_phisicqty"> </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SKSKB Qty (Doc Qty)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-sm form-control @error('skskb_qty') is-invalid @enderror" id="skskb_qty" name="skskb_qty" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SKSKB M3 (Doc M3)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-sm form-control @error('skskb_m3') is-invalid @enderror" id="skskb_m3" name="skskb_m3" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Parcel</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-sm form-control @error('parcel') is-invalid @enderror" id="parcel" name="parcel" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Certificate</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-sm form-control @error('certificate') is-invalid @enderror" id="certificate" name="certificate" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Perni</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-sm form-control @error('perni') is-invalid @enderror" id="perni" name="perni">
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
                                            <input type="text" class="form-control-sm form-control @error('fakb') is-invalid @enderror" id="fakb" name="fakb">
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
                                            <textarea id="document" name="document" class="form-control" readonly> </textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">NPWP</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="text" id="npwp" name="npwp" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Incoterms</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="text" id="incoterms" name="incoterms" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Measurement</label>
                                        <div class="col-sm-9">
                                                <textarea id="measurement" name="measurement" class="form-control" readonly> </textarea>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">TT No</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="text" id="tt_no" name="tt_no" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Doc No</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="text" id="doc_no" name="doc_no" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Transport No</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="text" id="transport_no" name="transport_no" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6 b-r">
                                <!-- <div class="col-sm-9"> -->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unit (Size)</label>
                                        <div class="col-sm-9">
                                            <select id="unitsize" name="unitsize" class="chosen-select form-control">
                                                @foreach($measurement as $ms)
                                                    <option value="{{$ms->id}}"> {{$ms->measurement_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Unit (Price)</label>
                                        <div class="col-sm-9">
                                            <select id="unitprice" name="unitprice" class="chosen-select form-control">
                                                @foreach($measurement as $ms)
                                                    <option value="{{$ms->id}}"> {{$ms->measurement_name}}</option>
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
                                            <label> <input type="radio" id="source_price" name="source_price" value="0"> <i></i> Purchase Order </label>
                                            &nbsp
                                            <label> <input type="radio" id="source_price" name="source_price" checked="" value="1"> <i></i> HJD Detail </label>
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
                                                        <option value="{{$tax->id}}"> {{$tax->name}}</option>
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
                                                        <option value="{{$t->id}}"> {{$t->name}}</option>
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
                                                        <option value="{{$tax->id}}"> {{$tax->name}}</option>
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
                                                        <option value="{{$tax->id}}"> {{$tax->name}}</option>
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
                                            <input type='text' class="form-control form-control-sm @error('trucking') is-invalid @enderror" name="trucking" id="trucking" />
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
                                            <input type='text' class="form-control form-control-sm @error('pph23') is-invalid @enderror" name="administration" id="administration" />
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
                                            <input type='text' class="form-control form-control-sm @error('lainlain') is-invalid @enderror" name="lainlain" id="lainlain" />
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
                                                    <option value="{{ $me->id}}"> {{$me->measurement_name}}</option>
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
                                            <th> Apply Date</th>
                                            <th> TT</th>
                                            <th> PIM</th>
                                            <th> PIM No </th>
                                            <th> Parcel </th>
                                            <!-- <th> TT</th>
                                            <th> TT No</th> -->

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
                                            <th> Source Price </th>
                                            
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
                                    @foreach($receipt as $r)
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
                                                <a href="{{ route('receipt.nonlog.editgeneral', $r->id) }}" class='float-center' title="Edit">
                                                    <i class="fa fa-edit"> </i>
                                                </a>
                                                &nbsp
                                                <button type="button" id="viewGeneral" class="btn btn-outline btn-link float-center" onclick="viewGeneral({{$r->id}})" title="View">
                                                    <i class="fa fa-laptop"> </i>
                                                </button>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                    </div>

                </div>

                <div id="{{ url('receipt/nonlog/info') }}" class="tab-pane {{ request()->is('receipt/nonlog/info') ? 'active' : null }}">
                    <div class="panel-body">
                        
                        <span id="result"></span>

                        <div class="row">        
                            <div class="col-sm-6 b-r">
                                <form method="POST" id="dynamicformgraderin">
                                @csrf 
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">No Receipt Non Log</label>
                                        <div class="col-sm-9">
                                            <select id="noreceiptnonlog" name="noreceiptnonlog" class="chosen-select form-control">
                                                @foreach($receipt as $rr)
                                                    <option value="{{$rr->id}}"> {{$rr->code}}</option>
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
                                                        <td> <input type="submit" name="save" id="save" class="btn btn-primary btn-xs" value="Save" /></td>
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
                                        <label class="col-sm-3 col-form-label">No Receipt Non Log</label>
                                        <div class="col-sm-9">
                                            
                                            <select id="noreceiptnonlog_graderout" name="noreceiptnonlog_graderout" class="chosen-select form-control">
                                                @foreach($receipt as $r)
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
                                                        <td> <input type="submit" name="save" id="save" class="btn btn-primary btn-xs" value="Save" /></td>
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
                                        <th> No Receipt Non Log </th>
                                        <th> Name </th>
                                        <th> Location </th>
                                        <th> Status </th>
                                        <th align=center> Action </th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($rgrader as $rg)
                                        <tr>
                                            <td> {{ $rg->code }}</td>
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

                <div id="{{ url('receipt/nonlog/graderin') }}" class="tab-pane {{ request()->is('receipt/nonlog/graderin') ? 'active' : null }}">
                    <div class="panel-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No Receipt Log </label>
                            <div class="col-sm-7">
                                <div class="input-group">
                                    
                                    <input type="text" class="form-control-sm form-control" id="code_receipt3" name="code_receipt3" readonly>

                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                    </span>
                                    
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button id="st_transaction" class="btn btn-primary btn-xs btn-outline"> ST Transaction</button>
                            </div>
                        </div>
                        
                        
                        <br>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="graderin_receipt" class="footable table-bordered dataTables-example">
                                <thead>
                                    <tr>
                                        <th> Receipt Non Log</th>
                                        <th> No ST </th>
                                        <th> Pallet</th>
                                        <th> Height</th>
                                        <th> Width</th>
                                        <th> Length </th>
                                        <th> P/M3</th>
                                        <th> Height (Inv)</th>
                                        <th> Width (Inv)</th>
                                        <th> Length (Inv)</th>
                                        <th> Qty (Inv) Btg</th>
                                        <th> S/M3 (Inv)</th>
                                        <th> Spec2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($graderins as $in)
                                    <tr>
                                        <td> {{ $in->code_receipt}}</td>
                                        <td> {{ $in->codedetail}}</td>
                                        <td> {{ $in->pallet}}</td>
                                        <td> {{ $in->height1}}</td>
                                        <td> {{ $in->width1}}</td>
                                        <td> {{ $in->lengthpm3}}</td>
                                        <td> </td>
                                        <td> {{ $in->height2}}</td>
                                        <td> {{ $in->width2}}</td>
                                        <td> {{ $in->lengthsm3}}</td>
                                        <td> {{ $in->qty}}</td>
                                        <td> </td>
                                        <td> {{ $in->speclegend}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>

                <div id="{{ url('receipt/nonlog/vendor') }}" class="tab-pane {{ request()->is('receipt/nonlog/vendor') ? 'active' : null }}">
                    <div class="panel-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No Receipt Non Log </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    
                                    <input type="text" class="form-control" id="code_receipt" name="code_receipt" readonly>

                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-xs btn-outline" type="button" id="exportvendor" value="">Export</button>

                        <form action="{{ route('receipt.nonlog.importvendor') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="importvendor" class="@error('importvendor') is-invalid @enderror">
                            @error('importvendor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="submit" class="btn btn-primary btn-xs btn-outline" value="Import">
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
                                        <th> Length</th>
                                        <th> Height</th>
                                        <th> Width</th>
                                        <th> M3</th>
                                        <th> Qty</th>
                                        <th> Quality </th>
                                        <th> Spec2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vendors as $vendor)
                                    <tr>
                                        <td> {{ $vendor->code}}</td>
                                        <td> {{ $vendor->nextmap}}</td>
                                        <td> {{ $vendor->length}}</td>
                                        <td> {{ $vendor->height}}</td>
                                        <td> {{ $vendor->width}}</td>
                                        <td> {{ $vendor->m3}}</td>
                                        <td> {{ $vendor->qty}}</td>
                                        <td> {{ $vendor->quality_legend}}</td>
                                        <td> {{ $vendor->speclegend}} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>

                <div id="{{ url('receipt/nonlog/document') }}" class="tab-pane {{ request()->is('receipt/nonlog/document') ? 'active' : null }}">
                    <div class="panel-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No Receipt Non Log </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    
                                    <input type="text" class="form-control" id="code_receipt4" name="code_receipt4" readonly>

                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-xs btn-outline" type="button" id="exportdocument" value="">Export</button>

                        <form action="{{ route('receipt.nonlog.importdocument') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="importdocument" class="@error('importdocument') is-invalid @enderror">
                            @error('importvendor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="submit" class="btn btn-primary btn-xs btn-outline" value="Import">
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
                                        <th> Length</th>
                                        <th> Height</th>
                                        <th> Width</th>
                                        <th> M3</th>
                                        <th> Qty</th>
                                        <th> Quality </th>
                                        <th> Spec2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($document as $doc)
                                    <tr>
                                        <td> {{ $doc->code}}</td>
                                        <td> {{ $doc->nextmap}}</td>
                                        <td> {{ $doc->length}}</td>
                                        <td> {{ $doc->height}}</td>
                                        <td> {{ $doc->width}}</td>
                                        <td> {{ $doc->m3}}</td>
                                        <td> {{ $doc->qty}}</td>
                                        <td> {{ $doc->quality_legend}}</td>
                                        <td> {{ $doc->speclegend}} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>

                <div id="{{ url('receipt/nonlog/external') }}" class="tab-pane {{ request()->is('receipt/nonlog/external') ? 'active' : null }}">
                    <div class="panel-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No Receipt Non Log </label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="code_receipt5" name="code_receipt5" readonly>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-6">
                                <div class="input-group"> 
                                    <button class="btn btn-primary btn-xs btn-outline" type="button" id="generate_itemcode" value="">Generate Receipt</button>
                                </div>
                            </div>
                            
                            <span id="notif_invoicing"></span>
                            <!-- <label class="col-sm-1 col-form-label">Report </label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-xs" id="report_external"> External Receipt</button>
                                    </span>
                                </div>
                            </div> -->
                        </div>

                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="external_receipt" class="footable table-bordered dataTables-example">
                                <thead>
                                    <tr>
                                        <th> Receipt Non Log </th>
                                        <th> NextMap</th>
                                        <th> Length (doc)</th>
                                        <th> Height (doc)</th>
                                        <th> Width (doc)</th>
                                        <th> M3 (doc)</th>
                                        <th> Qty (doc)</th>
                                        <th> Quality (doc)</th>
                                        <th> Spec2 (doc)</th>
                                        

                                        <th> Length (ven)</th>
                                        <th> Height (ven)</th>
                                        <th> Width (ven)</th>
                                        <th> M3 (ven)</th>
                                        <th> Qty (ven)</th>
                                        <th> Quality (ven)</th>
                                        <th> Spec2 (ven)</th>

                                        
                                        <th> Kode ST</th>
                                        <th> Pallet</th>
                                        <th> KD/Non</th>
                                        <th> Height</th>
                                        <th> Height (Inv)</th>
                                        <th> Width</th>
                                        <th> Width (Inv)</th>
                                        <th> Quality</th>
                                        <th> Allowence</th>
                                        <th> Length (S/M3)</th>
                                        <th> Length (P/M3)</th>
                                        <th> Qty Btg</th>
                                        <th> PO Price</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($externals as $external)
                                        <tr>
                                            <td> {{ $external->codereceipt }}</td>
                                            <td> </td>
                                            <td> {{ $external->doclength}}</td>
                                            <td> {{ $external->docheight}}</td>
                                            <td> {{ $external->docwidth}}</td>
                                            <td> {{ $external->docm3}}</td>
                                            <td> {{ $external->docqty}}</td>
                                            <td> {{ $external->docquality}}</td>
                                            <td> {{ $external->docspec2}}</td>
                                            <td> {{ $external->venlength}}</td>
                                            <td> {{ $external->venheight}}</td>
                                            <td> {{ $external->venwidth}}</td>
                                            <td> {{ $external->venm3}}</td>
                                            <td> {{ $external->venqty}}</td>
                                            <td> {{ $external->venquality}}</td>
                                            <td> {{ $external->venspec2}}</td>

                                            <td> {{ $external->codest}}</td>
                                            <td> {{ $external->pallet}}</td>
                                            <td> {{ $external->kdnon}}</td>
                                            <td> {{ $external->height1}}</td>
                                            <td> {{ $external->height2}}</td>
                                            <td> {{ $external->width1}}</td>
                                            <td> {{ $external->width2}}</td>
                                            <td> {{ $external->inquality}}</td>
                                            <td> {{ $external->allowence}}</td>
                                            <td> {{ $external->lengthsm3}}</td>
                                            <td> {{ $external->lengthpm3}}</td>
                                            <td> {{ $external->qtyst}}</td>
                                            <td> {{ $external->po_price}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>

                <div id="{{ url('receipt/nonlog/invoicing') }}" class="tab-pane {{ request()->is('receipt/nonlog/invoicing') ? 'active' : null }}">

                    <form method="POST" action="" >
                    @csrf

                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">No Receipt Non Log </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="code_receipt6" name="code_receipt6" readonly>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-6">
                                    <div class="input-group"> 
                                        <!-- //PRICING PO -->
                                        <button class="btn btn-primary btn-xs btn-outline" type="button" id="generate_pricing" name="generate_pricing">Generate Pricing</button>

                                        <!-- //INVOICING -->
                                        <!-- <button class="btn btn-primary btn-xs ml-1 btn-outline" type="button" id="generate_invoicing">Generate Invoicing</button> -->
                                    </div>
                                </div>
                                
                                <span id="notif_invoicing"></span>
                                <!-- <label class="col-sm-1 col-form-label">Report </label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary btn-xs" id="report_invoicing"> Invoicing Receipt</button>
                                        </span>
                                    </div>
                                </div> -->
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="invoicing_receipt" class="footable table-bordered dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> Receipt Non Log</th>
                                            <th> No ST </th>
                                            <th> Pallet</th>
                                            <th> Height</th>
                                            <th> Width</th>
                                            <th> Length (P/M3)</th>
                                            <th> Height (Inv)</th>
                                            <th> Width (Inv)</th>
                                            <th> Length (S/M3)(Inv)</th>
                                            <th> Qty (Inv) Btg</th>
                                            <th> Spec2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($graderins as $in)
                                    <tr>
                                        <td> {{ $in->code_receipt}}</td>
                                        <td> {{ $in->codedetail}}</td>
                                        <td> {{ $in->pallet}}</td>
                                        <td> {{ $in->height1}}</td>
                                        <td> {{ $in->width1}}</td>
                                        <td> {{ $in->lengthpm3}}</td>
                                        <td> {{ $in->height2}}</td>
                                        <td> {{ $in->width2}}</td>
                                        <td> {{ $in->lengthsm3}}</td>
                                        <td> {{ $in->qty}}</td>
                                        <td> {{ $in->speclegend}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- //MODAL SEARCH TT -->
<div class="modal inmodal fade" id="myModal2" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">TT</h4>
                <small class="font-bold">Tanda Terima</small>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <th data-toggle="true"> Apply Date </th>
                                <th>TT</th>
                                <th>No TT</th>
                                <th>No Form TT</th>
                                <th>PIM</th>
                                <th>No PIM</th>
                                <th data-hide="all"> No Document</th>
                                <th data-hide="all"> No Dok Asal</th>
                                <th> PO</th>
                                <th> Spesies</th>
                                <th> Sortimen</th>
                                <th> No Parcel</th>
                                <th> Vendor</th>
                                <th> Select <i class="fa fa-check-square-o"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tt as $t)
                            <tr>
                                <td> {{ $t->tt_date }} </td>
                                <td> {{ $t->code_tt }} </td>
                                <td> {{ $t->tt_no }} </td>
                                <td> {{ $t->form_no }} </td>
                                <td> {{ $t->code_pim}} </td>
                                <td> {{ $t->pimno }}</td>
                                <td> {{ $t->no_document }} </td>
                                <td> {{ $t->no_dokumen }} </td>
                                <td> {{ $t->code}}</td>
                                <td> {{ $t->speciesname}}</td>
                                <td> {{ $t->sortimen}}</td>
                                <td> {{ $t->noparcel}}</td>
                                <td> {{ $t->name_vendor}} {{$t->name_tpk}}</td>
                                <td align=center> 
                                    <button type="button" id="select_tt" class="btn btn-outline btn-link" data-id="{{ $t->tt_id}}" onclick="selecttt({{$t->tt_id}})" value="{{ $t->tt_id}}" title="Choose">
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


<!-- //MODAL SEARCH NO-RECEIPT NON LOG -->
<div class="modal inmodal fade" id="myModal1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Receipt Non Log</h4>
               
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <th data-toggle="true"> No Receipt Non Log </th>
                                <th>PIM</th>
                                <th>No PIM</th>
                                <th>TT</th>
                                <th>No TT</th>
                                <th>Species</th>
                                <th data-hide="all"> No Document</th>
                                <th> Sortimen</th>
                                <th> No Parcel</th>
                                <th> Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receipts as $rc)
                            <tr>
                                <td> {{ $rc->code }} </td>
                                <td> {{ $rc->code_pim}}</td>
                                <td> {{ $rc->pimno}} </td>
                                <td> {{ $rc->code_tt}}</td>
                                <td> {{ $rc->tt_no}}</td>
                                <td> {{ $rc->name}}</td>
                                <td> {{ $rc->no_document}}</td>
                                
                                <td> {{ $rc->sortimen}}</td>
                                <td> {{ $rc->noparcel}}</td>
                               
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
    function selecttt($tt_id)
    {
            if($tt_id)
            {
                console.log('id tt = '+$tt_id);
                
                $.ajax({
                    url: '/receipt/select_tt/'+$tt_id,
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
                        $('#phisicqty').val(data[26]);
                        if(data[27] == '0')
                        {
                            $('#format_phisicqty').html('batang');
                        }
                        else
                        {
                            $('#format_phisicqty').html('pallet');
                        }
                       
                        // $('#format_phisicqty').html(data[27]);
                        
                        $('#myModal2').modal('hide');
                    }
                })
            }
    }

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

    // GRADER IN
    $(document).ready(function(){

        var count = 1;

        tblgraderin(count);

        function tblgraderin(number)
        {
                html = '<tr>';
                html += '<td><input type="text" name="graderin[]" class="form-control-sm form-control" /></td>';
                html += '<td><input type="text" name="location_graderin[]" class="form-control-sm form-control" /></td>';
            
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
                    url:'{{ route("receipt.nonlog.storegraderin") }}',
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

    //GRADER OUT
    $(document).ready(function(){

        var count = 1;

        tblgraderout(count);

        function tblgraderout(number)
        {
                html = '<tr>';
                html += '<td><input type="text" name="graderout[]" class="form-control-sm form-control" /></td>';
                html += '<td><input type="text" name="location_graderout[]" class="form-control-sm form-control" /></td>';
            

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
                    url:'{{ route("receipt.nonlog.storegraderout") }}',
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
                        // $('#code_receipt2').val(data[0]); //grader out
                        $('#code_receipt3').val(data[0]); //garader in
                        $('#code_receipt4').val(data[0]); //document
                        $('#code_receipt5').val(data[0]); //external rececipt
                        $('#code_receipt6').val(data[0]); //invoicing
                        $('#st_transaction').val(data[1]);
                        $('#generate_itemcode').val(data[1]); //view external receipt
                        $('#generate_pricing').val(data[1]); //invoicing pricing
                        // $('#generate_invoicing').val(data[1]); //invoicing

                        // $('#view_external').val(data[1]);
                        $('#exportvendor').val(data[1]); //vendor
                        $('#importvendor').val(data[1]); //vendor
                        $('#exportdocument').val(data[1]);
                        $('#importdocument').val(data[1]);

                        // $('#export_graderoutreceipt').val(data[1]);
                        // $('#export_graderinreceipt').val(data[1]);
                        // $('#export_documentreceipt').val(data[1]);
                        
                        // $('#report_invoicing').val(data[1]); //reporting invoicing
                        // $('#report_external').val(data[1]); //reporting external

                        // $('#no_receipts').val(data[1]); //invoicingparcel

                        $('#myModal1').modal('hide');
                    }
                })
            }
        })
    })
    
    //tab grader-in
    $(document).ready(function(){
        $('#st_transaction').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/nonlog/graderin/"+id;
                // location.reload();

                // $('#graderin_receipt').DataTable({
                //     "processing":true,
                //     "serverSide":true,
                //     "ajax": "{{ route('receipt.nonlog.graderin', ".id.") }}",
                //     "columns":[
                //         {"data": "codedetail"},
                //         {"data": "pallet"},
                //         {"data": "height1"},
                //         {"data": "height2"},
                //         {"data": "width1"},
                //         {"data": "width2"},
                //         {"data": "allowence"},
                //         {"data": "lengthsm3"},
                //         {"data": "lengthpm3"},
                //         {"data": "qty"}
                //     ]
                // });
            }
            return false;
        })
    })

    //export vendor
    $(document).ready(function(){
        $('#exportvendor').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/nonlog/exportvendor/"+id;
            }
            return false;
        })
    })

    //export document
    $(document).ready(function(){
        $('#exportdocument').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/nonlog/exportdocument/"+id;
            }
            return false;
        })
    })

    //external - generate itemcode
    $(document).ready(function(){
        $('#generate_itemcode').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/nonlog/generate_itemcode/"+id;
            }
        })
    })

    //tab invoicing - generate pricing
    $(document).ready(function(){
        $('#generate_pricing').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                console.log(id);
                window.location = "/receipt/nonlog/generate_pricing/"+id;
                
            }
        })
    })
</script>
@endsection