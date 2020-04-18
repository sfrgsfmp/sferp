@extends('menu.mainmenu')
@section('title','Job Order')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Job Order')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Update Job Order')</strong>
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
        // return preg_replace('"/[^a-zA-Z0-9]/"',' ',$string);
        return preg_replace('/[^.,A-Za-z0-9\-]/', ' ', $string);
    }
?>
@section('content')
<div class="col-sm-12">
    <div class="ibox-content">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li ><a class="nav-link active" data-toggle="tab" href="#tab-1">General</a></li>
                <li ><a class="nav-link" data-toggle="tab" href="#tab-2" id="tab2">Other</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-3" id="tab3">Quality</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                    
                        <form action="{{ route('jo.update', ['j' => $j->id]) }}" method="POST">
                        @csrf 
                            <div class="row">        
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="code_jo" name="code_jo" readonly value="{{$j->code_jo}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Job Order No</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="jo" name="jo" readonly value="{{$j->jo}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Apply Date</label>
                                        <div class="col-sm-10">
                                            <div class="input-daterange input-group" >
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type='text' class="form-control datepicker-here @error('applydate') is-invalid @enderror" name="applydate" id="applydate" data-language='en' value="{{$j->applydate}}"/>
                                                @error('applydate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Objective</label>
                                        <div class="col-sm-10">
                                            <select id="objective" name="objective" class="chosen-select form-control @error('objective') is-invalid @enderror">
                                                @foreach($objective as $obj)
                                                <option value="{{$obj->id}}" {{ $obj->id == $j->objective ? 'selected':'' }}> {{$obj->objective_name }} </option>
                                                @endforeach
                                            </select>
                                            @error('objective')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Division</label>
                                        <div class="col-sm-7">
                                            <select class="form-control @error('division') is-invalid @enderror" id="division" name="division" readonly>
                                                @foreach($company as $com)
                                                    <option value="{{$com->code}}" {{ $com->code == $j->division ? 'selected':'' }} >{{$com->code}}</option>
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
                                            <select class="form-control @error('itemgroup_id') is-invalid @enderror" id="itemgroup_id" name="itemgroup_id" readonly>
                                                <option value=""> Choose</option>
                                                @foreach($itemgroup as $ig)
                                                    <option value="{{$ig->id}}" {{ $ig->id == $j->itemgroup_id ? 'selected':'' }}>{{$ig->itemgroup_code}}</option>
                                                @endforeach
                                            </select>
                                            @error('itemgroup_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <?php
                                $pimcode = removeSymbol($pimcode);
                                $pimno = removeSymbol($pimno);
                                // $po = removeSymbol($po);
                                $date = removeSymbol($date);
                                $parcel = removeSymbol($parcel);
                                $speciesname = removeSymbol($speciesname);
                                // $measurement = removeSymbol($measurement);
                                // $document = removeSymbol($document);
                                $vendor = removeSymbol($vendor);
                                $tpk = removeSymbol($tpk);
                                $specname = removeSymbol($specname);
                                $notransport = removeSymbol($notransport);
                                // $certificate_name = removeSymbol($certificate_name);
                                $sortimen = removeSymbol($sortimen);
                                $kode_fsc = removeSymbol($kode_fsc);
                                $contractor = removeSymbol($contractor);
                                $typetransport = removeSymbol($typetransport);
                            ?>

                            <div class="row">
                                <div class="col-sm-9">
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">PIM Code</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control" id="pimid" name="pimid" readonly value="{{$j->pimid}}">

                                                <input type="text" class="form-control" id="pim_code" name="pim_code" readonly value="{{ implode(',', $j->pims()->get()->pluck('code_pim')->toArray()) }}">
                                                
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
                                </div>
                            </div>
                           
                           <div class="row">
                                <div class="col-sm-6 b-r">
                                    <h4 class="m-t-none m-b">Detail PIM</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> No PIM </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="pimno" name="pimno" class="form-control" readonly value="{{$pimno}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>PO Reference</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="po_reference" name="po_reference" class="form-control" readonly value="{{$po}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Vendor</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="vendor" name="vendor" class="form-control" readonly value="{{$vendor}} - {{$tpk}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Spec1</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="spec1" name="spec1" class="form-control" readonly value="{{$specname}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Sortimen</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="sortimen" name="sortimen" class="form-control" readonly value="{{$sortimen}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Certificate</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="certificate" name="certificate" class="form-control" readonly value="{{$certificate_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Code FSC</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="kodefsc" name="kodefsc" class="form-control" readonly value="{{$kode_fsc}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Transport Type</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="typetransport" name="typetransport" class="form-control" readonly value="{{$typetransport}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label>Transport No</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="notransport" name="notransport" class="form-control" readonly value="{{$notransport}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="m-t-none m-b">Detail PIM</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Est/Doc M3</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="estdocm3" id="estdocm3" class="form-control @error('estdocm3') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->estdocm3}}">
                                            @error('estdocm3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">ETA Date</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="etadate" id="etadate" class="form-control" readonly value="{{$date}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Parcel</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="parcel" id="parcel" class="form-control" readonly value="{{$parcel}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Species</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="species" id="species" class="form-control" readonly value="{{$speciesname}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Measurement</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea name="measurement" id="measurement" class="form-control" readonly> {{$measurement}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Document</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea name="document" id="document" class="form-control" readonly> {{$document }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </form> -->  
                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        
                            <div class="row">
                                
                                <div class="col-md-11">
                                    <h4 class="m-t-none m-b">Person</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Contractor </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="contractor" name="contractor" class="form-control" readonly value="{{$contractor}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> TUK </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" id="tuk" name="tuk" class="form-control @error('TUK') is-invalid @enderror" value="{{$j->tuk}}">
                                            @error('TUK')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <h4 class="m-t-none m-b">Warehouse</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> WH Grade </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="chosen-select form-control @error('whgrade') is-invalid @enderror" id="whgrade" name="whgrade"> 
                                                <option value="0">Choose</option> 
                                                @foreach($warehouse as $wh)
                                                    <option value="{{$wh->id}}" {{ $wh->id == $j->whgrade ? 'selected':'' }}> {{$wh->warehouse_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('whgrade')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> WH Simpan </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="chosen-select form-control @error('whsimpan') is-invalid @enderror" id="whsimpan" name="whsimpan"> 
                                                <option value="0">Choose</option> 
                                                @foreach($warehouse as $wh)
                                                    <option value="{{$wh->id}}" {{ $wh->id == $j->whsimpan ? 'selected':'' }}>  {{$wh->warehouse_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('whsimpan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> WH Tahan </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="chosen-select form-control @error('whtahan') is-invalid @enderror" id="whtahan" name="whtahan"> 
                                                <option value="0">Choose</option> 
                                                @foreach($warehouse as $wh)
                                                    <option value="{{$wh->id}}" {{ $wh->id == $j->whtahan ? 'selected':'' }}>  {{$wh->warehouse_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('whtahan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Instruksi Lain </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea id="instruksilain" name="instruksilain" class="form-control @error('instruksilain') is-invalid @enderror">{{$j->instruksilain}} </textarea>
                                            @error('instruksilain')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Identitas </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="identitas" name="identitas" class="form-control @error('identitas') is-invalid @enderror">
                                                <option value="Log Tag" {{ $j->identitas === 'Log Tag' ? 'selected':'' }}> Log Tag</option>
                                                <option value="Kitir KK" {{ $j->identitas === 'Kitir KK' ? 'selected':'' }}> Kitir KK</option>
                                            </select>
                                            @error('identitas')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <h4 class="m-t-none m-b">Ukuran Fisik</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Tebal</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="tebalfisik" id="tebalfisik" class="form-control @error('tebalfisik') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->tebalfisik}}">
                                            @error('tebalfisik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Lebar</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="lebarfisik" id="lebarfisik" class="form-control @error('lebarfisik') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->lebarfisik}}">
                                            @error('lebarfisik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Panjang</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="panjangfisik" id="panjangfisik" class="form-control @error('panjangfisik') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->panjangfisik}}">
                                            @error('panjangfisik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Deskripsi</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea id="descfisik" name="descfisik" class="form-control @error('descfisik') is-invalid @enderror"> {{$j->descfisik}} </textarea>
                                            @error('descfisik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <h4 class="m-t-none m-b">Ukuran Beli</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Tebal</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="tebalbeli" id="tebalbeli" class="form-control @error('Tebal Beli') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->tebalbeli}}">
                                            @error('Tebal Beli')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Lebar</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="lebarbeli" id="lebarbeli" class="form-control @error('Lebar Beli') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->lebarbeli}}">
                                            @error('Lebar Beli')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Panjang</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="panjangbeli" id="panjangbeli" class="form-control @error('Panjang Beli') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->panjangbeli}}">
                                            @error('Panjang Beli')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Deskripsi</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea id="descbeli" name="descbeli" class="form-control @error('Deskripsi Beli') is-invalid @enderror"> {{$j->descbeli}}</textarea>
                                            @error('Deskripsi Beli')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                    <h4 class="m-t-none m-b">Ukuran Invoice</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Tebal</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="tebalinvoice" id="tebalinvoice" class="form-control @error('Tebal Invoice') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->tebalinvoice}}">
                                            @error('tebalinvoice')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Lebar</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="lebarinvoice" id="lebarinvoice" class="form-control @error('Lebar Invoice') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->lebarinvoice}}">
                                            @error('Lebar Invoice')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Panjang</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" name="panjanginvoice" id="panjanginvoice" class="form-control @error('Panjang Invoice') is-invalid @enderror" onkeypress="return isNumber(event)" value="{{$j->panjanginvoice}}">
                                            @error('Panjang Invoice')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label class="font-normal">Deskripsi</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <textarea id="descinvoice" name="descinvoice" class="form-control @error('Deskripsi Invoice') is-invalid @enderror"> {{$j->descinvoice}}</textarea>
                                            @error('Deskripsi Invoice')
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
                <div id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        
                            <div class="row">
                                <div class="col-sm-6 b-r">
                                    <h4 class="m-t-none m-b">Quality</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Serat Miring </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="seratmiring" name="seratmiring" class="form-control @error('Serat Miring') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->seratmiring ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Serat Miring')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Serat Putus </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="ser" name="seratputus" class="form-control @error('Serat Putus') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->seratputus ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Serat Putus')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Bengkok Lebar </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="bengkoklebar" name="bengkoklebar" class="form-control @error('Bengkok Lebar') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->bengkoklebar ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Bengkok Lebar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Bengkok Tebal </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="bengkoktebal" name="bengkoktebal" class="form-control @error('Bengkok Tebal') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->bengkoktebal ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Bengkok Tebal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Gelombang Lebar </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="gelombanglebar" name="gelombanglebar" class="form-control @error('Gelombang Lebar') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->gelombanglebar ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Gelombang Lebar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Gelombang Tebal </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="gelombangtebal" name="gelombangtebal" class="form-control @error('Gelombang Tebal') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->gelombangtebal ? 'selected':'' }}>  {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Gelombang Tebal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Twist</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="twist" name="twist" class="form-control @error('twist') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->twist ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('twist')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Warna Gelap </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="warnagelap" name="warnagelap" class="form-control @error('Warna Gelap') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->warnagelap ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Warna Gelap')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Stain </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="stain" name="stain" class="form-control @error('Stain') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->stain ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Stain')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Tali Air </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="taliair" name="taliair" class="form-control @error('Tali Air') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->taliair ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Tali Air')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Busuk </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="busuk" name="busuk" class="form-control @error('Busuk') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->busuk ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Busuk')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Pecah Permukaan </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="pecahpermukaan" name="pecahpermukaan" class="form-control @error('Pecah Permukaan') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->pecahpermukaan ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Pecah Permukaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Pecah Ujung </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="pecahujung" name="pecahujung" class="form-control @error('Pecah Ujung') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->pecahujung ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Pecah Ujung')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Retak</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="retak" name="retak" class="form-control @error('Retak') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->retak ? 'selected':'' }} > {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Retak')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <h4 class="m-t-none m-b">Quality</h4>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Mata Mati </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="matamati" name="matamati" class="form-control @error('Mata Mati') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->matamati ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Mata Mati')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Kulit Tumbuh </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="kulittumbuh" name="kulittumbuh" class="form-control @error('Kulit Tumbuh') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->kulittumbuh ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Kulit Tumbuh')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Pinholes </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="pinholes" name="pinholes" class="form-control @error('Pinholes') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->pinholes ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Pinholes')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Doreng </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="doreng" name="doreng" class="form-control @error('Doreng') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->doreng ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Doreng')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Warna Terang </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="warnaterang" name="warnaterang" class="form-control @error('warnaterang') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->warnaterang ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('warnaterang')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Kayu Muda </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="kayumuda" name="kayumuda" class="form-control @error('Kayu Muda') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->kayumuda ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Kayu Muda')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Kuku Macan </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="kukumacan" name="kukumacan" class="form-control @error('Kuku Macan') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->kukumacan ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Kuku Macan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Sisi Baik</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="sisibaik" name="sisibaik" class="form-control @error('Sisi Baik') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->sisibaik ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Sisi Baik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> S2S/S4S HM 2B </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="2b" name="2b" class="form-control @error('S2S/S4S HM 2B') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->h2b ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('S2S/S4S HM 2B')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> S2S/S4S HM 2K </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="2k" name="2k" class="form-control @error('S2S/S4S HM 2K') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->h2k ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('S2S/S4S HM 2K')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Gubal Sisi Order</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="gubalsisiorder" name="gubalsisiorder" class="form-control @error('Gubal Sisi Order') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->gubalsisiorder ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Gubal Sisi Order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Gubal Sisi Non Order </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="gubalsisinonorder" name="gubalsisinonorder" class="form-control @error('Gubal Sisi Non Order') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->gubalsisinonorder ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Gubal Sisi Non Order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Cacat Ring </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="cacatring" name="cacatring" class="form-control @error('Cacat Ring') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->cacatring ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Cacat Ring')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <label> Kualitas </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select id="kualitas" name="kualitas" class="form-control @error('Kualitas') is-invalid @enderror">
                                                <option value=""> </option>
                                                @foreach($quality as $qty)
                                                    <option value="{{$qty->id}}" {{ $qty->id == $j->kualitas ? 'selected':'' }}> {{$qty->quality_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('Kualitas')
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
            <div class="table-responsive">
                <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                    <thead>
                        <tr>
                            <th data-toggle="true">Code JO</th>
                            <th>No JO</th>
                            <th data-hide="all">Division</th>
                            <th data-hide="all">Item Group</th>
                            <th> Apply Date </th>
                            <!-- <th>Objective</th> -->
                            <th>PIM</th>
                            
                            <th data-hide="all"> WH Grade</th>
                            <th data-hide="all"> WH Simpan</th>
                            <th data-hide="all"> WH Tahan</th>
                            <th> Instruksi Lain</th>
                            <th> Identitas</th>
                            <th data-hide="all"> Tebal Fisik</th>
                            <th data-hide="all"> Lebar Fisik</th>
                            <th data-hide="all"> Panjang Fisik</th>
                            <th data-hide="all"> Desc Fisik</th>
                            <th data-hide="all"> Tebal Beli</th>
                            <th data-hide="all"> Lebar Beli</th>
                            <th data-hide="all"> Panjang Beli</th>
                            <th data-hide="all"> Desc Beli</th>
                            <th data-hide="all"> Tebal Invoice</th>
                            <th data-hide="all"> Lebar Invoice</th>
                            <th data-hide="all"> Panjang Invoice</th>
                            <th data-hide="all"> Desc Invoice</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jos as $jo)
                        <tr>
                            <td> {{$jo->code_jo}} </td>
                            <td> {{$jo->jo}}</td>
                            <td> {{$jo->division}}</td>
                            <td> {{ implode(',', $jo->itemgroups()->get()->pluck('itemgroup_name')->toArray()) }}</td>
                            <td> {{$jo->applydate}}</td>
                            
                            <td> {{ implode(',', $jo->pims()->get()->pluck('code_pim')->toArray()) }} </td>
                            
                            <td> {{$jo->whgrade}}</td>
                            <td> {{$jo->whsimpan}}</td>
                            <td> {{$jo->whtahan}}</td>
                            <td> {{$jo->instruksilain}}</td>
                            <td> {{$jo->identitas}}</td>
                            <td> {{$jo->tebalfisik}}</td>
                            <td> {{$jo->lebarfisik}}</td>
                            <td> {{$jo->panjangfisik}}</td>
                            <td> {{$jo->descfisik}}</td>
                            <td> {{$jo->tebalbeli}}</td>
                            <td> {{$jo->lebarbeli}}</td>
                            <td> {{$jo->panjangbeli}}</td>
                            <td> {{$jo->descbeli}}</td>
                            <td> {{$jo->tebalinvoice}}</td>
                            <td> {{$jo->lebarinvoice}}</td>
                            <td> {{$jo->panjanginvoice}}</td>
                            <td> {{$jo->descinvoice}}</td>
                            <td align="center">
                                <a href="{{ route('jo.edit', $jo->id) }}" class='float-center' title="Edit">                      
                                    <i class="fa fa-edit"> </i>
                                </a>
                                &nbsp
                                <a class="demo1" data-id="{{$jo->id}}" title="Delete"> <i class="fa fa-trash text-red"> </i></a>
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
                                <td>{{$pim->po_reference}}</td>
                                <td>{{$pim->noprocurement}}</td>
                                <td>{{$pim->noparcel}}</td>
                                <td>{{$pim->bp}}</td>
                                <td>{{$pim->vendor_id}}</td>
                                <td>{{$pim->sortimen}}</td>
                                <td>{{$pim->specs}}</td>
                                <td>{{$pim->informasilain}}</td>
                                <td>{{$pim->notransport}}</td>
                                <td>{{$pim->estdocm3}}</td>
                                <td>{{$pim->spb}}</td>
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

    $(document).ready(function(){
        $('.chosen-select').chosen({width: "100%"});
    });

  
//SELECT PIM FROM MODAL
    $(document).ready(function(){
        $('.selectpim').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            if(id)
            {
                console.log('id = '+id);

                $.ajax({
                    url: '/JO/selectpim/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        $('#pim_code').val(data[0]);
                        $('#pimno').val(data[1]);
                        $('#vendor').val(data[2]);
                        $('#po_reference').val(data[3]);
                        $('#spec1').val(data[4]);
                        $('#sortimen').val(data[5]);
                        $('#certificate').val(data[6]);
                        $('#kodefsc').val(data[7]);
                        $('#typetransport').val(data[8]);
                        $('#notransport').val(data[9]);
                        $('#etadate').val(data[10]);
                        $('#parcel').val(data[11]);
                        $('#estdocm3').val(data[12]);
                        $('#species').val(data[13]);
                        $('#measurement').val(data[14]);
                        $('#document').val(data[15]);
                        $('#contractor').val(data[16]);
                        $('#pimid').val(data[17]);
                        $('#myModal5').modal('hide');
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
                title: "Are you sure want to delete this JO?",
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
                                url : "{{ url('JO/delete')}}" + '/' + id,
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