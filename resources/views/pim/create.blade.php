@extends('menu.mainmenu')
@section('title','Planning Income Material')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Planning Income Material')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Create Planning Income Material')</strong>
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
                <li><a class="nav-link" data-toggle="tab" href="#tab-3" id="tab3">Payment</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <form action="{{ route('pim.store')}}" method="POST">
                        @csrf 
                            <div class="row">        
                                
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Number</label>
                                        <div class="col-sm-10">
                                            <div class="input-daterange input-group" >
                                                
                                                <input type="text" class="form-control @error('Number') is-invalid @enderror" id="code_pim" name="code_pim" readonly placeholder="Auto Generate">
                                                @error('Number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <!-- //No urut pim. Manual. Untuk reporting -->
                                        <label class="col-sm-2 col-form-label">PIM No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('pimno') is-invalid @enderror" id="pimno" name="pimno">
                                            @error('pimno')
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
                                        <!-- <div class="col-sm-7">
                                            <input type="hidden" class="form-control @error('division_id') is-invalid @enderror" id="division_id" name="division_id" readonly>
                                            
                                        </div> -->
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
                                <div class="col-sm-10">
                                        
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Apply Date</label>
                                        <div class="col-sm-10">
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
                                        <label class="col-sm-2 col-form-label">Objective</label>
                                        <div class="col-sm-10">
                                            <select id="objective" name="objective" class="chosen-select form-control @error('objective') is-invalid @enderror">
                                                @foreach($objective as $obj)
                                                <option value="{{$obj->id}}"> {{$obj->objective_name }} </option>
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
                                        <label class="col-sm-2 col-form-label">Process</label>
                                        <div class="col-sm-10">
                                            <select id="process" name="process" class="form-control @error('process') is-invalid @enderror">
                                                <option value="Bongkar"> Bongkar</option>
                                                <option value="Bongkar Lebar"> Bongkar Lebar</option>
                                                <option value="Bongkar Lebar Forklift"> Bongkar Lebar Forklift</option>
                                                <option value="Bongkar Lebar Stapel"> Bongkar Lebar Stapel</option>
                                                <option value="Bongkar Stapel"> Bongkar Stapel </option>
                                            </select>
                                            @error('process')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Warehouse</label>
                                        <div class="col-sm-10">
                                            <select id="warehouse_id" name="warehouse_id" class="form-control @error('warehouse_id') is-invalid @enderror">
                                                @foreach($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id}}"> {{$warehouse->warehouse_name}}</option>
                                                
                                                @endforeach
                                            </select>
                                            @error('warehouse_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Cara Susun</label>
                                        <div class="col-sm-10">
                                            <select id="carasusun" name="carasusun" class="form-control @error('carasusun') is-invalid @enderror">
                                                <option value="Loose"> Loose</option>
                                                <option value="Palletise"> Palletise </option>
                                                
                                            </select>
                                            @error('carasusun')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">SOP Langkah</label>
                                        <div class="col-sm-10">
                                            <textarea id="soplangkah" name="soplangkah" class="form-control @error('soplangkah') is-invalid @enderror"> </textarea>
                                            @error('soplangkah')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">PO Reference</label>
                                        <div class="col-sm-10">
                                            <select class="chosen-select form-control @error('po_reference') is-invalid @enderror" id="po_reference" name="po_reference"> 
                                                <option value=""> Choose</option>
                                                @foreach($po as $po)
                                                    <option value="{{ $po->id}}"> {{$po->code}}</option>
                                                @endforeach
                                            </select>
                                            @error('po_reference')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Procurement No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('noprocurement') is-invalid @enderror" id="noprocurement" name="noprocurement">
                                            @error('noprocurement')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Parcel No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('noparcel') is-invalid @enderror" id="noparcel" name="noparcel">
                                            @error('noparcel')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">BP No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('bp') is-invalid @enderror" id="bp" name="bp">
                                            @error('bp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Species</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('species_id') is-invalid @enderror" id="species_id" name="species_id" readonly>
                                            @error('species_id')
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
                                    <h4 class="m-t-none m-b">Vendor</h4>
                                    
                                        <div class="form-group row" style="display:none">
                                            <div class="col-lg-3">
                                                <label> Code </label>
                                            </div>
                                            <div class="col-lg-8">
                                            
                                                <input type="text" class="form-control" id="vendor_id" name="vendor_id" readonly>
                                                <input type="text" class="form-control" id="type_vendor" name="type_vendor" readonly>
                                            </div>
                                        </div>
                                    <!-- <div id="location" style="display:none"> -->
                                            <div class="form-group row">
                                                <div class="col-lg-3">
                                                    <label> KBM </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select name="kbm_id" id="kbm_id" class="form-control form-control-lg @error('kbm_id') is-invalid @enderror">
                                                        <option value=""> Choose </option>
                                                        
                                                    </select>
                                                </div>
                                                @error('kbm_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-3">
                                                    <label> KPH </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select name="kph_id" id="kph_id" class="form-control form-control-lg @error('kph_id') is-invalid @enderror" >
                                                    <option value=""> Choose </option>
                                                    
                                                        
                                                    </select>
                                                </div>
                                                @error('kph_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-3">
                                                    <label> TPK </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select name="tpk_id" id="tpk_id" class="form-control form-control-lg @error('tpk_id') is-invalid @enderror" >
                                                    <option value=""> Choose </option>
                                                        
                                                    </select>
                                                </div>
                                                @error('tpk_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        <!-- </div> -->
                                    
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Name</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="name_vendor" name="name_vendor" readonly>
                                            @error('name_vendor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Address </label>
                                        </div>
                                        <div class="col-lg-8">
                                            
                                            <textarea id="address" name="address" class="form-control" readonly> </textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> City </label>
                                        </div>
                                        <div class="col-lg-8">
                                        
                                            <input type="text" class="form-control" id="city" name="city" readonly>
                                            @error('city')
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
                                        <div class="col-lg-3">
                                            <label> Code </label>
                                        </div>
                                        <div class="col-lg-8">
                                        
                                            <!-- <select class="chosen-select form-control @error('Certificate_code') is-invalid @enderror" id="certificate_code" name="certificate_code">
                                                <option value=""> Choose</option>
                                                @foreach($certificate as $cert)
                                                    <option value="{{$cert->id}}"> {{$cert->cert_code}}</option>
                                                @endforeach
                                            </select> -->
                                            <input type="text" id="certificate_code" name="certificate_code" class="form-control" readonly>
                                            @error('certificate_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> FSC Code </label>
                                        </div>
                                        <div class="col-lg-8">
                                        
                                            <input type="text" class="form-control @error('fsc_code') is-invalid @enderror" id="fsc_code" name="fsc_code" readonly>
                                            
                                            @error('fsc_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <h4 class="m-t-none m-b">Ukuran</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> FTebal-mm </label>
                                        </div>
                                        <div class="col-lg-8">
                                        
                                            <input type="text" class="form-control @error('ftebal') is-invalid @enderror" id="ftebal" name="ftebal">
                                            @error('ftebal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> FLebar-mm </label>
                                        </div>
                                        <div class="col-lg-8">
                                        
                                            <input type="text" class="form-control @error('flebar') is-invalid @enderror" id="flebar" name="flebar">
                                            @error('flebar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> FPanjang-mm </label>
                                        </div>
                                        <div class="col-lg-8">
                                        
                                            <input type="text" class="form-control @error('fpanjang') is-invalid @enderror" id="fpanjang" name="fpanjang">
                                            @error('fpanjang')
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
                                    <h4 class="m-t-none m-b">Spec1</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Spec1 </label>
                                        </div>
                                        <div class="col-lg-8">
                                           
                                            <input type="text" name="spec1_id" id="spec1_id" class="form-control" readonly>
                                            @error('spec1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Sortimen </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control @error('sortimen') is-invalid @enderror" id="sortimen" name="sortimen"> 
                                            
                                            @error('sortimen')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                <h4 class="m-t-none m-b">Spec2</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> KD/Non </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="chosen-select form-control @error('spec2_id') is-invalid @enderror" id="spec2_id" name="spec2_id" onchange="get_specs(this)"> 
                                                
                                                @foreach($specification as $spec2)
                                                    <option value="{{ $spec2->id }}"> {{ $spec2->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('spec2_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Specs </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control @error('specs') is-invalid @enderror" id="specs" name="specs">
                                            
                                            @error('specs')
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
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                   
                            <div class="row">
                                <div class="col-sm-6 b-r">

                                    <h4 class="m-t-none m-b">Instruction</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Contractor</label>
                                        <div class="col-sm-9">
                                            <select class="chosen-select form-control @error('contractor_id') is-invalid @enderror" id="contractor_id" name="contractor_id">
                                                <option value=""> </option>
                                                @foreach($contractors as $contractor)
                                                    <option value="{{$contractor->id}}"> {{$contractor->name_vendor}}</option>
                                                @endforeach
                                            </select>
                                            @error('contractor_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Informasi Lain</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('informasilain') is-invalid @enderror" id="informasilain" name="informasilain"> </textarea>
                                            @error('informasilain')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Note</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('Note') is-invalid @enderror" id="note" name="note"> </textarea>
                                            @error('note')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <h4 class="m-t-none m-b">Transportation</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Type</label>
                                        <div class="col-sm-9">
                                            <select class="chosen-select form-control @error('type_transport') is-invalid @enderror" id="type_transport" name="type_transport">
                                                <option value=""> Choose</option>
                                                @foreach($vehicle as $vehicle)
                                                    <option value="{{$vehicle->id}}"> {{$vehicle->vehicle_name}} </option>
                                                @endforeach
                                            </select>
                                            @error('type_transport')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">No</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="notransport" name="notransport" class="form-control @error('notransport') is-invalid @enderror">
                                            @error('notransport')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Desc</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc"> </textarea>
                                            @error('desc')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h4 class="m-t-none m-b">M3</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Type M3</label>
                                        <div class="col-sm-9">
                                            <select class="chosen-select form-control @error('typem3') is-invalid @enderror" id="typem3" name="typem3">
                                                <option value="Doc M3"> Doc M3</option>
                                                <option value="Est M3"> Est M3 </option>
                                            </select>
                                            @error('typem3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Est/Doc M3</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('estdocm3') is-invalid @enderror" id="estdocm3" name="estdocm3">
                                            @error('estdocm3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>
                                    
                                </div>
                                <div class="col-sm-6">

                                    <h4 class="m-t-none m-b">Capacity</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">WH Bongkar</label>
                                        <div class="col-sm-9">
                                            <select class="chosen-select form-control @error('whbongkar') is-invalid @enderror" id="whbongkar" name="whbongkar">
                                                <option value=""> </option>
                                                @foreach($warehouses as $wr)
                                                    <option value="{{ $wr->id}}"> {{ $wr->warehouse_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('whbongkar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">WH Stapel</label>
                                        <div class="col-sm-9">
                                            <select class="chosen-select form-control @error('whstapel') is-invalid @enderror" id="whstapel" name="whstapel">
                                                <option value=""> </option>
                                                @foreach($warehouses as $wr)
                                                    <option value="{{ $wr->id}}"> {{ $wr->warehouse_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('whstapel')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                   
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Time</label>
                                        <div class="col-sm-9">
                                            <div class="calculate">
                                                <div class="input-daterange input-group">
                                                    <input type="time" class="form-control" id="starttime" name="starttime" step="1" >
                                                    @error('starttime')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">to</span>
                                                    <input type="time" class="form-control" id="endtime" name="endtime" step="1">
                                                    @error('endtime')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Total Menit</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="totalmenit" name="totalmenit" class="form-control @error('Total Menit') is-invalid @enderror">
                                            @error('Total Menit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Head Count</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="headcount" name="headcount" class="form-control @error('headcount') is-invalid @enderror" onkeypress="return isNumber(event)">
                                            @error('headcount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <br>
                                    <h4 class="m-t-none m-b">Date and Time</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type='text' class="form-control datepicker-here @error('date') is-invalid @enderror" name="date" id="date" data-language='en'>
                                                @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Day</label>
                                        <div class="col-sm-9">
                                            
                                            <input type='text' class="form-control @error('Day') is-invalid @enderror" name="day" id="day" readonly>
                                            @error('Day')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div> -->
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">SPB No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('spb') is-invalid @enderror" id="spb" name="spb">
                                            @error('spb')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Region</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('Region') is-invalid @enderror" id="region" name="region">
                                            @error('Region')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                    <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                                </div>
                            </div> -->
                        <!-- </form> -->
                    </div>
                </div>
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                       
                            <!-- <div class="row">        
                                <div class="col-sm-11">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Number</label>
                                        <div class="col-sm-10">
                                            <select name="number" id="number" class="chosen-select form-control @error('Number') is-invalid @enderror">
                                                <option value=""> choose </value>
                                            </select>
                                            @error('Number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-sm-6 b-r">

                                    <h4 class="m-t-none m-b">Supplier Payment</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                
                                                <input type="text" class="datepicker-here form-control @error('datesupplierpayment') is-invalid @enderror" id="datesupplierpayment" name="datesupplierpayment" data-language='en'>
                                                    
                                                @error('datesupplierpayment')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Total Qty</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="totalqty" name="totalqty" class="form-control @error('totalqty') is-invalid @enderror" onkeypress="return isNumber(event)">
                                            @error('totalqty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Total M3</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="totalm3" name="totalm3" class="form-control @error('totalm3') is-invalid @enderror" onkeypress="return isNumber(event)">
                                            @error('totalm3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Total Inv. Price</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="totalinvprice" name="totalinvprice" class="form-control @error('totalinvprice') is-invalid @enderror" onkeypress="return isNumber(event)">
                                            @error('totalinvprice')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Desc</label>
                                        <div class="col-sm-9">
                                            
                                            <textarea id="desc_sup" name="desc_sup" class="form-control @error('desc_sup') is-invalid @enderror"> </textarea>
                                            @error('desc_sup')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h4 class="m-t-none m-b">Handling Payment</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Work Shift</label>
                                        <div class="col-sm-9">
                                            <div class="input-daterange input-group" >
                                                
                                                <select class="form-control @error('workshift') is-invalid @enderror" id="workshift" name="workshift">
                                                    <option value="Shift 1 Morning"> Shift 1 Morning</option>
                                                    <option value="Shift 2 Evening"> Shift 2 Evening</option>
                                                    <option value="Shift 3 Night"> Shift 3 Night</option>
                                                </select>
                                                    
                                                @error('workshift')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Rate Used</label>
                                        <div class="col-sm-9">
                                            
                                            <select class="form-control @error('rateused') is-invalid @enderror" id="rateused" name="rateused">
                                                <option value=""> choose</option>
                                                <option value="Rate10"> Rate 10</option>
                                                <option value="Rate15"> Rate 15</option>
                                                <option value="Rate20"> Rate 20</option>
                                            </select>
                                                
                                            @error('rateused')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Handling</label>
                                        <div class="col-sm-9">
                                            
                                            <select type="text" class="form-control @error('handling') is-invalid @enderror" id="handling" name="handling">
                                                <option value=""> Choose</option>
                                                @foreach($handling as $handling)
                                                    <option value="{{ $handling->id}}"> {{$handling->code}}</option>
                                                @endforeach
                                            </select>
                                            @error('handling')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>

                                    <h4 class="m-t-none m-b">Expedition Payment</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Code</label>
                                        <div class="col-sm-9">
                                            <select class="choosen-select form-control @error('Expedition Payment') is-invalid @enderror" id="code_expeditionpayment" name="code_expeditionpayment">
                                                <option value=""> Choose </option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id}}"> {{$vendor->name_vendor}}</option>
                                                @endforeach
                                            </select>
                                                @error('Expedition Payment')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Pay Date</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="datepicker-here form-control @error('Pay Date Expedition Payment') is-invalid @enderror" id="paydate_expeditionpayment" name="paydate_expeditionpayment" data-language='en'>
                                                @error('Pay Date Expedition Payment')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                           
                                            <input type="text" class="form-control @error('Price Expedition Payment') is-invalid @enderror" id="price_expeditionpayment" name="price_expeditionpayment" onkeypress="return isNumber(event)">
                                            
                                            @error('Price Expedition Payment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h4 class="m-t-none m-b">Freight Payment</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Code</label>
                                        <div class="col-sm-9">
                                           
                                            <select class="choosen-select form-control @error('Freight Payment') is-invalid @enderror" id="code_freightpayment" name="code_freightpayment">
                                                <option value=""> Choose</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id}}"> {{$vendor->name_vendor}}</option>
                                                @endforeach
                                            </select>
                                            @error('Freight Payment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Emkl</label>
                                        <div class="col-sm-9">
                                           
                                            <input type="text" class="form-control @error('Emkl') is-invalid @enderror" id="emkl" name="emkl">
                                            
                                            @error('Emkl')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Pay Date</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="datepicker-here form-control @error('Pay Date Freight Payment') is-invalid @enderror" id="paydate_freightpayment" name="paydate_freightpayment" data-language='en'>
                                                @error('Pay Date Freight Payment')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Cont Type</label>
                                        <div class="col-sm-9">
                                           
                                            <input type="text" class="form-control @error('Cont Type') is-invalid @enderror" id="conttype" name="conttype">
                                            
                                            @error('Cont Type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">
                                           
                                            <input type="text" class="form-control @error('Price Freight Payment') is-invalid @enderror" id="price_freightpayment" name="price_freightpayment" onkeypress="return isNumber(event)">
                                            
                                            @error('Price Freight Payment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Grading Expenses</label>
                                        <div class="col-sm-9">
                                           
                                            <input type="text" class="form-control @error('Grading Expenses') is-invalid @enderror" id="grading_expenses" name="grading_expenses" onkeypress="return isNumber(event)">
                                            
                                            @error('Grading Expenses')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Biaya Lelang</label>
                                        <div class="col-sm-9">
                                           
                                            <input type="text" class="form-control @error('Biaya Lelang') is-invalid @enderror" id="biayalelang" name="biayalelang" onkeypress="return isNumber(event)">
                                            
                                            @error('Biaya Lelang')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Retribusi %</label>
                                        <div class="col-sm-9">
                                           
                                            <input type="text" class="form-control @error('Retribusi') is-invalid @enderror" id="retribusi" name="retribusi" onkeypress="return isNumber(event)">
                                            
                                            @error('Retribusi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Biaya Lansir</label>
                                        <div class="col-sm-9">
                                           
                                            <input type="text" class="form-control @error('Biaya Lansir') is-invalid @enderror" id="biayalansir" name="biayalansir" onkeypress="return isNumber(event)">
                                            
                                            @error('Biaya Lansir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Fee</label>
                                        <div class="col-sm-9">
                                           
                                            <input type="text" class="form-control @error('Fee') is-invalid @enderror" id="fee" name="fee" onkeypress="return isNumber(event)">
                                            
                                            @error('Fee')
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
        </div>
    </div>
    <div class="ibox-content">
    <div class="panel-body">

        <div class="form-group row">
            <label class="col-sm-1 col-form-label"> NoPIM</label>
            <div class="col-sm-2">
                <select id="no_pim" class="chosen-select form-control">
                    @foreach($pims as $p)
                        <option value="{{$p->pimno}}"> {{$p->pimno}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6">
                <div class="input-group"> 
                    <!-- <a href="{{ route('pim.report', $p->id) }}" class="float-center" title="PDF">                
                        <i class="fa fa-file-pdf-o text-black"></i>
                    </a> -->

                    <button class="btn btn-primary btn-xs btn-outline" type="button" id="report_pim" >Report</button>
                </div>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                <thead>
                    <tr>
                        <th data-toggle="true">Code PIM</th>
                        <th>No PIM</th>
                        <th data-hide="all">Division</th>
                        <th> Apply Date </th>
                        <th>Warehouse</th>
                        <th>PO</th>
                        <th data-hide="all"> No PRM</th>
                        <th data-hide="all"> No Parcel</th>
                        <th data-hide="all"> BP</th>
                        <th> Vendor</th>
                        <th data-hide="all"> FTebal</th>
                        <th data-hide="all"> FLebar</th>
                        <th data-hide="all"> FPanjang</th>
                        <th> Sortimen</th>
                        <th> Specs</th>
                        <th> Contractor</th>
                        <th> Informasi Lain</th>
                        <th data-hide="all"> NoTransport</th>
                        <th> Estdocm3</th>
                        <th data-hide="all"> WH Bongkar</th>
                        <th data-hide="all"> WH Stapel</th>
                        <th> SPB</th>
                        <th> Date Supplier Payment</th>
                        <th> Total Qty</th>
                        <th> Total M3</th>
                        <th>Total Inv Price </th>
                        <th data-hide="all">Handling</th>
                        <th data-hide="all">Code ExpeditionPayment</th>
                        <th data-hide="all">Date ExpeditionPayment</th>
                        <th>Price ExpeditionPayment</th>
                        <th data-hide="all">Code FreightPayment</th>
                        <th data-hide="all">Emkl</th>
                        <th data-hide="all">Date FreightPayment</th>
                        <th>Price FreightPayment</th>
                        <th>Grading Expenses</th>
                        <th data-hide="all">Biaya Lelang</th>
                        <th data-hide="all">Retribusi</th>
                        <th data-hide="all">Biayalansir</th>
                        <th data-hide="all">Fee</th>
                        <th> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pims as $pim)
                    <tr>
                        <td>{{$pim->code_pim}} </td>
                        <td>{{$pim->pimno}} </td>
                        <td>{{$pim->division}} </td>
                        <td>{{$pim->applydate}}</td>
                        <td>{{ implode(',', $pim->warehouse()->get()->pluck('warehouse_name')->toArray()) }}</td>
                        <td>{{ implode(',', $pim->po()->get()->pluck('code')->toArray()) }} </td>
                        <td>{{$pim->noprocurement}}</td>
                        <td>{{$pim->noparcel}}</td>
                        <td>{{$pim->bp}}</td>
                        <td>{{ implode(',', $pim->vendor()->get()->pluck('name_vendor')->toArray()) }} {{ implode(',', $pim->tpk()->get()->pluck('name_tpk')->toArray()) }}</td>
                        <td>{{$pim->ftebal}}</td>
                        <td>{{$pim->flebar}}</td>
                        <td>{{$pim->fpanjang}}</td>
                        <td>{{$pim->sortimen}}</td>
                        <td>{{$pim->specs}}</td>
                        <td>{{ implode(',', $pim->contractor()->get()->pluck('name_vendor')->toArray()) }}</td>
                        <td>{{$pim->informasilain}}</td>
                        <td> {{ implode(',', $pim->vehicle()->get()->pluck('vehicle_name')->toArray()) }} {{$pim->notransport}}</td>
                        <td>{{$pim->estdocm3}}</td>
                        <td>{{$pim->whbongkar}}</td>
                        <td>{{$pim->whstapel}}</td>
                        <td>{{$pim->spb}}</td>
                        <td>{{$pim->datesupplierpayment}}</td>
                        <td>{{$pim->totalqty}} </td>
                        <td>{{$pim->totalm3}} </td>
                        <td>{{$pim->totalinvprice}} </td>
                        <td>{{$pim->handling}}</td>
                        <td>{{$pim->code_expeditionpayment}} </td>
                        <td>{{$pim->paydate_expeditionpayment}} </td>
                        <td>{{$pim->price_expeditionpayment}} </td>
                        <td>{{$pim->code_freightpayment}} </td>
                        <td>{{$pim->emkl}} </td>
                        <td>{{$pim->paydate_freightpayment}} </td>
                        <td>{{$pim->price_freightpayment}} </td>
                        <td>{{$pim->grading_expenses}} </td>
                        <td>{{$pim->biayalelang}} </td>
                        <td>{{$pim->retribusi}} </td>
                        <td>{{$pim->biayalansir}} </td>
                        <td>{{$pim->fee}} </td>
                        <td> 
                            <a href="{{ route('pim.edit', $pim->id) }}" class='float-center' title="Edit">
                                                        
                                <i class="fa fa-edit"> </i>
                            </a>
                            &nbsp
                            <a class="demo1" data-id="{{$pim->id}}" title="Delete"> <i class="fa fa-trash text-red"> </i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>



<script>

$(document).ready(function(){
    $('#report_pim').click(function(){
        // e.preventDefault();
        nopim = $('#no_pim').val();

        if(nopim)
        {
            // windows.location = '/PIM/report/'+nopim;
            window.open('/PIM/report/'+nopim); 
        }
    })
})
</script>
<script>
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

     $(document).ready(function(){
        $('.chosen-select').chosen({width: "100%"});
    });

    
    function get_specs(s)
    {
        var result = s.options[s.selectedIndex].text;
        document.getElementById('specs').value = result;
    }

    function get_nmitemgroup(i)
    {
        var result = i.options[i.selectedIndex].text;
        document.getElementById('itemgroup').value = result;
    }

    $(document).ready(function(){
        $('select[name="po_reference"]').on('change', function(){
            var id = $(this).val();
            if(id)
            {
                console.log('id = '+id);
                $.ajax({
                    url: '/PIM/get/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log('data = '+data[0]+'. data2 = '+data[1]+' .data3 ='+data[2]);
                        console.log(data);
                            $('#name_vendor').val(data[0]);
                            $('#address').val(data[1]);
                            $('#city').val(data[2]);
                            $('#vendor_id').val(data[3]);
                            $('#type_vendor').val(data[4]);
                            $('#species_id').val(data[5]);
                            $('#certificate_code').val(data[6]);
                            $('#fsc_code').val(data[7]);
                            $('#spec1_id').val(data[8]);
                            $('#sortimen').val(data[8]);
                            
                    }
                });

                $.ajax({
                    url: '/PIM/getKBM/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);

                        // $('select[name="kbm_id"]').empty();
                        // $('select[name="kph_id"]').empty();
                        // $('select[name="tpk_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="kbm_id"]').append('<option value="'+key+'">'+value+'</option>');
                        })
                    
                    }
                });
            }
        })
    })

</script>
<script>
//GET KPH
    $(document).ready(function(){
        $('select[name="kbm_id"]').on('click', function(){
            var kbm_id = $(this).val();
            if(kbm_id)
            {
                console.log('kbm_id = '+kbm_id);
                $.ajax({
                    url: '/sendgrader/getKPH/'+kbm_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        // $('select[name="kph_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="kph_id"]').append('<option value="'+key+'">'+value+'</option>');
                        })
                    }
                })
            }
        })
    })

//GET TPK
    $(document).ready(function(){
        $('select[name="kph_id"]').on('click', function(){
            var kph_id = $(this).val();
            if(kph_id)
            {
                console.log('kph_id = '+kph_id);
                $.ajax({
                    url: '/sendgrader/getTPK/'+kph_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        // $('select[name="tpk_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="tpk_id"]').append('<option value="'+key+'">'+value+'</option>');
                        })
                    }
                })
            }
        })
    })
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
                title: "Are you sure want to delete this PIM?",
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
                                url : "{{ url('PIM/delete')}}" + '/' + id,
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
<script>
    function diff_minutes(dt2, dt1) 
    {
        dt2 = document.getElementById('endtime').value;
        dt1 = document.getElementById('starttime').value;
        var diff =(dt2.getTime() - dt1.getTime()) / 1000;
        var diff /= 60;
        return Math.abs(Math.round(diff));
        document.getElementById('totalmenit').value = diff_minutes(dt2, dt1);
    }

  
    
</script>


@endsection