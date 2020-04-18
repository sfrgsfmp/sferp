@extends('menu.mainmenu')

@section('title','Grading Result')

@section('section_title')
  <div class="col-lg-10">
      <h2>@yield('content_title','Grading Result')</h2>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="{{ route('home') }}">Home</a>
          </li>
          <li class="breadcrumb-item active">
              <strong>@yield('content_title_active','Grading Result')</strong>
          </li>
      </ol>
  </div>
  
@endsection


@section('content')
<div class="col-lg-12">
<!-- <div class="row"> -->
<!-- <div class="col-lg-12"> -->
    <div class="ibox">
        <div class="ibox-title">
            <h5> Grading Result </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
            </div>
        </div>
        <div class="ibox-content">
            <!-- <div class="scroll_content"> -->
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label> Choose </label>
                        </div>
                        <div class="col-lg-8">
                        <select id="sendgrader" name="sendgrader" class="form-control @error('sendgrader') is-invalid @enderror">
                            <option value=""> Choose </option>
                            @foreach($sgs as $sg)
                                <option value="{{ $sg->id }}"> {{ $sg->noipl }} - {{ $sg->keperluan }} - {{ implode(',', $sg->vendors()->get()->pluck('name_vendor')->toArray()) }}</option>
                            @endforeach
                        </select>
                        @error('sendgrader')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <br>

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5> Get Data </h5>
                            <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="tabs-container">
                        
                                <ul class="nav nav-tabs" role="tablist">
                                    <li><a class="nav-link active" data-toggle="tab" href="#tab-1">Grader</a></li>
                                    <li><a class="nav-link" data-toggle="tab" href="#tab-2">IPL</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" id="tab-1" class="tab-pane active">
                                        <div class="panel-body">
                                            <!-- <strong>Donec quam felis</strong> -->
                                            <div id="get_data" class="row" >
                                
                                                <div class="col-sm-6 b-r">
                                                    <h3 class="m-t-none m-b"></h3>
                                                    
                                                    @foreach($graders as $grader)
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> No IPL </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ $grader['noipl'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Grader</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ implode(',', $grader->users()->get()->pluck('username')->toArray()) }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Keperluan </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ $grader['keperluan'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Location </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                        
                                                            <input type="text" class="form-control" value="{{ implode(',', $grader->vendors()->get()->pluck('name_vendor')->toArray()) }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> KBM </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <select name="kbm_id" class="form-control form-control-lg @error('KBM') is-invalid @enderror" readonly>
                                                                
                                                                @foreach($kbm as $kbm)
                                                                    <option value="{{ $kbm->id}}" {{ $kbm->id == $grader->kbm_id ? 'selected':'' }}"> {{ $kbm->name_kbm }} </option>
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
                                                        <div class="col-lg-2">
                                                            <label> KPH </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <select name="kph_id" class="form-control form-control-lg @error('KPH') is-invalid @enderror" readonly>
                                                                @foreach($kph as $kph)
                                                                    <option value="{{ $kph->id}}" {{ $kph->id == $grader->kph_id ? 'selected':'' }}"> {{ $kph->name_kph }} </option>
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
                                                        <div class="col-lg-2">
                                                            <label> TPK </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <select name="tpk_id" class="chosen-select form-control form-control-lg @error('TPK') is-invalid @enderror" readonly>
                                                                
                                                                @foreach($tpk as $tpk)
                                                                    <option value="{{ $tpk->id}}" {{ $tpk->id == $grader->tpk_id ? 'selected':'' }}"> {{ $tpk->name_tpk }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('TPK')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <h3 class="m-t-none m-b"></h3>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Uang Dinas </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ $grader['uang_dinas'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label class="font-normal">Durasi </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="input-daterange input-group" id="datepicker">
                                                                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"  value="{{ $grader['start_date'] }}" readonly/>
                                                                <span class="input-group-addon">to</span>
                                                                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"  value="{{ $grader['end_date'] }}" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Bank </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="input-daterange input-group" id="datepicker">
                                                                <input type="text" name="bank" placeholder="Bank" style="text-transform:uppercase" class="form-control @error('bank') is-invalid @enderror" value="{{ $grader['bank'] }}" readonly>
                                                                
                                                                <span class="input-group-addon">-</span>
                                                                <input type="text" name="rekening" placeholder="Rekening" class="form-control @error('rekening') is-invalid @enderror" value="{{ $grader['rekening'] }}" readonly>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Surat Perintah </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ $grader['surat_perintah'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" id="tab-2" class="tab-pane">
                                        <div class="panel-body">
                                            <!-- <strong>Donec quam felis</strong> -->

                                            <div id="get_data_ipl" class="row" >
                        
                                                <div class="col-sm-6 b-r">
                                                @foreach($ipl as $ipl)
                                                <h5 class="m-t-none m-b"> Transaction Date {{ $ipl['transaction_date'] }} </h5>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> No IPL </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ $ipl['noipl'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Vendor </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ implode(',', $ipl->vendor()->get()->pluck('name_vendor')->toArray()) }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Species</label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ implode(',', $ipl->species()->get()->pluck('name')->toArray()) }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Sortimen </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ $ipl['sortimen'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Diameter </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="input-daterange input-group" id="datepicker">
                                                                <input type="text" name="diameter_from" class="form-control @error('diameter_from') is-invalid @enderror"  value="{{ $ipl['diameter_from'] }}" readonly/>
                                                                <span class="input-group-addon">to</span>
                                                                <input type="text" name="diameter_to" class="form-control @error('diameter_to') is-invalid @enderror"  value="{{ $ipl['diameter_to'] }}" readonly/>
                                                                {{ $ipl['uom_diameter'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Length </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="input-daterange input-group" id="datepicker">
                                                                <input type="text" name="length_from" class="form-control @error('length_from') is-invalid @enderror"  value="{{ $ipl['length_from'] }}" readonly/>
                                                                <span class="input-group-addon">to</span>
                                                                <input type="text" name="length_to" class="form-control @error('length_to') is-invalid @enderror"  value="{{ $ipl['length_to'] }}" readonly/>
                                                                {{ $ipl['uom_length'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Width </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="input-daterange input-group" id="datepicker">
                                                                <input type="text" name="width_from" class="form-control @error('width_from') is-invalid @enderror"  value="{{ $ipl['width_from'] }}" readonly/>
                                                                <span class="input-group-addon">to</span>
                                                                <input type="text" name="width_to" class="form-control @error('width_to') is-invalid @enderror"  value="{{ $ipl['width_to'] }}" readonly/>
                                                                {{ $ipl['uom_width'] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Thick </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="input-daterange input-group" id="datepicker">
                                                                <input type="text" name="thick_from" class="form-control @error('thick_from') is-invalid @enderror"  value="{{ $ipl['thick_from'] }}" readonly/>
                                                                <span class="input-group-addon">to</span>
                                                                <input type="text" name="thick_to" class="form-control @error('thick_to') is-invalid @enderror"  value="{{ $ipl['thick_to'] }}" readonly/>
                                                                {{ $ipl['uom_thick'] }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-sm-6">
                                                    <h3 class="m-t-none m-b"></h3>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Status </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" value="{{ $ipl['status'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label class="font-normal">Quality </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="{{ $ipl['quality'] }}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> KWT </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="{{ $ipl['kwt'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Wood Drying </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="{{ $ipl['wood_drying'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Schema </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="{{ $ipl['schema'] }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                    
                                                        <div class="col-lg-2">
                                                            <label> Volume </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="input-daterange input-group" id="datepicker">
                                                                <input type="text" class="form-control" value="{{ $ipl['volume'] }}" readonly>
                                                                <!-- <span class="input-group-addon">{{ $ipl['uom_volume']}}</span> -->
                                                                <input type="text" class="form-control" value="{{ $ipl['uom_volume']}}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Approval to </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                        
                                                            <input type="text" class="form-control" value="{{ implode(',', $ipl->users()->get()->pluck('username')->toArray()) }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-2">
                                                            <label> Status </label>
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <!-- //1=Created, 2=WaitingApproval 3=Approved, 4=Rejected, 5=Revisi -->
                                                            <?php
                                                            $var="";
                                                            if($ipl['status_approval'] == '1')
                                                            {
                                                                $var .= 'Created';
                                                            }
                                                            elseif ($ipl['status_approval'] == '2')
                                                            {
                                                                $var .= 'Waiting Approval';
                                                            }
                                                            elseif ($ipl['status_approval'] == '3')
                                                            {
                                                                $var .='Approved';
                                                            }
                                                            elseif ($ipl['status_approval'] == '4')
                                                            {
                                                                $var .='Rejected';
                                                            }
                                                            else
                                                            {
                                                                $var .='Revise';
                                                            }
                                                            //    echo $var;
                                                            ?>
                                                            <input type="text" class="form-control" value="{{ $var }}" readonly>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


            <!-- </div> -->
        </div>
    </div>

</div>

<!-- //INPUT -->
<div class="col-lg-12" id="forms">
    <div class="ibox">
        <div class="ibox-title">
            <h5> Forms Grading Result </h5>
            <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            </div>
        </div>
        <div class="ibox-content">
            <!-- check user yg login apakah = dengan grader di table send_grader, where surat_perintah not null -->
            <form method="POST" id="act" action="{{ route('gradingresult.store') }}" >
            @csrf
            
                <div class="form-group row" style="display:none">
                    <label class="col-sm-2 ">ID Send Grader</label>
                
                        <div class="col-sm-8" >
                            <input type="text" class="form-control" name="sendgrader_id" value="{{ $grader['id'] }}" readonly>
                        </div>
                       
                </div>            
                @endforeach                            
                <div class="form-group row">
                    <label class="col-sm-2 ">Date</label>
                
                        <div class="col-sm-8 input-group date" >
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type='text' class='form-control datepicker-here' name="date" id="date" data-language='en' />
                        </div>
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 ">Tipe Biaya</label>
                
                        <div class="col-sm-8" >
                            <select name="tipebiaya" id="tipebiaya" class="form-control @error('tipebiaya') is-invalid @enderror">
                                <option value="AKOMODASI">AKOMODASI</option>
                                <option value="TRANSPORT">TRANSPORT</option>
                                <option value="OPERASIONAL">OPERASIONAL</option>
                            </select>
                        </div>
                        @error('tipebiaya')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 ">Keterangan</label>
                
                        <div class="col-sm-8" >
                            <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror">
                            </textarea>
                        </div>
                        @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 ">Jumlah Biaya</label>
                
                    <div class="col-sm-8" >
                        <input type="text" class="form-control @error('biaya') is-invalid @enderror" id="biaya" name="biaya" placeholder="Rp." onkeypress="return isNumber(event)">
                    </div>
                    @error('biaya')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 ">Kendaraan</label>
                
                    <div class="col-sm-8" >
                        <input type="text" class="form-control @error('kendaraan') is-invalid @enderror" id="kendaraan" name="nokendaraan">
                    </div>
                    @error('kendaraan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 ">Btg</label>
                
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('btg') is-invalid @enderror" name="btg" id="btg" onkeypress="return isNumber(event)">
                    </div>
                    @error('btg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 ">M3</label>
                
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('m3') is-invalid @enderror" name="m3" id="m3" onkeypress="return isNumber(event)">
                    </div>
                    @error('m3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 ">Harga/m3</label>
                
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('harga/m3') is-invalid @enderror" name="harga/m3" id="hargam3" onkeypress="return isNumber(event)">
                    </div>
                    @error('harga/m3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row" style="display:none">
                    <label class="col-sm-2 ">Created By</label>
                
                    <div class="col-sm-8" >
                        <input type="text" class="form-control @error('uang_dinas') is-invalid @enderror" name="created_by" id="created_by" value="{{ Auth::user()->id }}" readonly>
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

<!-- //SHOW -->
<div class="col-lg-12" id="form_result">

    <div class="ibox">
        <div class="ibox-title">
            <h5> List Grading Result </h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="footable table-bordered dataTables-example">
                    
                    <thead>
                        <tr>
                            <th> No</th>
                            <th>Date</th>
                            <th>Tipe Biaya</th>
                            <th>Keterangan</th>
                            <th>Rupiah</th>
                            <th>Kendaraan</th>
                            <th>Btg</th>
                            <th>M3</th>
                            <th>Harga/M3</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($resu as $res)
                            <tr class="data-row">
                                <td> {{$no++}}</td>
                                <td class="align-middle id" style="display:none"> {{$res['id'] }}</td>
                                <td class="align-middle date"> {{$res['date']}}</td>
                                <td class="align-middle tipebiaya"> {{$res['tipebiaya']}}</td>
                                <td class="align-middle keterangan"> {{$res['keterangan']}}</td>
                                <td class="align-middle biaya"> {{$res['biaya']}}</td>
                                <td class="align-middle kendaraan"> {{$res['nokendaraan']}} </td>
                                <td class="align-middle btg"> {{$res['btg']}}</td>
                                <td class="align-middle m3"> {{$res['m3']}}</td>
                                <td class="align-middle hargam3"> {{$res['harga/m3']}}</td>
                                <td>
                                    @if($res['status'] == 1)
                                        Waiting
                                    @elseif($res['status'] == 2)
                                       Approved
                                    @elseif($res['status'] == 3)
                                       Rejected
                                    @elseif($res['status'] == 4)
                                       Revisi
                                    @else
                                        Created
                                    @endif

                                </td>
                                <td align=center>
                                    
                    
                                    @if($res['status'] == 5 || $res['status'] == 4)
                                        <a class="float-left">
                                            <button type="button" title="Edit" class="btn btn-outline btn-success btn-sm " id="edit-item" data-item-id=<?php echo $res['id']; ?>><i class="fa fa-edit float-center"> </i></button>
                                        </a>
                                        
                                        <a class="demo4" data-id="{{$res->id}}" title="Done"> <button type="button" class="btn btn-outline btn-info btn-sm"> <i class="fa fa-check text-red"> </i> </button> </a>
                                    @endif                      
                                    @if($res['status'] == 3)
                                        <form action="{{ route('gradingresult.destroy', $res->id) }}" method="post">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle float-center" title="Delete"> </i> </button>
                                        </form>
                                    @endif 
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                {{ $resu->links() }}
                
               
            </div>    
        </div>
    </div>

</div>

<!-- SHOW EDIT MODAL -->
<div id="edit-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Edit</h3>
                    
                    <form id="editForm" method="POST" action="/gradingresult/update" >
                    @csrf
                    @method('PUT')
                            <div class="form-group row" style="display:none">
                                <label class="col-sm-2 ">ID Send Grader</label>
                        
                                <div class="col-sm-8" >
                                    <input type="text" class="form-control" id="sendgrader_id" name="sendgrader_id" value="" readonly>
                                </div>
                            
                            </div>            
                                                      
                            <div class="form-group row">
                                <label class="col-sm-2 ">Date</label>
                            
                                    <div class="col-sm-8 input-group date" >
                                        <!-- <span class="input-group-addon"><i class="fa fa-calendar" id="showcal"></i></span> -->
                                        <span class="input-group-addon"><i class="fa fa-calendar" id="show"></i></span>
                                        <span class="input-group-addon"><i class="fa fa-calendar" id="showhide" onclick=""></i></span>

                                            <div id="showcalendar" style="display:none">
                                                
                                                
                                            </div>
                                        
                                            <div id="f_showhide" class="datepickers" data-language='en' style="display:none">
                                            
                                            </div>
                                            <br>


                                            <input type='text' class='form-control datepickers' placeholder="editdate" name="editdate" id="editdate" data-language='en'>
                                            
                                        
                                        
                                    </div>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 ">Tipe Biaya</label>
                            
                                    <div class="col-sm-8" >
                                        <select name="edittipebiaya" id="edittipebiaya" class="form-control @error('edittipebiaya') is-invalid @enderror">
                                            <option value="AKOMODASI">AKOMODASI</option>
                                            <option value="TRANSPORT">TRANSPORT</option>
                                            <option value="OPERASIONAL">OPERASIONAL</option>
                                        </select>
                                    </div>
                                    @error('edittipebiaya')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 ">Keterangan</label>
                            
                                    <div class="col-sm-8" >
                                        <textarea name="editketerangan" id="editketerangan" class="form-control @error('editketerangan') is-invalid @enderror">
                                        </textarea>
                                    </div>
                                    @error('editketerangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 ">Jumlah Biaya</label>
                            
                                <div class="col-sm-8" >
                                    <input type="text" class="form-control @error('editbiaya') is-invalid @enderror" name="editbiaya" id="editbiaya" placeholder="Rp." onkeypress="return isNumber(event)">
                                </div>
                                @error('editbiaya')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 ">Btg</label>
                            
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('editbtg') is-invalid @enderror" name="editbtg" id="editbtg" onkeypress="return isNumber(event)">
                                </div>
                                @error('editbtg')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 ">M3</label>
                            
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('editm3') is-invalid @enderror" name="editm3" id="editm3" onkeypress="return isNumber(event)">
                                </div>
                                @error('editm3')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 ">Harga/m3</label>
                            
                                <div class="col-sm-8">
                                    <input type="text" class="form-control @error('edithargam3') is-invalid @enderror" name="edithargam3" id="edithargam3" onkeypress="return isNumber(event)">
                                </div>
                                @error('edithargam3')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group row" style="display:none">
                                <label class="col-sm-2 ">Created By</label>
                            
                                <div class="col-sm-8" >
                                    <input type="text" class="form-control @error('uang_dinas') is-invalid @enderror" name="created_by" value="{{ Auth::user()->id }}" readonly>
                                </div>
                                

                            </div> 
                            
                            <div class="form-group row">
                                <div class="col-lg-12 text-center">
                                    
                                    <button class="btn btn-primary btn-sm" type="submit">Save</button>
                                    <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function () {

        $('.demo4').click(function (e)
        {
            e.preventDefault();
            var id = $(this).data('id');
            swal(
            {
                title: "Are you sure want to send this result for approval?",
                text: "You can't edit after send for approval!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, done it!",
                cancelButtonText: "No, cancel!",
                },
                    function (isConfirm)
                    {
                        if (isConfirm)
                        {
                            $.ajax({
                                
                                type : "GET",
                                url : "{{ url('gradingresult/send')}}" + '/' + id,
                                data: {id:id},
                                success: function (data)
                                {
                                    swal("Done!", "Your data has been send.", "success");
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

    $(function(){
        $('#sendgrader').on('change', function () {
            var id = $(this).val(); // get selected value
            if (id)
            { 
                window.location = "/gradingresult/getdata/"+id;  
                // id = $("#sendgrader_id").val();
                // $("#sendgrader_id").val();
                // $("#sendgrader_id").val("Dolly Duck");
                // console.log(id);
                // alert(id);
            }
            return false;
        });
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        {
            return false;
        }
        return true;
    }

    $(document).ready(function(){
        var table = $('#datatable').DataTable();

        table.on('click', '.edit', function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#date').val(data[1]);
            $('#tipebiaya').val(data[2]);
            $('#keterangan').val(data[3]);
            $('#biaya').val(data[4]);
            $('#kendaraan').val(data[5]);
            $('#btg').val(data[6]);
            $('#m3').val(data[7]);
            $('#harga/m3').val(data[8]);

            $('#editForm').attr('action', '/gradingresult/update/'+data[0]);
            $('#editmodal-form').modal('show');
        })
    });




// -------------------------------------------

$(document).ready(function()
{
  
    $(document).on('click', "#edit-item", function() {
        $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        // location.reload();
        $("#form-result").effect("shake");
    
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
        var row = el.closest(".data-row");

        // get the data
        var id = el.data('item-id');
        var date = row.children(".date").text();
        var tipebiaya = row.children(".tipebiaya").text();
        var keterangan = row.children(".keterangan").text();
        var biaya = row.children(".biaya").text();
        var kendaraan = row.children(".kendaraan").text();
        var btg = row.children(".btg").text();
        var m3 = row.children(".m3").text();
        var hargam3 = row.children(".hargam3").text();

       
        // fill the data in the input fields
        $("#editdate").val(date).text(date);
        document.getElementById('date').value = date;
        
        $("#edittipebiaya option:selected").val(tipebiaya).text(tipebiaya);
        $("#tipebiaya option:selected").val(tipebiaya).text(tipebiaya);
        

        $("#editketerangan").val(keterangan);
        document.getElementById('keterangan').value = keterangan;
        $("#editbiaya").val(biaya);
        document.getElementById('biaya').value = biaya;
        document.getElementById('kendaraan').value = kendaraan;
        $("#editbtg").val(btg);
        document.getElementById('btg').value = btg;
        $("#editm3").val(m3);
        document.getElementById('m3').value = m3;
        $("#edithargam3").val(hargam3);
        document.getElementById('hargam3').value = hargam3;

        $("#act").attr('action', '/gradingresult/update/'+id);
   
    })
});

// show modal edit
// ---------------------------------------------------
// $(document).ready(function()
// {
  
//     $(document).on('click', "#edit-item", function() {
//         $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

//         var options = {
//         'backdrop': 'static'
//         };
//         $('#edit-modal').modal(options)
//     })

//     // on modal show
//     $('#edit-modal').on('show.bs.modal', function() {
//         var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
//         var row = el.closest(".data-row");

//         // get the data
//         var id = el.data('item-id');
//         var date = row.children(".date").text();
//         var tipebiaya = row.children(".tipebiaya").text();
//         var keterangan = row.children(".keterangan").text();
//         var biaya = row.children(".biaya").text();
//         var btg = row.children(".btg").text();
//         var m3 = row.children(".m3").text();
//         var hargam3 = row.children(".hargam3").text();

        
       
//         // console.log(id);
//         // fill the data in the input fields
//         $("#editdate").val(date).text(date);
//         // document.getElementById('date').value = date;
        
//         $("#edittipebiaya option:selected").val(tipebiaya).text(tipebiaya);
//         // $("#tipebiaya option:selected").val(tipebiaya).text(tipebiaya);
//         // document.getElementById('tipebiaya').value = tipebiaya;
//         // document.getElementById('tipebiaya').text = tipebiaya;
//         // var b = document.getElementById('tipebiaya');
//         // b.options[b.selectedIndex].value = tipebiaya;

//         $("#editketerangan").val(keterangan);
//         // document.getElementById('keterangan').value = keterangan;
//         $("#editbiaya").val(biaya);
//         // document.getElementById('biaya').value = biaya;
//         $("#editbtg").val(btg);
//         // document.getElementById('btg').value = btg;
//         $("#editm3").val(m3);
//         // document.getElementById('m3').value = m3;
//         $("#edithargam3").val(hargam3);
//         // document.getElementById('hargam3').value = hargam3;

//         $("#editForm").attr('action', '/gradingresult/update/'+id, 'type', 'PUT');
//     })

//     // on modal hide
//     $('#edit-modal').on('hide.bs.modal', function() {
//         $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
//         $("#editForm").trigger("reset");
//     })
// });
// -------------------------------------------------

$(document).on('click', "#editdate", function() {
    
        get = $("#editdate").val();
        console.log(get);   
        $('#editdate').datepicker({
            language: 'en',
        });

        
});

$(document).on('click', "#showcal", function() {
    console.log('hehe');
    $('#editdate').datepicker({
        language: 'en',
    });
});



$(document).on('click', "#show", function(){
    $("#showcalendar").show();
    $('#showcalendar').datepicker({
        language: 'en',
    });

});

$(document).ready(function(){
  $("#showhide").click(function(){
    $("#f_showhide").toggle();
  });
});



$(document).ready(function(){

    var mem = $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        language: 'en'
    });
    console.log(mem);

    var yearsAgo = new Date();
    yearsAgo.setFullYear(yearsAgo.getFullYear() - 20);

    $('#selector').datepicker('setDate', yearsAgo );

    $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd/mm/yyyy"
            });
});



$(document).ready(function() {

    // $('.footable').footable();

    $('#editdate').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $('#date_added').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        dateFormat: "dd-mm-yy",
        altFormat: 'yy-mm-dd'
    });

    
    
    $('#date_modified').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

});

$(document).ready(function() {

    $('.footable').footable();
    $('.footable2').footable();

});
// function show()
// {
//     document.getElementById('showcalendar').style.display = 'block';

// }
</script>


@endsection