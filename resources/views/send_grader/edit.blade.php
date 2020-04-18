@extends('menu.mainmenu')
@section('title','Grader IPL')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','IPL')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ url('/sendgrader') }}">List Approved IPL</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Edit Grader')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')
<div id="showinputgrader" class="col-lg-12">
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Dinas Grader </h5>
                        <div class="ibox-content">

                        <form action="{{ route('sendgrader.update', ['sendgraders' => $sendgraders->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <input type="text" readonly id="field_noipl" name="noipl" class="form-control" value="{{$sendgraders->noipl }}">
                            <br>

                            <div class="row">

                                <div class="col-sm-6 b-r">
                                    <!-- <form role="form"> -->
                                        
                                        <div class="form-group"><label>Grader</label>
                                            <select data-placeholder="Choose Grader" class="chosen-select form-control form-control-lg @error('grader_id') is-invalid @enderror" name="grader_id" >
                                                <option value=""> Choose Grader </option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $user->id == $sendgraders->grader_id ?'selected':'' }}> {{$user->username}} </option>

                                                @endforeach
                                            </select>
                                            @error('grader_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group"><label>Need for</label> 
                                            <select name="keperluan" class="form-control form-control-lg @error('keperluan') is-invalid @enderror">
                                                <option value="Survey" {{ $sendgraders->keperluan === 'Survey' ? 'selected':'' }}> Survey </option>
                                                <option value="Inspeksi" {{ $sendgraders->keperluan === 'Inspeksi' ? 'selected':'' }}> Inspeksi </option>
                                                <option value="Dokumen" {{ $sendgraders->keperluan === 'Dokumen' ? 'selected':'' }}> Dokumen </option>
                                            </select>
                                            @error('keperluan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group"><label>Location</label> 
                                            <select name="location_id" id="location_id" class="chosen-select form-control form-control-lg @error('location_id') is-invalid @enderror" onchange="get_locationid()">
                                                <option value=""> Choose Location </option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id }},{{ $vendor->province_id }}" {{ $vendor->id == $sendgraders->location_id ?'selected':'' }}> {{$vendor->name_vendor}} </option>
                                            
                                                @endforeach
                                            </select>
                                            @error('location_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group"><label>KBM</label> 
                                            <select name="kbm_id" class="chosen-select form-control form-control-lg @error('KBM') is-invalid @enderror">
                                                <!-- <option value=""> Choose KBM </option> -->
                                                @foreach($kbm as $kbm)
                                                    <option value="{{ $kbm->id}}" {{ $kbm->id == $sendgraders->kbm_id ? 'selected':'' }}"> {{ $kbm->name_kbm }} </option>
                                                @endforeach
                                            </select>
                                            @error('KBM')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group"><label>KPH</label> 
                                            <select name="kph_id" class="chosen-select form-control form-control-lg @error('KPH') is-invalid @enderror">
                                                @foreach($kph as $kph)
                                                    <option value="{{ $kph->id}}" {{ $kph->id == $sendgraders->kph_id ? 'selected':'' }}"> {{ $kph->name_kph }} </option>
                                                @endforeach
                                                
                                            </select>
                                            @error('KPH')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group"><label>TPK</label> 
                                            <select name="tpk_id" class="chosen-select form-control form-control-lg @error('TPK') is-invalid @enderror">
                                                <!-- <option value=""> Choose TPK </option> -->
                                                @foreach($tpk as $tpk)
                                                    <option value="{{ $tpk->id}}" {{ $tpk->id == $sendgraders->tpk_id ? 'selected':'' }}"> {{ $tpk->name_tpk }} </option>
                                                @endforeach
                                            </select>
                                            @error('TPK')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    <!-- </form> -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- <form role="form"> -->
                                        <div class="form-group"><label>Uang Dinas</label>
                                            <input type="text" name="uang_dinas" placeholder="Rp." class="form-control @error('uang_dinas') is-invalid @enderror" value="{{$sendgraders->uang_dinas }}">
                                            @error('uang_dinas')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group" id="data_5">
                                            <label class="font-normal">Durasi </label>
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"  value="{{$sendgraders->start_date }}"/>
                                                @error('start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <span class="input-group-addon">to</span>
                                                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"  value="{{$sendgraders->end_date }}" />
                                                @error('end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group"><label>Rekening</label>
                                        <div class="input-daterange input-group" >
                                            <!-- <input type="text" name="bank" placeholder="Bank" style="text-transform:uppercase" class="form-control @error('bank') is-invalid @enderror" value="{{$sendgraders->bank }}" > -->
                                            <select id="bank" name="bank" class="form-control @error('bank') is-invalid @enderror">
                                                @foreach($bank as $bank)
                                                    <option value="{{ $bank->namebank}}" {{ $bank->namebank == $sendgraders->bank ? 'selected':'' }}> {{$bank->namebank}}</option>
                                                @endforeach
                                            </select>
                                            @error('bank')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span class="input-group-addon">-</span>
                                            <input type="text" name="rekening" placeholder="Rekening" class="form-control @error('rekening') is-invalid @enderror" value="{{$sendgraders->rekening }}">
                                            @error('rekening')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        </div>

                                    <!-- </form> -->
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-primary btn-sm"> Save </button>
                                    <button class="btn btn-white btn-sm" type="reset">Cancel</button>
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
    function get_locationid()
    {
        var s = document.getElementById('location_id').value;
        var id = s.split(",")[0]; 
        var provinceid = s.split(",")[1]; 

        if(provinceid)
        {
            console.log('provinceid = '+provinceid);
            $.ajax({
                url: '/sendgrader/getKBM/'+provinceid,
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
            })
        }
    }
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
@endsection