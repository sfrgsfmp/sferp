@extends('menu.mainmenu')
@section('title','Sawn Timber Registering')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Sawn Timber Registering')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Edit Sawn Timber Registering')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')
<div class="col-sm-12">

    <span id="result"> </span>
    <div class="ibox">
        <div class="ibox-title">
            <h5> Edit Sawn Timber Registering </h5>
                <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                </div>
        </div>
        <div class="ibox-content">
            <form action="{{ route('ST.update', ['sts' => $sts->id] ) }}" method="POST">
            @csrf
            <!-- id - tabel sawntimber_reg -->
                <input type="hidden" id="regid" name="regid" value="{{$sts->regid}}"> 

                <div class="row">        
                    <div class="col-sm-6 b-r">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Code </label>
                            <div class="col-sm-5">
                                <input type="text" id="code" name="code" class="form-control-sm form-control @error('code') is-invalid @enderror" readonly value="{{$sts->code}}"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Reg Code </label>
                            <div class="col-sm-5">
                                <select id="reg_code" name="reg_code" class="form-control-sm form-control @error('reg_code') is-invalid @enderror" readonly> 
                                    @foreach($regcode as $rc)
                                        <option value="{{ $rc->id}}" {{ $rc->id == $sts->reg_code ? 'selected':''}}> {{$rc->code}} </option>
                                    @endforeach
                                </select>
                                @error('reg_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">TT</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="hidden" class="form-control" id="tt_id" name="tt_id" readonly value="{{$sts->tt_id}}">
                                    <input type="text" class="form-control" id="tt" name="tt" readonly value="{{$sts->code_tt}}">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1"> <i class="fa fa-search" id="window"> </i> </button>
                                    </span>
                                </div>
                                @error('tt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">TT No</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('tt_no') is-invalid @enderror" id="tt_no" name="tt_no" readonly value="{{ $sts->tt_no}}">
                                @error('tt_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Parcel</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('parcel') is-invalid @enderror" id="parcel" name="parcel" readonly value="{{$sts->noparcel}}">
                                @error('parcel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Procurement</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('procurement') is-invalid @enderror" name="procurement" id="procurement" readonly value="{{ $sts->noprocurement}}">
                                @error('parcel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vendor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="code_vendor" readonly value="{{$sts->name_vendor}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">TPK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tpkid" readonly value="{{ $sts->name_tpk }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{$sts->description}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Warehouse</label>
                            <div class="col-sm-10">
                                <select class="form-control-sm form-control @error('warehouse') is-invalid @enderror" name="warehouse">
                                    @foreach($warehouse as $wh)
                                        
                                        <option value="{{ $wh->id}}" {{ $wh->id == $sts->warehouse ? 'selected':''}}> {{ $wh->warehouse_code }} </option>
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
                            <label class="col-sm-2 col-form-label">Min Max</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control-sm form-control @error('min') is-invalid @enderror" name="min" value="{{$sts->min}}">
                                    @error('min')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input type="text" class="form-control-sm form-control @error('max') is-invalid @enderror" name="max" value="{{$sts->max}}">
                                    @error('max')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Certificate</label>
                            <div class="col-sm-10">
                                <input type="text" name="certificate" id="certificate" class="form-control-sm form-control" readonly value="{{ $sts->cert_code }}">
                                @error('certificate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Species</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control" name="species" id="species" readonly value="{{ $sts->speciesname}}">
                                @error('species')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Quality</label>
                            <div class="col-sm-10">
                                <select class="form-control-sm form-control @error('quality') is-invalid @enderror" name="quality">
                                    @foreach($quality as $qlt)
                                        <option value="{{$qlt->id}}"{{ $qlt->id == $sts->quality ? 'selected':''}}> {{$qlt->quality_code }}</option>
                                    @endforeach
                                </select>
                                @error('quality')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Owner</label>
                            <div class="col-sm-10">
                                <select class="form-control-sm form-control @error('owner') is-invalid @enderror" name="owner">
                                    @foreach($owners as $own)
                                        <option value="{{$own->id}}" {{ $own->id == $sts->owner ? 'selected':''}}> {{$own->owner_code }}</option>
                                    @endforeach
                                </select>
                                @error('owner')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ApplyDate</label>
                            <div class="col-sm-10">
                                <div class="input-daterange input-group" >
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type='text' class="form-control-sm form-control datepicker-here @error('applydate') is-invalid @enderror" name="applydate" id="applydate" data-language='en' value="{{$sts->applydate}}"/>
                                    @error('applydate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No Doc</label>
                            <div class="col-sm-10">
                                
                                <input type='text' class="form-control-sm form-control @error('no_document') is-invalid @enderror" name="no_document" id="no_document" readonly value="{{$sts->no_document}}">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Doc Qty</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('doc_qty') is-invalid @enderror" id="doc_qty" name="doc_qty" readonly value="{{$sts->doc_qty}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Doc M3</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('doc_m3') is-invalid @enderror" id="doc_m3" name="doc_m3" readonly value="{{$sts->docm3}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('status') is-invalid @enderror" name="status" value="{{$sts->status}}">
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Location/Row</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('location') is-invalid @enderror" name="location" value="{{$sts->location}}" >
                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">LHP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('lhp') is-invalid @enderror" name="lhp" value="{{$sts->lhp}}">
                                @error('lhp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">KMK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('kmk') is-invalid @enderror" name="kmk" value="{{$sts->kmk}}">
                                @error('pallet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Mapping</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-sm form-control @error('mapping') is-invalid @enderror" name="mapping" value="{{$sts->mapping}}">
                                @error('pallet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Spec1</label>
                            <div class="col-sm-10">
                                <select class="form-control-sm form-control @error('spec1') is-invalid @enderror" name="spec1">
                                    @foreach($specification as $spc)
                                        <option value="{{$spc->id}}" {{$spc->id == $sts->spec1 ? 'selected':''}}> {{$spc->name }}</option>
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
                            <label class="col-sm-2 col-form-label">KD/Non</label>
                            <div class="col-sm-10">
                                <select class="form-control-sm form-control @error('kdnon') is-invalid @enderror" name="kdnon" id="kdnon">
                                    @foreach($specification as $spc)
                                        <option value="{{$spc->id}}" {{$spc->id == $sts->kdnon ? 'selected':''}}> {{$spc->name }}</option>
                                    @endforeach
                                </select>
                                @error('kdnon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Spec3</label>
                            <div class="col-sm-10">
                                <select class="form-control-sm form-control @error('spec3') is-invalid @enderror" name="spec3">
                                    @foreach($specification as $spec)
                                        <option value="{{$spec->id}}" {{$spec->id == $sts->spec3 ? 'selected':''}}> {{$spec->name }}</option>
                                    @endforeach
                                </select>
                                @error('spec3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">CompItem</label>
                            <div class="col-sm-10">
                                <select class="form-control-sm form-control @error('item') is-invalid @enderror" name="item">
                                @foreach($compitem as $items)                                
                                    <option value="{{$items->id}}" {{$items->id == $sts->item ? 'selected':''}}> {{$items->name}} </option>
                                @endforeach
                                </select>
                                @error('item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="ibox-content">
                    <span id="result2"> </span>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pallet</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-sm form-control @error('pallet') is-invalid @enderror" id="pallet" name="pallet" value="{{ $sts->pallet}}">
                                    @error('pallet')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-sm-6"> Primary Size (Phisic/Cost)</label>
                                    <label class="col-sm-6"> Secondary Size (Invoice/Account)</label>
                            
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Height</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-sm form-control" id="height1" name="height1" value="{{ $sts->height1}}">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-sm form-control" id="height2" name="height2" value="{{ $sts->height2}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Width</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-sm form-control" id="width1" name="width1" value="{{ $sts->width1}}">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control-sm form-control" id="width2" name="width2" value="{{ $sts->width2}}">
                                </div>
                            </div>
                        </div>
                        
                        <br>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-stripped" id="tbl_grade">
                                <thead>
                                    <th> Allowence </th>
                                    <th> Length(S/M3) </th>
                                    <th> Length(P/M3) </th>
                                    <th> Qty (Btg)</th>
                                </thead>
                                <tbody id="bodygrade">
                                    <tr>
                                        <td> <input type="text" id="allowence" name="allowence" class="form-control-sm form-control" value="{{$sts->allowence}}"> </td>
                                        <td> <input type="text" id="lengthsm3" name="lengthsm3" class="form-control-sm form-control" value="{{$sts->lengthsm3}}"></td>
                                        <td> <input type="text" id="lengthpm3" name="lengthpm3" class="form-control-sm form-control" value="{{$sts->lengthpm3}}"></td>
                                        <td> <input type="text" id="qty" name="qty" class="form-control-sm form-control" value="{{$sts->qty}}"> </td>
                                    </tr>
                                </tbody>
                                <tfoot id="footgrade">
                                    <tr>
                                        <td colspan=4 align="center"> <input type="submit" name="save" id="save" class="btn btn-primary btn-xs" value="Save" /></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            
                    
                </div>
            </form>
        </div>
    </div>
</div>
<br>

<div class="col-sm-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5> List Sawn Timber Registering </h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                    <thead>
                        <tr>
                            <th data-toggle="true"> Code </th>
                            <th data-hide="all"> Apply Date</th>
                            <th data-hide="all"> Min - Max</th>
                            <th data-hide="all"> Status</th>
                            <th> Pallet </th>
                            <th> Height 1 </th>
                            <th> Height 2 </th>
                            <th> Width 1 </th>
                            <th> Width 2</th>
                            <th> Allowence</th>
                            <th> Length (S/M3)</th>
                            <th> Length (P/M3)</th>
                            <th> Qty</th>
                            <th align=center> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($streg_det as $stdet)
                            <tr>
                                <td> {{ $stdet->code }}</td>
                                <td> {{ implode(',', $stdet->st_reg()->get()->pluck('applydate')->toArray()) }} </td>
                                <td> {{ implode(',', $stdet->st_reg()->get()->pluck('min')->toArray()) }} - {{ implode(',', $stdet->st_reg()->get()->pluck('max')->toArray()) }} </td>
                                <td> {{ implode(',', $stdet->st_reg()->get()->pluck('status')->toArray()) }} </td>
                                <td> {{ $stdet->pallet }} </td>
                                <td> {{ $stdet->height1 }} </td>
                                <td> {{ $stdet->height2 }} </td>
                                <td> {{ $stdet->width1 }} </td>
                                <td> {{ $stdet->width2 }} </td>
                                <td> {{ $stdet->allowence }} </td>
                                <td> {{ $stdet->lengthsm3 }} </td>
                                <td> {{ $stdet->lengthpm3 }} </td>
                                <td> {{ $stdet->qty }} </td>
                                <td align=center>
                                    <!-- <a class="demo1" data-id="{{$stdet->id}}" title="Edit"> <i class="fa fa-edit text-red"> </i></a> -->

                                    <a href="{{ route('ST.edit', $stdet->id) }}" class='float-center' title="Edit">
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
</div>


<!-- //MODAL SELECT TANDA TERIMA -->
<div class="modal inmodal fade" id="myModal1" role="dialog" aria-hidden="true">
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
                                <th> PRM</th>
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
                                <td> {{ $t->noprocurement}}</td>
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


<script>
   

    //select TT
    function selecttt($tt_id)
    {
        if($tt_id)
        {
            console.log('id tt = '+$tt_id);
            
            $.ajax({
                url: '/ST/select_tt/'+$tt_id,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    
                    $('#tt_id').val(data[0]);
                    $('#tt').val(data[1]);
                    $('#procurement').val(data[2]);
                    $('#code_vendor').val(data[3]);
                    $('#tpkid').val(data[4]);
                    $('#tt_no').val(data[5]);
                    $('#parcel').val(data[6]);
                    $('#species').val(data[7]);
                    $('#no_document').val(data[8]);
                    $('#doc_qty').val(data[9]);
                    $('#doc_m3').val(data[10]);
                    $('#certificate').val(data[11]);
                    
                    $('#myModal1').modal('hide');
                }
            })
        }
    }

    
</script>
@endsection