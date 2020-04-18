@extends('menu.mainmenu')
@section('title','Planning Income Material')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Planning Income Material')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('pim.create') }}">Create</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Update Planning Income Material')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

<?php
    function removeSymbol($string)
    {
        $string = str_replace(' ', ' ',$string); 
        return preg_replace('/[^.,A-Za-z0-9\-]/', ' ', $string);
    }
?>
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
                    
                        <form action="{{ route('pim.update', ['pims' => $pims->id]) }}" method="POST">
                        @csrf 
                            <div class="row">        
                                
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('Number') is-invalid @enderror" id="code_pim" name="code_pim" value="{{$pims->code_pim}}" readonly>
                                            @error('Number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <!-- //No urut pim. Manual. Untuk reporting -->
                                        <label class="col-sm-2 col-form-label">PIM No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('PIM_no') is-invalid @enderror" id="pimno" name="pimno" value="{{$pims->pimno}}">
                                            @error('PIM_no')
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
                                                    <option value="{{$com->code}}" {{$com->code == $pims->division ?'selected':'' }}>{{$com->code}}</option>
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
                                            <select class="form-control @error('itemgroup') is-invalid @enderror" id="itemgroup_id" name="itemgroup_id">
                                                @foreach($itemgroup as $ig)
                                                    <option value="{{$ig->id}}" {{$ig->id == $pims->itemgroup_id ?'selected':''}}>{{$ig->itemgroup_code}}</option>
                                                @endforeach
                                            </select>
                                            @error('itemgroup')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-11">
                                        
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Apply Date</label>
                                        <div class="col-sm-10">
                                            <div class="input-daterange input-group" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type='text' class="form-control datepicker-here @error('apply_date') is-invalid @enderror" name="applydate" id="applydate" data-language='en' value="{{$pims->applydate}}"/>
                                                @error('apply_date')
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
                                                <option value="{{$obj->id}}" {{$obj->id == $pims->objective ?'selected':''}}> {{$obj->objective_name }} </option>
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
                                                <option value="Bongkar" {{ ($pims->process === 'Bongkar') ? 'selected' : '' }}> Bongkar</option>
                                                <option value="Bongkar Lebar" {{ ($pims->process === 'Bongkar Lebar') ? 'selected' : '' }}> Bongkar Lebar</option>
                                                <option value="Bongkar Lebar Forklift" {{ ($pims->process === 'Bongkar Lebar Forklift') ? 'selected' : '' }}> Bongkar Lebar Forklift</option>
                                                <option value="Bongkar Lebar Stapel" {{ ($pims->process === 'Bongkar Lebar Stapel') ? 'selected' : '' }}> Bongkar Lebar Stapel</option>
                                                <option value="Bongkar Stapel" {{ ($pims->process === 'Bongkar Stapel') ? 'selected' : '' }}> Bongkar Stapel </option>
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
                                            <select id="warehouse_id" name="warehouse_id" class="form-control @error('warehouse') is-invalid @enderror">
                                                @foreach($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id}}" {{$warehouse->id == $pims->warehouse_id ? 'selected':''}}> {{$warehouse->warehouse_name}}</option>
                                                
                                                @endforeach
                                            </select>
                                            @error('warehouse')
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
                                                <option value="Loose" {{ ($pims->carasusun === 'Loose') ? 'selected' : '' }}> Loose</option>
                                                <option value="Palletise" {{ ($pims->carasusun === 'Palletise') ? 'selected' : '' }}> Palletise </option>
                                                
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
                                            <textarea id="soplangkah" name="soplangkah" class="form-control @error('SOP_langkah') is-invalid @enderror"> {{$pims->soplangkah}} </textarea>
                                            @error('SOP_langkah')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">PO Reference</label>
                                        <div class="col-sm-10">
                                            <select class="chosen-select form-control @error('PO_reference') is-invalid @enderror" id="po_reference" name="po_reference"> 
                                                <option value=""> Choose</option>
                                                @foreach($po as $po)
                                                    <option value="{{ $po->id}}" {{$po->id == $pims->po_reference ? 'selected':''}}> {{$po->code}}</option>
                                                @endforeach
                                            </select>
                                            @error('PO_reference')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Procurement No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('Procurement_no') is-invalid @enderror" id="noprocurement" name="noprocurement" value="{{$pims->noprocurement}}">
                                            @error('Procurement_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Parcel No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('Parcel_no') is-invalid @enderror" id="noparcel" name="noparcel" value="{{$pims->noparcel}}">
                                            @error('Parcel_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">BP No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('BP_no') is-invalid @enderror" id="bp" name="bp" value="{{$pims->bp}}">
                                            @error('BP_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> -->
                                    <?php
                                        $species = removeSymbol($species);
                                        $nmvendor = removeSymbol($nmvendor);
                                        $address = removeSymbol($address);
                                        $city = removeSymbol($city);
                                        // $certificate = removeSymbol($certificate);
                                        $fsc = removeSymbol($fsc);
                                        $spec1 = removeSymbol($spec1);

                                    ?>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Species</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('Species') is-invalid @enderror" id="species_id" name="species_id" readonly value="{{$species}}">
                                            @error('Species')
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
                                            <input type="text" class="form-control" id="vendor_id" name="vendor_id" readonly value="{{$pims->vendor_id}}">
                                            <input type="text" class="form-control" id="type_vendor" name="type_vendor" readonly>
                                        </div>
                                    </div>
                                    <!-- <div id="location" style="display:none"> -->
                                            <div class="form-group row">
                                                <div class="col-lg-3">
                                                    <label> KBM </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select name="kbm_id" id="kbm_id" class="form-control form-control-lg @error('KBM') is-invalid @enderror">
                                                        <option value=""> Choose </option>
                                                        @foreach($kbm as $kbm)
                                                            <option value="{{$kbm->id}}" {{$kbm->id == $pims->kbm_id ?'selected':''}}> {{$kbm->name_kbm}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('KBM')
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
                                                    <select name="kph_id" id="kph_id" class="form-control form-control-lg @error('KPH') is-invalid @enderror" >
                                                    <option value=""> Choose </option>
                                                    @foreach($kph as $kph)
                                                            <option value="{{$kph->id}}" {{$kph->id == $pims->kph_id ?'selected':''}}> {{$kph->name_kph}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                                @error('KPH')
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
                                                    <select name="tpk_id" id="tpk_id" class="form-control form-control-lg @error('TPK') is-invalid @enderror" >
                                                    <option value=""> Choose </option>
                                                    @foreach($tpk as $tpk)
                                                            <option value="{{$tpk->id}}" {{$tpk->id == $pims->tpk_id ?'selected':''}}> {{$tpk->name_tpk}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('TPK')
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
                                            <input type="text" class="form-control" id="name_vendor" name="name_vendor" readonly value="{{$nmvendor}}">
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
                                            
                                            <textarea id="address" name="address" class="form-control" readonly> {{$address}}</textarea>
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
                                        
                                            <input type="text" class="form-control" id="city" name="city" readonly value="{{$city}}">
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
                                        
                                            <input type="text" id="certificate_code" name="certificate_code" class="form-control" readonly value="{{$certificate}}">
                                            @error('Certificate_code')
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
                                        
                                            <input type="text" class="form-control @error('FSC') is-invalid @enderror" id="fsc_code" name="fsc_code" readonly value="{{$fsc}}">
                                            
                                            @error('FSC')
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
                                        
                                            <input type="text" class="form-control @error('FTebal') is-invalid @enderror" id="ftebal" name="ftebal" value="{{$pims->ftebal}}">
                                            @error('FTebal')
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
                                        
                                            <input type="text" class="form-control @error('FLebar') is-invalid @enderror" id="flebar" name="flebar" value="{{$pims->flebar}}">
                                            @error('FLebar')
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
                                        
                                            <input type="text" class="form-control @error('FPanjang') is-invalid @enderror" id="fpanjang" name="fpanjang" value="{{$pims->fpanjang}}">
                                            @error('FPanjang')
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
                                            
                                            <input type="text" name="spec1_id" id="spec1_id" class="form-control" readonly value="{{$spec1}}">
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
                                            <input type="text" class="form-control @error('sortimen') is-invalid @enderror" id="sortimen" name="sortimen" value="{{$pims->sortimen}}"> 
                                            
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
                                            <select class="chosen-select form-control @error('Specification2') is-invalid @enderror" id="spec2_id" name="spec2_id" onchange="get_specs(this)"> 
                                                
                                                 @foreach($specification as $spec2)
                                                    <option value="{{ $spec2->id }}" {{$spec2->id == $pims->spec2_id ? 'selected':''}}> {{ $spec2->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Specification2')
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
                                            <input type="text" class="form-control @error('specs') is-invalid @enderror" id="specs" name="specs" value="{{$pims->specs}}">
                                            
                                            @error('specs')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
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
                <div id="tab-2" class="tab-pane">
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

                                    <h4 class="m-t-none m-b">Instruction</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Contractor</label>
                                        <div class="col-sm-9">
                                            <select class="chosen-select form-control @error('Contractor') is-invalid @enderror" id="contractor_id" name="contractor_id">
                                                <option value=""> </option>
                                                @foreach($contractors as $contractor)
                                                    <option value="{{$contractor->id}}" {{$contractor->id == $pims->contractor_id ? 'selected':''}}> {{$contractor->name_vendor}}</option>
                                                @endforeach
                                            </select>
                                            @error('Contractor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Informasi Lain</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('Informasi Lain') is-invalid @enderror" id="informasilain" name="informasilain"> {{$pims->informasilain}}</textarea>
                                            @error('Informasi Lain')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Note</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('Note') is-invalid @enderror" id="note" name="note"> {{$pims->note}}</textarea>
                                            @error('Note')
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
                                            <select class="chosen-select form-control @error('Type') is-invalid @enderror" id="type_transport" name="type_transport">
                                                <option value=""> Choose</option>
                                                @foreach($vehicle as $vehicle)
                                                    <option value="{{$vehicle->id}}" {{$vehicle->id == $pims->type_transport_id ? 'selected':''}}> {{$vehicle->vehicle_name}} </option>
                                                @endforeach
                                            </select>
                                            @error('Type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">No</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="notransport" name="notransport" class="form-control @error('NoTransport') is-invalid @enderror" value="{{$pims->notransport}}">
                                            @error('NoTransport')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Desc</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control @error('Desc') is-invalid @enderror" id="desc" name="desc"> {{$pims->desc}} </textarea>
                                            @error('Desc')
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
                                            <select class="chosen-select form-control @error('Type M3') is-invalid @enderror" id="typem3" name="typem3">
                                                <option value="Doc M3" {{ ($pims->typem3 === 'Doc M3') ? 'selected' : '' }}> Doc M3</option>
                                                <option value="Est M3" {{ ($pims->typem3 === 'Est M3') ? 'selected' : '' }}> Est M3 </option>
                                            </select>
                                            @error('Type M3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Est/Doc M3</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('Est/Doc M3') is-invalid @enderror" id="estdocm3" name="estdocm3" value="{{$pims->estdocm3}}">
                                            @error('Est/Doc M3')
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
                                            <select class="chosen-select form-control @error('WH Bongkar') is-invalid @enderror" id="whbongkar" name="whbongkar">
                                                <option value=""> </option>
                                                @foreach($warehouses as $wr)
                                                    <option value="{{ $wr->id}}" {{$wr->id == $pims->whbongkar ?'selected':''}}> {{ $wr->warehouse_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('WH Bongkar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">WH Stapel</label>
                                        <div class="col-sm-9">
                                            <select class="chosen-select form-control @error('WH Stapel') is-invalid @enderror" id="whstapel" name="whstapel">
                                                <option value=""> </option>
                                                @foreach($warehouses as $wr)
                                                    <option value="{{ $wr->id}}" {{$wr->id == $pims->whstapel ? 'selected':''}}> {{ $wr->warehouse_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('WH Stapel')
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
                                                    <input type="time" class="form-control" id="starttime" name="starttime" step="1" value="{{$pims->starttime}}">
                                                    @error('starttime')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">to</span>
                                                    <input type="time" class="form-control" id="endtime" name="endtime" step="1" value="{{$pims->endtime}}">
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
                                            <input type="text" id="headcount" name="headcount" value="{{$pims->headcount}}" class="form-control @error('Head Count') is-invalid @enderror" onkeypress="return isNumber(event)">
                                            @error('Head Count')
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
                                                <input type='text' class="form-control datepicker-here @error('Date') is-invalid @enderror" name="date" id="date" data-language='en' value="{{$pims->date}}">
                                                @error('Date')
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
                                            <input type="text" class="form-control @error('SPB No') is-invalid @enderror" id="spb" name="spb" value="{{$pims->spb}}">
                                            @error('SPB No')
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
                                                
                                                <input type="text" class="datepicker-here form-control @error('Date Supplier Payment') is-invalid @enderror" id="datesupplierpayment" name="datesupplierpayment" data-language='en' value="{{$pims->datesupplierpayment}}">
                                                    
                                                @error('Date Supplier Payment')
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
                                            <input type="text" id="totalqty" name="totalqty" value="{{$pims->totalqty}}" class="form-control @error('Total Qty') is-invalid @enderror" onkeypress="return isNumber(event)">
                                            @error('Total Qty')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Total M3</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="totalm3" name="totalm3" value="{{$pims->totalm3}}" class="form-control @error('Total M3') is-invalid @enderror" onkeypress="return isNumber(event)">
                                            @error('Total M3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Total Inv. Price</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="totalinvprice" name="totalinvprice" value="{{$pims->totalinvprice}}" class="form-control @error('Total Inv Price') is-invalid @enderror" onkeypress="return isNumber(event)">
                                            @error('Total Inv Price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Desc</label>
                                        <div class="col-sm-9">
                                            
                                            <textarea id="desc_sup" name="desc_sup" class="form-control @error('Desc Supplier Payment') is-invalid @enderror"> {{$pims->desc_sup}}</textarea>
                                            @error('Desc Supplier Payment')
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
                                                
                                                <select class="form-control @error('Work Shift') is-invalid @enderror" id="workshift" name="workshift">
                                                    <option value="Shift 1 Morning" {{ ($pims->workshift === 'Shift 1 Morning') ? 'selected' : '' }}> Shift 1 Morning</option>
                                                    <option value="Shift 2 Evening" {{ ($pims->workshift === 'Shift 2 Evening') ? 'selected' : '' }}> Shift 2 Evening</option>
                                                    <option value="Shift 3 Night" {{ ($pims->workshift === 'Shift 3 Night') ? 'selected' : '' }}> Shift 3 Night</option>
                                                </select>
                                                    
                                                @error('Work Shift')
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
                                            
                                            <select class="form-control @error('Rate Used') is-invalid @enderror" id="rateused" name="rateused">
                                                <option value=""> choose</option>
                                                <option value="Rate10" {{ ($pims->rateused === 'Rate10') ? 'selected' : '' }}> Rate 10</option>
                                                <option value="Rate15" {{ ($pims->rateused === 'Rate15') ? 'selected' : '' }}> Rate 15</option>
                                                <option value="Rate20" {{ ($pims->rateused === 'Rate20') ? 'selected' : '' }}> Rate 20</option>
                                            </select>
                                                
                                            @error('Rate Used')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Handling</label>
                                        <div class="col-sm-9">
                                            
                                            <select type="text" class="form-control @error('Handling') is-invalid @enderror" id="handling" name="handling">
                                                <option value=""> Choose</option>
                                                @foreach($handling as $handling)
                                                    <option value="{{ $handling->id}}" {{$handling->id == $pims->handling ? 'selected':''}}> {{$handling->code}}</option>
                                                @endforeach
                                            </select>
                                            @error('Handling')
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
                                                    <option value="{{ $vendor->id}}" {{$vendor->id == $pims->code_expeditionpayment ? 'selected':''}}> {{$vendor->name_vendor}}</option>
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
                                            <input type="text" class="datepicker-here form-control @error('Pay Date Expedition Payment') is-invalid @enderror" id="paydate_expeditionpayment" name="paydate_expeditionpayment" data-language='en' value="{{ $pims->paydate_expeditionpayment}}">
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
                                           
                                            <input type="text" value="{{$pims->price_expeditionpayment}}" class="form-control @error('Price Expedition Payment') is-invalid @enderror" id="price_expeditionpayment" name="price_expeditionpayment" onkeypress="return isNumber(event)">
                                            
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
                                                    <option value="{{ $vendor->id}}" {{$vendor->id == $pims->code_freightpayment ? 'selected':''}}> {{$vendor->name_vendor}}</option>
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
                                           
                                            <input type="text" class="form-control @error('Emkl') is-invalid @enderror" id="emkl" name="emkl" value="{{$pims->emkl}}">
                                            
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
                                            <input type="text" class="datepicker-here form-control @error('Pay Date Freight Payment') is-invalid @enderror" id="paydate_freightpayment" name="paydate_freightpayment" data-language='en' value="{{$pims->paydate_freightpayment}}">
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
                                           
                                            <input type="text" class="form-control @error('Cont Type') is-invalid @enderror" id="conttype" name="conttype" value="{{$pims->conttype}}">
                                            
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
                                           
                                            <input type="text" value="{{$pims->price_freightpayment}}" class="form-control @error('Price Freight Payment') is-invalid @enderror" id="price_freightpayment" name="price_freightpayment" onkeypress="return isNumber(event)">
                                            
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
                                           
                                            <input type="text" value="{{$pims->grading_expenses}}" class="form-control @error('Grading Expenses') is-invalid @enderror" id="grading_expenses" name="grading_expenses" onkeypress="return isNumber(event)">
                                            
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
                                           
                                            <input type="text" value="{{$pims->biayalelang}}" class="form-control @error('Biaya Lelang') is-invalid @enderror" id="biayalelang" name="biayalelang" onkeypress="return isNumber(event)">
                                            
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
                                           
                                            <input type="text" value="{{$pims->retribusi}}" class="form-control @error('Retribusi') is-invalid @enderror" id="retribusi" name="retribusi" onkeypress="return isNumber(event)">
                                            
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
                                           
                                            <input type="text" value="{{$pims->biayalansir}}" class="form-control @error('Biaya Lansir') is-invalid @enderror" id="biayalansir" name="biayalansir" onkeypress="return isNumber(event)">
                                            
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
                                           
                                            <input type="text" value="{{$pims->fee}}" class="form-control @error('Fee') is-invalid @enderror" id="fee" name="fee" onkeypress="return isNumber(event)">
                                            
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
    
    </div>
</div>

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
@endsection