@extends('menu.mainmenu')
@section('title','Inventory Item ')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Inventory Item')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Create Inventory Item')</strong>
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
                <li><a class="nav-link {{ request()->is('master/inventoryitem') ? 'active' : null }}" href="{{ url('master/inventoryitem') }}">General</a></li>
                <li><a class="nav-link {{ request()->is('master/inventoryitem/specification') ? 'active' : null }}" href="{{ url('master/inventoryitem/specification') }}">Specification</a></li>
            </ul>
            <div class="tab-content">
                <div id="{{ url('master/inventoryitem') }}" class="tab-pane {{ request()->is('master/inventoryitem') ? 'active' : null }}">
                    <div class="panel-body">
                        <form action="{{ route('master.inventoryitem.store') }}" method="POST">
                        @csrf 
                            <div class="row">        
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Code TT </label>
                                        <div class="col-sm-9">
                                            <div class="input-group">

                                                <input type="hidden" class="form-control-sm form-control" id="tt_id" name="tt_id" readonly>

                                                <input type="text" class="form-control-sm form-control" id="tt_code" name="tt_code" readonly>

                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal5"> <i class="fa fa-search" id="window"> </i> </button>
                                                </span>
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
                                    <div class="form-group row">
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
                                            <th> PIM</th>
                                            <th> PIM No </th>
                                            <th> Parcel </th>
                                            <th data-hide="all"> Status</th>
                                            <th data-hide="all"> Item Group</th>
                                            
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection