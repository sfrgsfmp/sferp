@extends('menu.mainmenu')
@section('title','Receipt HPH')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Receipt HPH')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Create Receipt HPH')</strong>
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
                <li><a class="nav-link {{ request()->is('receipt/hph') ? 'active' : null }}" href="{{ url('receipt/hph') }}">General</a></li>
                <li> <a class="nav-link {{ request()->is('receipt/hph/info') ? 'active' : null }}" href="{{ url('receipt/hph/info') }}">Additional Info</a></li>
                <li> <a class="nav-link {{ request()->is('receipt/hph/vendor') ? 'active' : null }}" href="{{ url('receipt/hph/vendor') }}">Vendor </a> </li>
                <li> <a class="nav-link {{ request()->is('receipt/hph/graderout') ? 'active' : null }}" href="{{ url('receipt/hph/graderout') }}">Grader-Out</a> </li>
                <li> <a class="nav-link {{ request()->is('receipt/hph/graderin') ? 'active' : null }}" href="{{ url('receipt/hph/graderin') }}">Grader-In</a> </li>
                <li> <a class="nav-link {{ request()->is('receipt/hph/document') ? 'active' : null }}" href="{{ url('receipt/hph/document') }}">Document</a> </li>
                <li> <a class="nav-link {{ request()->is('receipt/hph/external') ? 'active' : null }}" href="{{ url('receipt/hph/external') }}">External</a> </li>
                <li> <a class="nav-link {{ request()->is('receipt/hph/invoicing') ? 'active' : null }}" href="{{ url('receipt/hph/invoicing') }}">Invoicing Parcel</a> </li>
            </ul>
        
            <div class="tab-content">
                <div id="{{ url('receipt/hph') }}" class="tab-pane {{ request()->is('receipt/hph') ? 'active' : null }}">
                    <div class="panel-body">
                        <form action="{{ route('receipt.hph.store') }}" method="POST">
                        @csrf 
                            <div class="row" id="topgeneral">        
                                <div class="col-sm-9">
                                    <!-- //1 = LOG //2 = HPH //3 = NON LOG  -->
                                    <input type="hidden" id="type_receipt" value="2" readonly>

                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">PIM </label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="text" class="form-control-sm form-control" id="pimid" name="pimid" readonly>
                                                <input type="text" class="form-control-sm form-control" id="codepim" name="codepim" readonly>

                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal5"> <i class="fa fa-search" id="window"> </i> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">TT </label>
                                        <div class="col-sm-10">
                                            <div class="ibox">
                                                <div class="ibox-content">
                                                    
                                                    <table class="table table-bordered " id="view_tt">
                                                        <thead>
                                                            <tr>
                                                                <th > Date </th>
                                                                <th> Code TT </th>
                                                                <th> No TT </th>
                                                                <th> PIM </th>
                                                                <th > No Document Asal</th>
                                                                <th > Phisic Qty</th>
                                                                <th> Doc Qty</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ibox-tools">
                                                    <a class="collapse-link">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- TT ID -->
                                    <input class="form-control" type="text" id="tt_id" name="tt_id" readonly>
                                    
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Status</label>
                                        <div class="col-sm-7">
                                            <select class="form-control-xs form-control @error('status') is-invalid @enderror" id="status" name="status">
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
                                            <select class="form-control-xs form-control @error('itemgroup') is-invalid @enderror" id="itemgroup_id" name="itemgroup_id">
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
                                            <select class="form-control-xs form-control @error('division') is-invalid @enderror" id="division" name="division">
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
                                        <label class="col-sm-3 col-form-label">SKSKB No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-sm form-control @error('skskb_no') is-invalid @enderror" id="skskb_no" name="skskb_no" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SKSKB Qty</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control-sm form-control @error('skskb_qty') is-invalid @enderror" id="skskb_qty" name="skskb_qty" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SKSKB M3</label>
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
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">TT No</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="text" id="tt_no" name="tt_no" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Transport No</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="text" id="transport_no" name="transport_no" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div> -->

                                    
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
                                                <a href="{{ route('receipt.hph.editgeneral', $r->id) }}" class='float-center' title="Edit">
                                                    <i class="fa fa-edit"> </i>
                                                </a>
                                                &nbsp
                                                <!-- <button type="button" id="viewGeneral" class="btn btn-outline btn-link float-center" onclick="viewGeneral({{$r->id}})" title="View">
                                                    <i class="fa fa-laptop"> </i>
                                                </button> -->
                                                
                                            </td>
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
                                <th> No Parcel</th>
                                <th>TT</th>
                                <th>No TT</th>
                                <th>No Form</th>
                                <th data-hide="all"> No Document</th>
                                <th data-hide="all"> No Dok Asal</th>
                                <th> PO</th>
                                <th> Spesies</th>
                                <th> Sortimen</th>
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
                                <td> {{$pim->noparcel}}</td>
                                <td> {{ implode(', ', $pim->tandaterima()->get()->pluck('code_tt')->toArray()) }} </td>
                                <td> {{ implode(', ', $pim->tandaterima()->get()->pluck('tt_no')->toArray()) }} </td>
                                <td> {{ implode(', ', $pim->tandaterima()->get()->pluck('form_no')->toArray()) }} </td>
                                <td> {{ implode(', ', $pim->tandaterima()->get()->pluck('no_document')->toArray()) }} </td>
                                <td> {{ implode(', ', $pim->tandaterima()->get()->pluck('no_dokumen')->toArray()) }} </td>
                                <td> {{ implode(', ', $pim->po()->get()->pluck('code')->toArray()) }}</td>
                                <td> {{ implode(', ', $pim->po()->get()->pluck('speciess')->toArray()) }}</td>
                                <td> {{ $pim->sortimen }}</td>
                                <td> {{ implode(', ', $pim->vendor()->get()->pluck('name_vendor')->toArray()) }} {{ implode(', ', $pim->tpk()->get()->pluck('name_tpk')->toArray()) }} </td>
                                <td align=center> 
                                    <button type="button" id="select_pim" class="btn btn-outline btn-link" onclick="select_pim({{$pim->id}})" title="Choose">
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

<!-- //MODAL SEARCH NO-RECEIPT HPH -->
<div class="modal inmodal fade" id="myModal1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Receipt HPH</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <td > No Receipt HPH </td>
                                <td>No Receipt Log</td>
                                <td>PIM</td>
                                <td>No PIM</td>
                                <td>No PRM</td>
                                <td data-hide="all">PO </td>
                                <td>TT</td>
                                <td>No TT</td>
                                <td>Species</td>
                                <td data-hide="all"> No Document</td>
                                <td data-hide="all">Sortimen</td>
                                <td>No Parcel</td>
                                <td align="center">Select <i class="fa fa-check-square-o"> </i></td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $var = ""; ?>
                            @foreach($receipthphs as $rhph)
                                <?php
                                if($var != $rhph->code_hph){
                                    $var = $rhph->code_hph;
                                    $vars = $rhph->code_hph;
                                }
                                else{
                                    $vars = "";
                                }
                            ?>
                            <tr>
                                <td rowspan=2> {{ $vars }}</td>
                                <td> {{ $rhph->code_log}} </td>
                                <td> {{ $rhph->code_pim}}</td>
                                <td> {{ $rhph->pimno}}</td>
                                <td> {{ $rhph->noprocurement}} </td>
                                <td> {{ $rhph->code_po}}</td>
                                <td> {{ $rhph->code_tt}}</td>
                                <td> {{ $rhph->tt_no}}</td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> {{ $rhph->noparcel}}</td>
                                <td align=center>
                                    <button type="button" id="select_hph" class="btn btn-outline btn-link" onclick="select_hph({{$rhph->id}})" value="{{ $rhph->id }}" title="Choose">
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

<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"> </script>

<script>

    function select_hph($id)
    {
        if($id)
        {
            console.log('id-hph'+$id);

            $.ajax({
                    url: '/receipt/hph/select_hph/'+$id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        $('#code_receipt').val(data[0]); //vendor
                        $('#code_receipt2').val(data[0]); //graderout
                        $('#code_receipt3').val(data[0]); //graderin
                        $('#code_receipt4').val(data[0]); //document
                        $('#code_receipt5').val(data[0]); //external
                        $('#code_receipt6').val(data[0]); //invoicing hph

                        $('#export_vendorreceipt').val($id);
                        $('#export_graderout').val($id);
                        $('#export_graderin').val($id);
                        $('#export_document').val($id);
                        $('#generate_itemcode').val($id);
                        $('#generate_pricing').val($id);
                        $('#generate_invoicing').val($id); //per parcel (hph)
                        $('#report_external').val($id); //external
                        $('#report_invoicing').val($id); //report_invoicing


                        $('#myModal1').modal('hide');
                    }
            })

        }
    }
    
    function select_pim($id)
    {
        if($id)
        {
            // alert($id);
            $.ajax({
                    url: '/receipt/hph/select_pim/'+$id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#pimid').val(data[0]);
                        $('#codepim').val(data[1]);

                        $('#nopim').val(data[2]);
                        $('#po_id').val(data[3]);
                        $('#po').val(data[4]);
                        $('#procurement').val(data[5]);
                        $('#vendorid').val(data[6]);
                        $('#code_vendor').val(data[7]);
                        $('#vendor').val(data[8]);
                        $('#concession').val(data[9]);
                        $('#document').val(data[10]);
                        $('#measurement').val(data[11]);
                        $('#npwp').val(data[12]);
                        $('#incoterms').val(data[13]);
                        $('#parcel').val(data[14]);
                        $('#species').val(data[15]);
                        // $('#skskb_no').val(data[22]);
                        // $('#skskb_qty').val(data[23]);
                        // $('#skskb_m3').val(data[24]);
                        $('#certificate').val(data[16]);
                        // $('#tt_id').val(data[17]);

                        $('#myModal5').modal('hide');

                        $('#view_tt').DataTable({
                                "processing": true,
                                "serverSide": true,
                                "ajax": {
                                    url: '/receipt/hph/view_tt/'+data[0],
                                    type: 'get'
                                },
                                "columns":[
                                    { "data": "tt_date"},
                                    { "data": "code_tt"},
                                    { "data": "tt_no"},
                                    { "data": "code_pim"},
                                    { "data": "no_dokumenasal"},
                                    { "data": "phisic_qty"},
                                    { "data": "doc_qty"}
                                ]
                                
                        });

                        $.ajax({
                            url: '/receipt/hph/get_ttid/'+$id,
                            type: 'GET',
                            dataType: 'json',
                            success: function(d){
                                $('#tt_id').val(d[0]);
                            }
                        })

                    }
                    
            });

        }
    }

    //division
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

    $(document).ready(function(){
        $(".select2_demo_1").select2();
        $(".select2_demo_2").select2();
        $(".select2_demo_3").select2({
            placeholder: "Select a state",
            allowClear: true
        });

        $('.chosen-select').chosen({width: "100%"});

        
    });

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
                    url:'{{ route("receipt.hph.storegraderin") }}',
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
                    url:'{{ route("receipt.hph.storegraderout") }}',
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

    //delete info
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

    //export vendor hph
    $(document).ready(function(){
        $('#export_vendorreceipt').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/hph/exportvendor/"+id;
            }
        })
    });

    //export graderout
    $(document).ready(function(){
        $('#export_graderout').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/hph/exportgraderout/"+id;
            }
        })
    })

    //export_graderin
    $(document).ready(function(){
        $('#export_graderin').click(function(e){
            e.preventDefault();
            var id=$(this).val();
            if(id)
            {
                window.location = '/receipt/hph/exportgraderin/'+id;
            }
        })
    })

    //export_document
    $(document).ready(function(){
        $('#export_document').click(function(e){
            e.preventDefault();
            var id=$(this).val();
            if(id)
            {
                window.location = '/receipt/hph/exportdocument/'+id;
            }
        })
    })

    //generate itemcode - external
    $(document).ready(function(){
        $('#generate_itemcode').click(function(e){
            e.preventDefault();
            var id=$(this).val();
            if(id)
            {
                window.location = '/receipt/hph/generate_itemcode/'+id;
            }
        })
    })

    //generate pricing
    $(document).ready(function(){
        $('#generate_pricing').click(function(e){
            e.preventDefault();
            var id=$(this).val();
            if(id)
            {
                window.location = '/receipt/hph/generate_pricing/'+id;
            }
        })
    })

    //generate invoicing parcel
    $(document).ready(function(){
        $('#generate_invoicing').click(function(e){
            e.preventDefault();
            var id=$(this).val();
            if(id)
            {
                window.location = '/receipt/hph/generate_invoicing/'+id;
            }
        })
    })

    //report_external hph
    $(document).ready(function(){
        $('#report_external').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/hph/report_external/"+id;
            }
        })
    })

    //report_invoicing
    $(document).ready(function(){
        $('#report_invoicing').click(function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id)
            {
                window.location = "/receipt/hph/report_invoicing/"+id;
            }
        })
    })

</script>

@endsection