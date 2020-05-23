@extends('menu.mainmenu')
@section('title','Purchase Order')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Purchase Order Raw Material')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Update Purchase Order for Raw Material')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

<?php
    function removeSymbol($string)
    {
        $string = str_replace(' ', ' ',$string); // Replaces all spaces with hyphens.
        
        return preg_replace('/[^.,A-Za-z0-9\-]/', ' ', $string);
    }
?>
@section('content')
<div class="col-md-1">
    <a href="{{ route('po.create') }}" class='btn btn-info float-center btn-xs' title='Back'>
        <i class='fa fa-reply text-center'> </i>
        Back
    </a>
</div>
<div class="col-lg-11">
    <div class="alert alert-info alert-dismissable">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button"> × </button>
        <button class="btn btn-info btn-xs"> <i class='fa fa-reply text-center'> </i> Back </button>
        Click to create PO
    </div>
</div>

    <div class="col-sm-12">
        <div class="ibox-content">
            <div class="tabs-container">
                
                <ul class="nav nav-tabs">
                    <li><a class="nav-link active" data-toggle="tab" href="#tab-1">General</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-2" id="tab2">Detail</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-3" id="tab3">Purchase Order Condition</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <form action="{{ route('po.update', ['po' => $po->id]) }}" method="POST">
                            @csrf 
                                <div class="row">        
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">IPL</label>
                                            <div class="col-sm-10">

                                                <div class="input-group">
                                                    <input type="hidden" class="form-control" id="ipl" name="ipl" readonly value="{{$po->ipl}}">
                                                    <input type="text" class="form-control" id="noipl" name="noipl" readonly value="{{ implode(',', $po->ipl()->get()->pluck('noipl')->toArray()) }}">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                                    </span>
                                                </div>
                                                @error('ipl')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Number PO</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="code form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{$po->code}}" readonly>
                                                @error('code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Amended 1</label>
                                            <div class="col-sm-10">
                                                <select class="chosen-select form-control @error('amended_1') is-invalid @enderror" id="amended1" name="amended1"> 
                                                    <option value="">Choose</option> 
                                                    @foreach($pos as $p)
                                                        <option value="{{$p->code}}" {{ $p->code == $po->amended1 ?'selected':'' }}> {{$p->code}}</option>
                                                    @endforeach
                                                </select>

                                               
                                                @error('amended_1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Amended 2</label>
                                            <div class="col-sm-10">
                                                <select class="chosen-select form-control @error('amended_2') is-invalid @enderror" id="amended2" name="amended2"> 
                                                    <option value="">Choose</option> 
                                                    @foreach($pos as $o)
                                                    <option value="{{$o->code}}" {{ $o->code == $po->amended2 ?'selected':'' }}> {{$o->code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('amended_2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Amended 3</label>
                                            <div class="col-sm-10">
                                                <select class="chosen-select form-control @error('amended_3') is-invalid @enderror" id="amended3" name="amended3"> 
                                                    <option value="">Choose</option> 
                                                    @foreach($pos as $poo)
                                                    <option value="{{$poo->code}}" {{ $poo->code == $po->amended3 ?'selected':'' }}> {{$poo->code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('amended_3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Contract</label>
                                                <div class="col-sm-10">
                                                    <div class="input-daterange input-group" >
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type='text' class="form-control datepicker-here @error('startcontract') is-invalid @enderror" name="startcontract" id="startcontract" data-language='en' placeholder="Start Contract" value="{{$po->startcontract}}">
                                                        @error('startcontract')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <span class="input-group-addon">to</span>

                                                        <input type='text' class="form-control datepicker-here @error('expiredcontract') is-invalid @enderror" name="expiredcontract" id="expiredcontract" data-language='en' placeholder="Expired Contract" value="{{$po->expiredcontract}}">
                                                        @error('expiredcontract')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Spec</label>
                                            <div class="col-sm-10">
                                                <select class="form-control @error('spec') is-invalid @enderror" id="spec_id" name="spec_id">
                                                    @foreach($specs as $spec)
                                                        <option value="{{$spec->id}}" {{ $spec->id == $po->spec_id ?'selected':'' }}> {{$spec->name}} </option>
                                                    @endforeach
                                                </select>
                                                @error('spec')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Species</label>
                                            <div class="col-sm-10">
                                                <input type='text' class="form-control @error('species_name') is-invalid @enderror" id="species_name" name="species_name" readonly value="{{ implode(',', $po->species()->get()->pluck('name')->toArray()) }}">
                                                
                                                <input type='hidden' class="form-control" id="speciess" name="speciess" readonly value="{{$po->speciess}}">
                                                @error('species_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Status</label>
                                            <div class="col-sm-7">
                                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                    <option value="Approved" {{ ($po->status === 'Approved') ? 'selected' : '' }}>Approved</option>
                                                    <option value="Hold" {{ ($po->status === 'Hold') ? 'selected' : '' }}> Hold</option>
                                                    <option value="Cancel" {{ ($po->status === 'Cancel') ? 'selected' : '' }}> Cancel</option>
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
                                                <select class="form-control @error('itemgroup') is-invalid @enderror" id="itemgroup_id" name="itemgroup_id">
                                                    @foreach($itemgroup as $ig)
                                                    
                                                        <option value="{{$ig->id}}" {{ $ig->id == $po->itemgroup_id ?'selected':'' }}>{{$ig->itemgroup_code}}</option>
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
                                                <select class="form-control @error('division') is-invalid @enderror" id="division" name="division">
                                                    <option value=""> Division </option>
                                                    @foreach($company as $com)
                                                        <option value="{{$com->code}}" {{ $com->code == $po->division ?'selected':'' }}>{{$com->code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('division')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="hidden" class="form-control @error('division_id') is-invalid @enderror" id="division_id" name="division_id" readonly value="{{$po->division_id}}">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <br>
                                <?php
                                    $nm_vendor = removeSymbol($name_vendor);
                                    $city_vendor = removeSymbol($city_vendor);
                                    $address_vendor = removeSymbol($address_vendor);
                                    $name_bank = removeSymbol($name_bank);
                                    $accountno = removeSymbol($accountno);
                                    $paymentid = removeSymbol($paymentid);
                                    $accountname = removeSymbol($accountname);
                                    
                                ?>
                                <div class="row">
                                    <div class="col-sm-6 b-r">
                                        <h4 class="m-t-none m-b">Vendor</h4>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Code </label>
                                            </div>
                                            <div class="col-lg-8">
                                                
                                                <select class="chosen-select form-control @error('vendor') is-invalid @enderror" id="vendor_id" name="vendor_id"> 
                                                    <option value="">choose</option>
                                                    @foreach($vendors as $vendor)
                                                        <option value="{{$vendor->id }}" {{ $vendor->id == $po->vendor_id ?'selected':'' }}> {{$vendor->name_vendor}} </option>
                                                    @endforeach
                                                </select>
                                                @error('vendor')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- <div id="location" style="display:none"> -->
                                        <!-- <div class="form-group row">
                                                <div class="col-lg-3">
                                                    <label> KBM </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select name="kbm_id" class="form-control form-control-lg @error('KBM') is-invalid @enderror">
                                                        <option value=""> Choose </option>
                                                        @foreach($kbm as $kbm)
                                                            <option value="{{$kbm->id}}" {{ $kbm->id == $po->kbm_id ? 'selected':''}} > {{$kbm->name_kbm}}</option>
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
                                                    <select name="kph_id" class="form-control form-control-lg @error('KPH') is-invalid @enderror" >
                                                    <option value=""> Choose </option>
                                                    @foreach($kph as $kph)
                                                        <option value="{{$kph->id}}" {{ $kph->id == $po->kph_id ? 'selected':''}}> {{$kph->name_kph}}</option>
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
                                                        <option value="{{$tpk->id}}" {{ $tpk->id == $po->tpk_id ? 'selected':''}}> {{$tpk->name_tpk}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                @error('TPK')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div> -->
                                        <!-- </div> -->
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Name</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="name_vendor" name="name_vendor" readonly value="{{$nm_vendor}}">
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
                                                
                                                <textarea id="address" name="address" class="form-control" readonly> {{$address_vendor}}</textarea>
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
                                            
                                                <input type="text" class="form-control" id="city" name="city" readonly value="{{$city_vendor}}">
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <h4 class="m-t-none m-b"> Payment</h4>

                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Advising Bank </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select class="chosen-select form-control @error('bankaccount') is-invalid @enderror" id="bankaccount" name="bankaccount" readonly> 
                                                    <option value="">Choose</option> 
                                                    @foreach($ba as $bankaccount)
                                                   
                                                    <option value="{{$bankaccount->id}}" {{ $bankaccount->id == $paymentid ?'selected':'' }}> {{ implode(',', $bankaccount->banks()->get()->pluck('namebank')->toArray()) }} - {{$bankaccount->accountname}}</option>
                                                    @endforeach
                                                </select>
                                                @error('bankaccount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="font-normal">Bank</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" name="bank_id" id="bank_id" class="form-control @error('bank') is-invalid @enderror" readonly value="{{$name_bank}}">
                                                @error('bank')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="font-normal">Account No</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" name="accountno" id="accountno" class="form-control @error('accountno') is-invalid @enderror" readonly value="{{$accountno}}"/>
                                                @error('accountno')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label>Account Name  </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" name="accountname" id="accountname" class="form-control @error('accountname') is-invalid @enderror" readonly value="{{$accountname}}">
                                                @error('accountname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Payment Note </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <textarea id="paymentnote" name="paymentnote" class="form-control @error('paymentnote') is-invalid @enderror"> {{$po->paymentnote}} </textarea>
                                                @error('paymentnote')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">   
                                    <div class="col-sm-9">
                                    <h4 class="m-t-none m-b">Beneficiary</h4>
                                        <?php
                                            $code_beneficiary = removeSymbol($code_beneficiary);
                                            // $name_beneficiary = removeSymbol($name_beneficiary);
                                            $address_beneficiary = removeSymbol($address_beneficiary);
                                            $id_prov_bnf = removeSymbol($province_beneficiary_id);
                                            $id_city_bnf = removeSymbol($city_beneficiary_id);
                                            $contactperson_beneficiary = removeSymbol($contactperson_beneficiary);
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Code</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('code_beneficiary') is-invalid @enderror" id="code_beneficiary" name="code_beneficiary" readonly value="{{$code_beneficiary}}">
                                                   
                                                @error('code_beneficiary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('name_beneficiary') is-invalid @enderror" id="name_beneficiary" name="name_beneficiary" readonly value="{{$po->division}}">
                                                   
                                                @error('name_beneficiary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control @error('address_beneficiary') is-invalid @enderror" id="address_beneficiary" name="address_beneficiary" readonly > {{$address_beneficiary}} </textarea>
                                                @error('address_beneficiary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Province</label>
                                            <div class="col-sm-5">
                                                <select name="province_beneficiary" id="province_beneficiary" class="form-control @error('province_beneficiary') is-invalid @enderror" readonly>
                                                    <option value="">Province</option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{ $province->id }}" {{ $province->id == $id_prov_bnf ? 'selected':''}}> {{ $province->name }} </option>
                                                    @endforeach
                                                </select>
                                                @error('province_beneficiary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-5">
                                                <select name="city_beneficiary" id="city_beneficiary" class="form-control @error('city_beneficiary') is-invalid @enderror" readonly>
                                                    <option value="">City</option>
                                                    @foreach($city as $city)
                                                        <option value="{{ $city->id }}" {{ $city->id == $id_city_bnf ? 'selected':''}}> {{ $city->name }} </option>
                                                    @endforeach
                                                   
                                                </select>
                                                @error('city_beneficiary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Contact Person</label>
                                            <div class="col-sm-10">
                                                <input name="contactperson_beneficiary" id="contactperson_beneficiary" class="form-control @error('contactperson_beneficiary') is-invalid @enderror" readonly value="{{$contactperson_beneficiary}}">
                                                
                                                @error('contactperson_beneficiary')
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
                                        <h4 class="m-t-none m-b"></h4>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label">TaxPPN</label>
                                            </div>
                                            <div class="col-lg-3">
                                                <select id="taxppn_id" name="taxppn_id" class="form-control @error('taxppn') is-invalid @enderror">
                                                    @foreach($taxs as $tax)
                                                    <option value="{{$tax->id}}" {{ $tax->id == $po->taxppn_id ? 'selected':'' }}> {{$tax->name}}</option>
                                                    @endforeach
                                                </select>
                                                    @error('taxppn')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                            <!-- <div class="col-lg-3"> -->
                                                <label class="col-sm-2 col-form-label">TaxPPH</label>
                                            <!-- </div> -->
                                            <div class="col-lg-3">
                                                <select id="taxpph_id" name="taxpph_id" class="form-control @error('taxpph') is-invalid @enderror">
                                                    @foreach($taxs as $tax)
                                                        <option value="{{$tax->id}}" {{ $tax->id == $po->taxpph_id ? 'selected':'' }}> {{$tax->name}}</option>
                                                    @endforeach
                                                </select>
                                                    @error('taxpph')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label">NPWP</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select id="npwp" name="npwp" class="form-control @error('npwp') is-invalid @enderror">
                                                    <option value="NPWPPKP" {{ ($po->npwp === 'NPWPPKP') ? 'selected' : '' }}> NPWP PKP</option>
                                                    <option value="NonNPWP" {{ ($po->npwp === 'NonNPWP') ? 'selected' : '' }}> Non NPWP</option>
                                                </select>
                                                    @error('npwp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label">Currency</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select id="currency" name="currency" class="form-control @error('currency') is-invalid @enderror">
                                                    @foreach($currency as $cr)
                                                        <option value="{{$cr->id}}" {{ $cr->id == $po->currency ? 'selected' : ''}}> {{$cr->name}}</option>
                                                    @endforeach
                                                </select>
                                                    @error('currency')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label">Incoterms</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" id="incoterms" name="incoterms" class="form-control @error('currency') is-invalid @enderror" value="{{$po->incoterms}}">
                                                   
                                                @error('incoterms')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label">Transport </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select id="transport" name="transport" class="form-control @error('transport') is-invalid @enderror">
                                                    <option value="ByCustomer" {{ ($po->transport === 'ByCustomer') ? 'selected' : '' }}> By Customer</option>
                                                    <option value="ByVendor" {{ ($po->transport === 'ByVendor') ? 'selected' : '' }}> By Vendor</option>
                                                </select>
                                                @error('transport')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label">Certificate </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select id="certificate" name="certificate" class="form-control @error('certificate') is-invalid @enderror">
                                                    @foreach($certificate as $c)
                                                        <option value="{{$c->id}}" {{ $c->id == $po->certificate ? 'selected':'' }}> {{$c->cert_code}}</option>
                                                    @endforeach
                                                </select>
                                                @error('certificate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label">Cert.Note </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="certnote" name="certnote" value="{{$po->certnote}}">
                                                @error('certnote')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="m-t-none m-b">Concession</h4>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label">Type</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" readonly>
                                                    @error('type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label">Name</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" readonly>
                                                @error('name')
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
                                    <div class="col-sm-6">   
                                        
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Volume Note</label>
                                                <div class="col-sm-8">
                                                    <textarea id=volumenote name=volumenote class="form-control @error('volumenote') is-invalid @enderror" style="height:70%"> {{$po->volumenote}}</textarea>
                                                    @error('volumenote')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Quality Note</label>
                                                <div class="col-sm-8">
                                                    <textarea id=qualitynote name=qualitynote class="form-control @error('qualitynote') is-invalid @enderror" style="height:70%"> {{$po->qualitynote}}</textarea>
                                                    @error('qualitynote')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-sm-6">   
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Measurement</label>
                                                <div class="col-sm-8">
                                                    <textarea id=measurement name=measurement class="form-control @error('measurement') is-invalid @enderror" style="height:70%"> {{$po->measurement}} </textarea>
                                                    @error('measurement')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Document</label>
                                                <div class="col-sm-8">
                                                    <textarea id=document name=document class="form-control @error('document') is-invalid @enderror" style="height:70%"> {{$po->document}}</textarea>
                                                    @error('document')
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
                                        
                                        <button class="btn btn-primary btn-sm" type="submit" id="savegeneral" >Save</button>
                                        <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="panel-body">
                        <label class="col-sm-2 col-form-label"> <b> List PO General </b> </label>
                            <div class="table-responsive">
                                <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                                <thead>
                                        <tr>
                                            <th data-toggle="true">PO</th>
                                            <th data-hide="all"> IPL</th>
                                            <th >Contract</th>
                                            <th data-hide="all">Status</th>
                                            <th data-hide="all">Itemgroup</th>
                                            <th> Species</th>
                                            <th>Spec</th>
                                            <th>Vendor</th>
                                            <th data-hide="all">Payment Note</th>
                                            <th data-hide="all">Tax PPN</th>
                                            <th data-hide="all">Tax PPH</th>
                                            <th data-hide="all">NPWP</th>
                                            <th data-hide="all">Currency </th>
                                            <th data-hide="all">Incoterms </th>
                                            <th>Transport</th>
                                            <th data-hide="all">Certificate</th>
                                            <th data-hide="all">Cert Note</th>
                                            <th>Volume Note</th>
                                            <th data-hide="all">Quality Note</th>
                                            <th data-hide="all">Measurement</th>
                                            <th data-hide="all">Document</th>
                                            <th>Division</th>
                                            <th data-hide="all">Dia Allowence</th>
                                            <th data-hide="all">Hei Allowence</th>
                                            <th data-hide="all">Wid Allowence</th>
                                            <th data-hide="all">Leng Allowence</th>
                                            <th>Detail Note</th>
                                            <th>Sell Unit</th>
                                            <th>Teres</th>
                                            <th> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pos as $po)
                                        <tr>
                                            <td> {{$po->code}}</td>
                                            <td> {{ implode(',', $po->ipl()->get()->pluck('noipl')->toArray()) }} </td>
                                            <td> {{$po->startcontract}} - {{$po->expiredcontract}}</td>
                                            <td> {{$po->status}}</td>
                                            <td> {{ implode(',', $po->itemgroup()->get()->pluck('itemgroup_name')->toArray()) }}</td>
                                            <td> {{ implode(',', $po->species()->get()->pluck('name')->toArray()) }}</td>
                                            <td> {{ implode(',', $po->specification()->get()->pluck('name')->toArray()) }}</td>
                                            <td> {{ implode(',', $po->vendors()->get()->pluck('name_vendor')->toArray()) }} </td>
                                            <td> {{$po->paymentnote}}</td>
                                            <td> {{ implode(',', $po->taxppn()->get()->pluck('name')->toArray()) }}</td>
                                            <td> {{ implode(',', $po->taxpph()->get()->pluck('name')->toArray()) }}</td>
                                            <td> {{$po->npwp}}</td>
                                            <td> {{ implode(',', $po->currency()->get()->pluck('name')->toArray()) }}</td>
                                            <td> {{$po->incoterms}} </td>
                                            <td> {{$po->transport}}</td>
                                            <td>{{ implode(',', $po->certificate()->get()->pluck('cert_name')->toArray()) }}</td>
                                            <td> {{$po->certnote}}</td>
                                            <td> {{$po->volumenote}}</td>
                                            <td> {{$po->qualitynote}}</td>
                                            <td> {{$po->measurement}}</td>
                                            <td> {{$po->document }}</td>
                                            <td> {{$po->division}}</td>
                                            <td> {{$po->dia_allowence}}</td>
                                            <td> {{$po->hei_allowence}}</td>
                                            <td> {{$po->wid_allowence}}</td>
                                            <td> {{$po->leng_allowence}}</td>
                                            <td> {{$po->detailnote}}</td>
                                            <td> {{ implode(',', $po->measu()->get()->pluck('measurement_name')->toArray()) }}</td>
                                            <td> {{$po->teres}}</td>
                                            <td align=center> 
                                                <a href="{{ route('po.edit', $po->id) }}" class='float-center' title="Edit">
                                                    <i class="fa fa-edit"> </i>
                                                </a>
                                                &nbsp
                                                <a class="demo1" data-id="{{$po->id}}" title="Delete"> <i class="fa fa-trash text-red"> </i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    
                    <!-- //DETAIL -->
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <form action="{{ route('po.storedetail')}}" method="POST">
                            @csrf 
                                <div class="row"> 
                                   
                                    <div class="col-sm-9">       
                                        <!-- <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Number</label>
                                            <div class="col-sm-10">
                                                
                                                <select id=codepo name="codepo" class="chosen-select form-control @error('codepo') is-invalid @enderror">
                                                        <option value=""> Number PO</option>
                                                    @foreach($pos as $po)
                                                        <option value="{{$po->id}}"> {{$po->code}} </option>
                                                    @endforeach
                                                </select>
                                                @error('codepo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> -->

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Number</label>
                                            <div class="col-sm-10">
                                                
                                                <input type="text" id=code_id name="code_id" class="form-control @error('code_id') is-invalid @enderror" readonly>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Total Item</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control @error('totalitem') is-invalid @enderror" id=totalitem name=totalitem readonly>
                                                @error('totalitem')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                           
                                            <label class="col-sm-2 col-form-label">Total M3</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control @error('totalm3') is-invalid @enderror" id=totalm3 name=totalm3 readonly>
                                                @error('totalm3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                            <label class="col-sm-2 col-form-label">Total Price</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control @error('totalprice') is-invalid @enderror" id="totalprice" name="totalprice" readonly>
                                                @error('totalprice')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Dia Allowence</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="dia_allowence" name="dia_allowence" class="form-control @error('dia_allowence') is-invalid @enderror">
                                                @error('dia_allowence')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <label class="col-sm-2 col-form-label">Hei Allowence</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="hei_allowence" name="hei_allowence" value="" class="form-control @error('hei_allowence') is-invalid @enderror">
                                                @error('hei_allowence')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <label class="col-sm-2 col-form-label">Wid Allowence</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="wid_allowence" name="wid_allowence" value="" class="form-control @error('wid_allowence') is-invalid @enderror">
                                                @error('wid_allowence')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Leng Allowence</label>
                                            <div class="col-sm-7">
                                                <input type="text" id="leng_allowence" name="leng_allowence" class="form-control @error('leng_allowence') is-invalid @enderror">
                                                @error('leng_allowence')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                   
          
                                    <div class="col-sm-9">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Detail Note</label>
                                            <div class="col-sm-5">
                                               
                                                <textarea class="form-control @error('detailnote') is-invalid @enderror" id="detailnote" name="detailnote"> </textarea>
                                                @error('detailnote')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label class="col-sm-2 col-form-label">Sell Unit</label>
                                            <div class="col-sm-3">
                                                <select id="sellunit" name="sellunit" class="form-control @error('sellunit') is-invalid @enderror">
                                                    <!-- <option value="M3"> M3</option> -->
                                                    @foreach($measu as $mea)
                                                    <option value="{{$mea->id}}"> {{$mea->measurement_name}} </option>
                                                    @endforeach
                                                </select>
                                                @error('sellunit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Teres/Non</label>
                                            <div class="col-sm-7">
                                                <select id="teres" name="teres" class="form-control @error('teres') is-invalid @enderror">
                                                    <option value="Teres">Teres</option>
                                                    <option value="NonTeres">Non Teres</option>
                                                </select>
                                                @error('teres')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- </form> -->
                            <br>
                            <!-- <form action="" method="POST"> -->
                            <!-- @csrf -->
                                <div class="row">     
                                    <div class="col-sm-6 b-r">
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Species </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select class="chosen-select form-control @error('species') is-invalid @enderror" id="species" name="species"> 
                                                    <option value="">Choose</option> 
                                                    @foreach($species as $sp)
                                                    <option value="{{$sp->id}}">{{$sp->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('species')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Spec1 </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select class="chosen-select form-control @error('spec1') is-invalid @enderror" id="spec1" name="spec1"> 
                                                    <option value="">Choose</option>
                                                    @foreach($specs as $spec)
                                                        <option value="{{$spec->id}}"> {{$spec->name}}</option>
                                                    @endforeach 
                                                    
                                                </select>
                                                @error('spec1')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Spec2 </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select class="chosen-select form-control @error('spec2') is-invalid @enderror" id="spec2" name="spec2"> 
                                                    <option value="">Choose</option>
                                                    @foreach($specs as $spec)
                                                        <option value="{{$spec->id}}"> {{$spec->name}}</option>
                                                    @endforeach  
                                                    
                                                </select>
                                                @error('spec2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Sortimen </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select class="chosen-select form-control @error('sortimen') is-invalid @enderror" id="sortimen" name="sortimen"> 
                                                    <option value="">Choose</option>
                                                    <option value="A0"> A0 </option> 
                                                    <option value="A1"> A1 </option> 
                                                    <option value="A2"> A2 </option> 
                                                    <option value="A3"> A3 </option> 
                                                    <option value="A4"> A4 </option> 
                                                    <option value="A5"> A5 </option> 
                                                    <option value="A6"> A6 </option> 
                                                    <option value="A7"> A7 </option> 
                                                </select>
                                                @error('sortimen')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Quality </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <select class="chosen-select form-control @error('quality') is-invalid @enderror" id="quality" name="quality"> 
                                                    <option value="">Choose</option>
                                                    @foreach($quality as $qty)
                                                        <option value="{{$qty->id}}"> {{$qty->quality_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('sortimen')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Price </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price">
                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Charge </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('charge') is-invalid @enderror" id="charge" name="charge">
                                                @error('charge')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Discount </label>
                                            </div>
                                            <div class="col-lg-8 input-group">
                                                <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount">
                                                <span class="input-group-addon">%</span>
                                                @error('discount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Total Price </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" id="totalprice_det" name="totalprice_det" class="form-control @error('totalprice_detail') is-invalid @enderror" readonly>
                                                
                                                @error('totalprice_detail')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                           
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Komposisi D,T,L </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <textarea id="komposisi_desc" name="komposisi_desc" class="form-control @error('Komposisi') is-invalid @enderror" placeholder="Description"> </textarea>
                                                @error('Komposisi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Komposisi Pjg </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <textarea id="komposisipjg_desc" name="komposisipjg_desc" class="form-control @error('Komposisi_Pjg') is-invalid @enderror" placeholder="Description"> </textarea>
                                                @error('Komposisi_Pjg')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-6">
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Cutt/Dia </label>
                                            </div>
                                            <div class="col-lg-8">

                                                <div class="input-daterange input-group" >
                                                    <input type="text" name="cuttdia_min"  id="cuttdia_min" class="form-control @error('cutt/dia_min') is-invalid @enderror" >
                                                    @error('cutt/dia_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type="text" name="cuttdia_max" id="cuttdia_max" class="form-control @error('cutt/dia_max') is-invalid @enderror">
                                                    @error('cutt/dia_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Inv/Dia </label>
                                            </div>
                                            <div class="col-lg-8">

                                                <div class="input-daterange input-group" >
                                                    <input type="text" name="invdia_min"  id="invdia_min" class="form-control @error('inv/dia_min') is-invalid @enderror" >
                                                    @error('inv/dia_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type="text" name="invdia_max" id="invdia_max" class="form-control @error('inv/dia_max') is-invalid @enderror">
                                                    @error('inv/dia_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Cutt/Height </label>
                                            </div>
                                            <div class="col-lg-8">

                                                <div class="input-daterange input-group" >
                                                    <input type="text" name="cuttheight_min"  id="cuttheight_min" class="form-control @error('cutt/height_min') is-invalid @enderror" >
                                                    @error('cutt/height_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type="text" name="cuttheight_max" id="cuttheight_max" class="form-control @error('cutt/height_max') is-invalid @enderror">
                                                    @error('cutt/height_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Inv/Height </label>
                                            </div>
                                            <div class="col-lg-8">

                                                <div class="input-daterange input-group" >
                                                    <input type="text" name="invheight_min"  id="invheight_min" class="form-control @error('inv/height_min') is-invalid @enderror" >
                                                    @error('inv/height_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type="text" name="invheight_max" id="invheight_max" class="form-control @error('inv/height_max') is-invalid @enderror">
                                                    @error('inv/height_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Cutt/Width </label>
                                            </div>
                                            <div class="col-lg-8">

                                                <div class="input-daterange input-group" >
                                                    <input type="text" name="cuttwidth_min"  id="cuttwidth_min" class="form-control @error('cutt/width_min') is-invalid @enderror">
                                                    @error('cutt/width_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type="text" name="cuttwidth_max" id="cuttwidth_max" class="form-control @error('cutt/width_max') is-invalid @enderror">
                                                    @error('cutt/width_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Inv/Width </label>
                                            </div>
                                            <div class="col-lg-8">

                                                <div class="input-daterange input-group" >
                                                    <input type="text" name="invwidth_min" id="invwidth_min" class="form-control @error('inv/width_min') is-invalid @enderror">
                                                    @error('inv/width_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type="text" name="invwidth_max" id="invwidth_max" class="form-control @error('inv/width_max') is-invalid @enderror">
                                                    @error('inv/width_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Cutt/Length </label>
                                            </div>
                                            <div class="col-lg-8">

                                                <div class="input-daterange input-group" >
                                                    <input type="text" name="cuttlength_min"  id="cuttlength_min" class="form-control @error('cutt/length_min') is-invalid @enderror" >
                                                    @error('cutt/length_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type="text" name="cuttlength_max" id="cuttlength_max" class="form-control @error('cutt/length_max') is-invalid @enderror">
                                                    @error('cutt/length_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Inv/Length </label>
                                            </div>
                                            <div class="col-lg-8">

                                                <div class="input-daterange input-group" >
                                                    <input type="text" name="invlength_min" id="invlength_min" class="form-control @error('inv/length_min') is-invalid @enderror" >
                                                    @error('inv/length_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type="text" name="invlength_max" id="invlength_max" class="form-control @error('inv/length_max') is-invalid @enderror">
                                                    @error('inv/length_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> M3 </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control @error('M3') is-invalid @enderror" id="m3" name="m3">
                                                @error('M3')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Mutu Kayu </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <textarea id="mutukayu_desc" name="mutukayu_desc" class="form-control @error('Mutu_Kayu') is-invalid @enderror" placeholder="Description"> </textarea>
                                                @error('Mutu_Kayu')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label class="col-sm-2 col-form-label"> Status Kayu </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <textarea id="statuskayu_desc" name="statuskayu_desc" class="form-control @error('Status_Kayu') is-invalid @enderror" placeholder="Description"> </textarea>
                                                @error('Status_Kayu')
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
                        <label class="col-sm-2 col-form-label"> <b> List PO Detail </b> </label>
                            <div class="table-responsive">
                                <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                                    <thead>
                                        <tr>
                                            <!-- <th>No</th> -->
                                            <th data-toggle="true">PO</th>
                                            <th>Species</th>
                                            <th>Spec1</th>
                                            <th>Spec2</th>
                                            <th>Sortimen</th>
                                            <th data-hide="all">Quality</th>
                                            <th>Price</th>
                                            <th>Charge</th>
                                            <th>Discount</th>
                                            <th>Total Price</th>
                                            <th data-hide="all">Komposisi</th>
                                            <th data-hide="all">Komposisi Pjg</th>
                                            <th data-hide="all">Cuttdia</th>
                                            <th data-hide="all">Invdia</th>
                                            <th data-hide="all">Cuttheight</th>
                                            <th data-hide="all">Invheight</th>
                                            <th data-hide="all">Cuttwidth</th>
                                            <th data-hide="all">Invwidth</th>
                                            <th data-hide="all">Cuttlength</th>
                                            <th data-hide="all">Invlength </th>
                                            <th>M3</th>
                                            <th>Mutu Kayu </th>
                                            <th>Status Kayu  </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pod as $pod)
                                        <tr> 
                                            <td> {{$pod->code_po}}</td>
                                            <td> {{ implode(',', $pod->species()->get()->pluck('name')->toArray()) }}</td>
                                            <td> {{ implode(',', $pod->spec1()->get()->pluck('name')->toArray()) }}</td>
                                            <td> {{ implode(',', $pod->spec2()->get()->pluck('name')->toArray()) }}</td>
                                            <td> {{ implode(',', $pod->sortimen()->get()->pluck('code')->toArray()) }} </td>
                                            <td> {{ implode(',', $pod->quality()->get()->pluck('quality_name')->toArray()) }}</td>
                                            <td> {{$pod->price}}</td>
                                            <td> {{$pod->charge}}</td>
                                            <td> {{$pod->discount}}</td>
                                            <td> {{$pod->totalprice_det}}</td>
                                            <td> {{$pod->komposisi_desc}}</td>
                                            <td> {{$pod->komposisipjg_desc}}</td>
                                            <td> {{$pod->cuttdia_min}} - {{$pod->cuttdia_max}}</td>
                                            <td> {{$pod->invdia_min}} {{$pod->invdia_max}}</td>
                                            <td> {{$pod->cuttheight_min}} {{$pod->cuttheight_max}}</td>
                                            <td> {{$pod->invheight_min}} {{$pod->invheight_max}}</td>
                                            <td> {{$pod->cuttwidth_min}} {{$pod->cuttwidth_max}}</td>
                                            <td> {{$pod->invwidth_min}} {{$pod->invwidth_max}}</td>
                                            <td> {{$pod->cuttlength_min}} {{$pod->cuttlength_max}}</td>
                                            <td> {{$pod->invlength_min}} {{$pod->invlength_max}}</td>
                                            <td> {{$pod->m3}}</td>
                                            <td> {{$pod->mutukayu_desc}}</td>
                                            <td> {{$pod->statuskayu_desc}}</td>
                                            <td>
                                                    <a href="{{ route('po.editDetail', $pod->id) }}" class='float-center' title="Edit">
                                                        
                                                        <i class="fa fa-edit"> </i>
                                                    </a>
                                                    &nbsp
                                                    <a class="demo2" data-id="{{$pod->id}}" title="Delete"> <i class="fa fa-trash text-red"> </i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>    
                            
                        </div>
                    
                    </div> 

                    <!-- Purchase Order Condition -->
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <form action="{{ route('po.storecondition')}}" method="POST">
                            @csrf 
                                <div class="row">        
                                    <div class="col-sm-9">
                                        <div class="form-group row">

                                            <label class="col-sm-2 col-form-label">PO</label>
                                            <div class="col-sm-10">
                                                <select id=codeid name="codeid" class="chosen-select form-control @error('codeid') is-invalid @enderror">
                                                <option value=""> Number PO</option>
                                                    @foreach($pos as $po)
                                                        <option value="{{$po->code}}"> {{$po->code}} </option>
                                                    @endforeach
                                                </select>
                                                @error('codeid')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                            <label class="col-sm-2 col-form-label">Trucking</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control @error('trucking') is-invalid @enderror" id="trucking" name="trucking">
                                                @error('trucking')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                            <label class="col-sm-2 col-form-label"> Unit Trucking</label>
                                            <div class="col-sm-4">
                                                <select id="unit_trucking" name="unit_trucking" class="form-control @error('unit_trucking') is-invalid @enderror">
                                                    @foreach($measu as $mea)
                                                        <option value="{{$mea->id}}"> {{$mea->measurement_name}} </option>
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
                                <div class="row">
                                    <div class="col-sm-6 b-r">
                                        <h4 class="m-t-none m-b">PO condition</h4>
                                            
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Sort  </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-daterange input-group" >
                                                    <input type=text class="form-control @error('sort_min') is-invalid @enderror" id="sort_min" name="sort_min">
                                                    @error('sort_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type=text class="form-control @error('sort_max') is-invalid @enderror" id="sort_max" name="sort_max">
                                                    @error('sort_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Dia</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-daterange input-group" >
                                                    <input type=text class="form-control @error('dia_min') is-invalid @enderror" id="dia_min" name="dia_min">
                                                    @error('dia_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type=text class="form-control @error('dia_max') is-invalid @enderror" id="dia_max" name="dia_max">
                                                    @error('dia_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Length</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-daterange input-group" >
                                                    <input type=text class="form-control @error('length_min') is-invalid @enderror" id="length_min" name="length_min">
                                                    @error('length_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type=text class="form-control @error('length_max') is-invalid @enderror" id="length_max" name="length_max">
                                                    @error('length_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> M3</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-daterange input-group" >
                                                    <input type=text class="form-control @error('M3_min') is-invalid @enderror" id="M3_min" name="M3_min">
                                                    @error('M3_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type=text class="form-control @error('M3_max') is-invalid @enderror" id="M3_max" name="M3_max">
                                                    @error('M3_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4 class="m-t-none m-b">PO condition</h4>
                                            
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Dia Value  </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-daterange input-group" >
                                                <input type=text class="form-control @error('dia_value_min') is-invalid @enderror" id="dia_value_min" name="dia_value_min">
                                                    @error('dia_value_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type=text class="form-control @error('dia_value_max') is-invalid @enderror" id="dia_value_max" name="dia_value_max">
                                                    @error('dia_value_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Length Value</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-daterange input-group" >
                                                    <input type=text class="form-control @error('length_value_min') is-invalid @enderror" id="length_value_min" name="length_value_min">
                                                    @error('length_value_min')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="input-group-addon">-</span>
                                                    <input type=text class="form-control @error('length_value_max') is-invalid @enderror" id="length_value_max" name="length_value_max">
                                                    @error('length_value_max')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Value Type</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type=text class="form-control @error('value_type') is-invalid @enderror" id="value_type" name="value_type">
                                                @error('value_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label> Value %</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <input type=text class="form-control @error('value') is-invalid @enderror" id="value" name="value">
                                                @error('value')
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
                        <label class="col-sm-2 col-form-label"> <b> List PO Condition </b> </label>
                            <div class="table-responsive">
                                <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">PO</th>
                                            <th>Trucking</th>
                                            <th>Unit Trucking</th>
                                            <th>Sort</th>
                                            <th>Dia</th>
                                            <th>Length</th>
                                            <th>M3</th>
                                            <th>Dia Value</th>
                                            <th>Length Value</th>
                                            <th>Value Type</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($poc as $poc)
                                        <tr>
                                            <td> {{ $poc->code_po }}</td>
                                            <td> {{ $poc->trucking }}</td>
                                            <td> {{ implode(',', $poc->unitrucking()->get()->pluck('measurement_name')->toArray()) }}</td>
                                            <td> {{ $poc->sort_min }} - {{ $poc->sort_max}}</td>
                                            <td> {{ $poc->dia_min }} - {{$poc->dia_max}}</td>
                                            <td> {{ $poc->length_min }} - {{$poc->length_max}}</td>
                                            <td> {{ $poc->M3_min }} - {{$poc->M3_max}}</td>
                                            <td> {{ $poc->dia_value_min}} - {{ $poc->dia_value_max }}</td>
                                            <td> {{ $poc->length_value_min}} - {{ $poc->length_value_max }}</td>
                                            <td> {{ $poc->value_type}}</td>
                                            <td> {{$poc->value}}</td>
                                            <td>
                                                <a href="{{ route('po.editCondition', $poc->id) }}" class='float-center' title="Edit">
                                                    
                                                    <i class="fa fa-edit"> </i>
                                                </a>
                                                &nbsp
                                                <a class="demo3" data-id="{{$poc->id}}" title="Delete"> <i class="fa fa-trash text-red"> </i></a>
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
<!-- </div> -->


<!-- //MODAL SEARCH IPL -->
<div class="modal inmodal fade" id="myModal1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">IPL</h4>
                <small class="font-bold">Instruksi Pembelian Log</small>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <th data-toggle="true">IPL</th>
                                <th>Vendor</th>
                                <th>Species</th>
                                <th>Sortimen</th>
                                <th data-hide="all"> Status</th>
                                <th data-hide="all"> Quality</th>
                                <th data-hide="all"> KWT</th>
                                <th> Wood Drying</th>
                                <th> Schema</th>
                                <th> Volume </th>
                                <th> Status Approval</th>
                                <th> Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ipl as $ipl)
                            <tr>
                                <td>{{$ipl->noipl}} </td>
                                <td>{{$ipl->vendor_id}} </td>
                                <td>{{ implode(',', $ipl->species()->get()->pluck('name')->toArray()) }} </td>
                                <td>{{$ipl->sortimen}}</td>
                                <td>{{$ipl->status}}</td>
                                <td>{{$ipl->quality}}</td>
                                <td>{{$ipl->kwt}}</td>
                                <td>{{$ipl->wood_drying}}</td>
                                <td>{{$ipl->schema}}</td>
                                <td>{{$ipl->volume}}</td>
                                <td> Approval</td>
                                <td align=center> 
                                    <a class='selectipl' id="selectipl" data-id="{{$ipl->id}}" title="Choose">                        
                                        <i class="fa fa-square-o"> </i>
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
    //select IPL
    
    $(document).ready(function(){
        $('.selectipl').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            if(id)
            {
                console.log('id = '+id);

                $.ajax({
                    url: '/po/selectipl/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        $('#ipl').val(data[0]);
                        $('#noipl').val(data[1]);
                        $('#species_name').val(data[2]);
                        $('#speciess').val(data[3]);
                       
                        $('#myModal1').modal('hide');
                    }
                })
            }
        })
    })
</script>
<script>
  
$(document).ready(function(){
    $('select[name="vendor_id"]').on('change', function(){
        var vendor_id = $(this).val();
        if(vendor_id)
        {
            console.log('vendor_id = '+vendor_id);

            $.ajax({
                url: '/po/getKBM/'+vendor_id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);

                    $('select[name="kbm_id"]').empty();
                    $('select[name="kph_id"]').empty();
                    $('select[name="tpk_id"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="kbm_id"]').append('<option value="'+key+'">'+value+'</option>');
                    })
                   
                }
            });

            $.ajax({
                url: '/po/get/'+vendor_id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    
                    console.log(data);
                    $('#name_vendor').val(data[0]);
                    $('#address').val(data[1]);
                    $('#city').val(data[2]);
                    $('#bank_id').val(data[3]);
                    $('#accountno').val(data[4]);
                    $('#accountname').val(data[5]);
                    $('#type_').val(data[6]);
                }
            })

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
                        $('select[name="kph_id"]').empty();
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
                        $('select[name="tpk_id"]').empty();
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
    function getcode()
    {
        // alert(document.getElementById('code').value)
    }
    
</script>
<script>
    // $(document).ready(function(){
    //     $('select[name="bankaccount"]').on('change', function(){
    //         var ba_id = $(this).val();
    //         if(ba_id)
    //         {
    //             console.log('id_bankaccount = '+ba_id);
    //             $.ajax({
    //                 url: '/po/getaccount/'+ba_id,
    //                 type: 'GET',
    //                 dataTyppe: 'json',
    //                 success: function(data){
    //                     // console.log('data account = '+datas[0]+'. data2 = '+datas[1]+' .data3 ='+datas[2]);
    //                     console.log(data);
    //                     $('#bank_id').val(data[0]);
    //                     $('#accountno').val(data[1]);
    //                     $('#accountname').val(data[2]);
    //                 }
    //             })
    //         }
    //     })
    // })
</script>
<script>
    $("#code").keyup(function(){
        $(".code").val(this.value);
    });

    $(document).ready(function(){
            $('#discount').keyup(function(){
                var price = $('#price').val();
                var charge = $('#charge').val();
                var sum_price_charge = parseInt(price) + parseInt(charge);
                var dis = $('#price').val() * ($('#discount').val() / 100);
                var total = sum_price_charge - dis;

                $('#totalprice_det').val(total);
                // $('#result').text(total);

                console.log('price = '+$('#price').val());
                console.log('discount = '+$('#discount').val());
                console.log('total discount = '+dis);
                console.log('ttl = '+total);
            });
        // });    
    });
    
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });
</script>
<script>
    $(document).ready(function(){
        $('select[name="province_beneficiary"]').on('change', function(){
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
                        $('select[name="city_beneficiary"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="city_beneficiary"]').append('<option value="'+key+'">'+value+'</option>');
                        })
                    }
                })
            }
        })
    })

    $(document).ready(function(){
        $('select[name="city_beneficiary"]').on('change', function(){
            var cityid = $(this).val();
            console.log('cityid'+cityid);
        })
    })
</script>
<script>
//detail_po
    $(document).ready(function(){
        $('select[name="codepo"]').on('change', function(){
            var code_id = $(this).val();
            if(code_id)
            {
                console.log('code_id = '+code_id);
                $.ajax({
                    url: '/po/getpo/'+code_id,
                    
                    type: 'GET',
                    dataType: 'json',
                    success: function(det){
                        console.log(det);
                        $('#code_id').val(det[0]);
                        $('#totalm3').val(det[1]);
                        $('#totalitem').val(det[2]);
                        $('#totalprice').val(det[3]);

                        $('#dia_allowence').val(det[4]);
                        $('#hei_allowence').val(det[5]);
                        $('#wid_allowence').val(det[6]);
                        $('#leng_allowence').val(det[7]);
                        $('#detailnote').val(det[8]);
                        $('#species_id').val(det[9]);
                        $('#speciessname').val(det[10]);
                    }
                })
            }
        })
    })

    
    
</script>
<script>
    $(document).ready(function(){
        $('select[name="division"]').on('change', function(){
            var division = $(this).val();
            if(division)
            {
                console.log('division '+division);
                $.ajax({
                url: '/po/getbeneficiary/'+division,
                type: 'GET',
                dataType: 'json',
                success: function(divs){
                    console.log('data = '+divs[0]+'. data2 = '+divs[1]+' .data3 ='+divs[2]+' data4 ='+divs[3]);
                    console.log(divs);
                        $('#name_beneficiary').val(divs[0]);
                        $('#address_beneficiary').val(divs[1]);
                        $('#contactperson_beneficiary').val(divs[2]);
                        $('#code_beneficiary').val(divs[3]);
                        $("#province_beneficiary option:selected").val(divs[4]).text(divs[5]);
                        $("#city_beneficiary option:selected").val(divs[6]).text(divs[7]);
                        $('#division_id').val(divs[8]);
                }
            })
                
            }
        })
    })
</script>
<script>
    //delete General
    $(document).ready(function () {

        $('.demo1').click(function (e)
        {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(id);
            swal(
            {
                title: "Are you sure want to delete this Purchase Order Number with all the detail?",
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
                                url : "{{ url('po/deleteGeneral')}}" + '/' + id,
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
                            console.log('gajd delete');
                        }
                    }
                );
        });
    });

    //deleteDetail
    $(document).ready(function () {

        $('.demo2').click(function (e)
        {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(id);
            swal(
            {
                title: "Are you sure want to delete this Detail Purchase Order?",
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
                                url : "{{ url('po/deleteDetail')}}" + '/' + id,
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
                            console.log('gajd delete');
                        }
                    }
                );
        });
    });
    //deleteCondition
    $(document).ready(function () {

        $('.demo3').click(function (e)
        {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(id);
            swal(
            {
                title: "Are you sure want to delete this Detail Purchase Order?",
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
                                url : "{{ url('po/deleteCondition')}}" + '/' + id,
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
                            console.log('gajd delete');
                        }
                    }
                );
        });
    });
</script>
@endsection