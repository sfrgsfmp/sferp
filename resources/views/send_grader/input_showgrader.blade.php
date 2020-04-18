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
            <strong>@yield('content_title_active','Grader - IPL')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')
<!-- back to list ipl has been Approved -->
<div class="col-md-1">
    <a href="{{ url('/sendgrader') }}" class='btn btn-info float-center' title='IPL Approved'>
        <i class='fa fa-reply text-center'> </i>
        Back
    </a>
</div>
<div class="col-lg-11">
    <div class="alert alert-info alert-dismissable">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button"> × </button>
        <button class="btn btn-info btn-xs"> <i class='fa fa-reply text-center'> </i> <span class="bold"> Back</span> </button>
        Click to view list IPL Approved
    </div>
</div>


<!-- SHOW -->
<div class="col-lg-12">
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Approved IPL </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="row">

                        <div class="col-sm-6 b-r">
                            <table>
                                <tr>
                                    <td> NoIPL</td> <td> : {{$ipls['noipl']}} </td>
                                </tr>
                                <tr>
                                    <td> Vendor</td> <td> : {{ implode(',', $ipls->vendor()->get()->pluck('name_vendor')->toArray()) }} </td>
                                </tr>
                                <tr>
                                    <td> Species</td> <td> : {{ implode(',', $ipls->species()->get()->pluck('name')->toArray()) }} </td>
                                </tr>
                                <tr>
                                    <td> Sortimen</td> <td> : {{$ipls['sortimen']}} </td>
                                </tr>
                                <tr>
                                    <td> Diameter</td> <td> : {{$ipls['diameter_from']}} - {{$ipls['diameter_to']}} {{$ipls['uom_diameter']}} </td>
                                </tr>
                                <tr>
                                    <td> Length</td> <td> : {{$ipls['length_from']}} - {{$ipls['length_to']}} {{$ipls['uom_length']}} </td>
                                </tr>
                                <tr>
                                    <td> Width</td> <td> : {{$ipls['width_from']}} - {{$ipls['width_to']}} {{$ipls['uom_width']}} </td>
                                </tr>
                            </table>
                            
                        </div>
                        <div class="col-sm-6">
                            <table>
                                <tr>
                                    <td> Thick </td> <td> : {{$ipls['thick_from']}} - {{$ipls['thick_to']}} {{$ipls['uom_thick']}} </td>
                                </tr>
                                <tr>
                                    <td> Status </td> <td> : {{$ipls['status']}} </td>
                                </tr>
                                <tr>
                                    <td> Quality </td> <td> : {{$ipls['quality']}} </td>
                                </tr>
                                <tr>
                                    <td> KWT </td> <td> : {{$ipls['kwt']}} </td>
                                </tr>
                                <tr>
                                    <td> Wood Drying </td> <td> : {{$ipls['wood_drying']}} </td>
                                </tr>
                                <tr>
                                    <td> Schema </td> <td> : {{$ipls['schema']}} </td>
                                </tr>
                                <tr>
                                    <td> Volume </td> <td> : {{$ipls['volume']}} {{$ipls['uom_volume']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Dinas Grader </h5>
                    <div class="ibox-content">

                    <form action="{{ route('sendgrader.store') }}" method="POST">
                    @csrf
                        <input type="text" readonly id="field_noipl" name="noipl" class="form-control" value="{{ $ipls['noipl'] }}">
                        <br>
                        <div class="row">
                            <div class="col-sm-6 b-r">
                                    <div class="form-group"><label>Grader</label>
                                        <select data-placeholder="Choose Grader" class="chosen-select form-control form-control-lg @error('grader_id') is-invalid @enderror" name="grader_id" >
                                                <option value=""> Choose Grader </option>
                                            @foreach($graders as $user)
                                                
                                                <option value="{{ $user->user_id }}"> {{ implode(',', $user->users()->get()->pluck('username')->toArray()) }}</option>
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
                                            <option value="Survey"> Survey </option>
                                            <option value="Inspeksi"> Inspeksi </option>
                                            <option value="Dokumen"> Dokumen </option>
                                        </select>
                                        @error('keperluan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group"><label>Location</label> 
                                        <select name="location_id" id="location_id" class="chosen-select form-control form-control-lg @error('location') is-invalid @enderror" onchange="get_locationid()">
                                            <option value=""> Choose Location </option>
                                            @foreach($vendors as $vendor)
                                                <option value="{{ $vendor->id }},{{ $vendor->province_id }}"> {{$vendor->name_vendor}} </option>
                                            @endforeach
                                        </select>
                                        @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group"><label>KBM</label> 
                                        <select name="kbm_id" class="chosen-select form-control form-control-lg @error('KBM') is-invalid @enderror">
                                            <option value=""> Choose KBM </option>
                                            
                                        </select>
                                        @error('KBM')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group"><label>KPH</label> 
                                        <select name="kph_id" class="chosen-select form-control form-control-lg @error('KPH') is-invalid @enderror">
                                            <option value=""> Choose KPH </option>
                                            
                                        </select>
                                        @error('KPH')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group"><label>TPK</label> 
                                        <select name="tpk_id" class="chosen-select form-control form-control-lg @error('TPK') is-invalid @enderror">
                                            <option value=""> Choose TPK </option>
                                            
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
                                        <input type="text" name="uang_dinas" placeholder="Rp." class="form-control @error('uang_dinas') is-invalid @enderror" >
                                        @error('uang_dinas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group" id="data_5">
                                        <label class="font-normal">Durasi </label>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"  value="05/14/2014"/>
                                            @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span class="input-group-addon">to</span>
                                            <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"  value="05/22/2014" />
                                            @error('end_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group"><label>Rekening</label>
                                    <div class="input-daterange input-group" >
                                        <!-- <input type="text" name="bank" placeholder="Bank" style="text-transform:uppercase" class="form-control @error('bank') is-invalid @enderror" > -->
                                        <select id="bank" name="bank" class="form-control @error('bank') is-invalid @enderror">
                                            @foreach($bank as $bank)
                                                <option value="{{ $bank->namebank}}"> {{$bank->namebank}}</option>
                                            @endforeach
                                        </select>
                                        @error('bank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="input-group-addon">-</span>
                                        <input type="text" name="rekening" placeholder="Rekening" class="form-control @error('rekening') is-invalid @enderror" >
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
                    <div class="ibox-content">
                        <div class="col-sm-12">
                            <br><br>
                            <div class="table-responsive">
                                <table class="footable table-bordered dataTables-example">
                                
                                    <thead>
                                        <tr>
                                            <th> No </th>
                                            <th>Noipl</th>
                                            <th>Grader</th>
                                            <th>Keperluan</th>
                                            <th>Lokasi</th>
                                            <th>Durasi</th>
                                            <th>Uang Dinas</th>
                                            <th>Bank</th>
                                            <th>Rekening</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no=1; ?>
                                        @foreach($sendgraders as $sg)
                                            <tr>
                                                <td> {{$no++}}</td>
                                                <td> {{$sg['noipl']}} </td>
                                                <td> {{ implode(',', $sg->users()->get()->pluck('username')->toArray()) }} </td>
                                                <td> {{$sg['keperluan']}} </td>
                                                <td> {{ implode(',', $sg->vendors()->get()->pluck('name_vendor')->toArray()) }}
                                                    - {{ implode(',', $sg->tpk()->get()->pluck('name_tpk')->toArray()) }}
                                                </td>

                                                <td> {{$sg['start_date']}} - {{$sg['end_date']}}</td>
                                                <td> {{$sg['uang_dinas']}} </td>
                                                <td> {{$sg['bank']}} </td>
                                                <td> {{$sg['rekening']}}</td>
                                                <td>
                                                    
                                                    <a href="{{ route('sendgrader.edit', $sg->id) }}" class="float-left" title="Edit">
                                                        <button type="button" class="btn btn-primary btn-xs" ><i class="fa fa-edit"> </i> </button>
                                                    </a>
                                                    &nbsp
                                                    <form action="{{ route('sendgrader.destroy', $sg->id) }}" method="post">
                                                        {{ method_field('DELETE') }}
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"> </i> </button>
                                                    </form>

                                                    
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