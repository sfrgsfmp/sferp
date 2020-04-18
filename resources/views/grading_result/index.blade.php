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


            <!-- </div> -->
        </div>
    </div>
<!-- </div> -->
<!-- </div> -->
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
                            <input type="text" class="form-control" name="sendgrader_id"  readonly>
                        </div>
                       
                </div>            
                                      
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




<script>

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
            $('#btg').val(data[5]);
            $('#m3').val(data[6]);
            $('#harga/m3').val(data[7]);

            $('#editForm').attr('action', '/gradingresult/update/'+data[0]);
            $('#editmodal-form').modal('show');
        })
    });





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

// function show()
// {
//     document.getElementById('showcalendar').style.display = 'block';

// }
</script>


@endsection