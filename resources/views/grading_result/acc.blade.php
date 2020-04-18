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
              <strong>@yield('content_title_active','Verification Grading Result')</strong>
          </li>
      </ol>
  </div>
  
@endsection


@section('content')

<!-- SHOW -->
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List Grading Result</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    
                    <form action="{{ route ('gradingresult.choose') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-1">
                                Choose
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control" id="choose" name="choose" >
                                        <option value=""> Choose </option>
                                    @foreach($sendgraders as $send)
                                    
                                        <option value="{{$send->id}}"> {{$send->noipl}}. Grader - {{$send->username}}. Keperluan - {{$send->keperluan}}. Lokasi - {{$send->name_vendor}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-primary btn-sm" type="submit">PDF</button>
                            </div>
                        </div>
                    </form>

                    <!-- <table class="footable table table-bordered toggle-arrow-tiny"> -->
                    <div class="table-responsive">
                        <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                            <thead>
                                <tr>
                                    <th>Noipl</th>
                                    <th data-hide="all"> Surat Perintah </th>
                                    <th data-hide="all"> Nama Grader</th>
                                    <th data-hide="all"> Keperluan</th>
                                    <th data-hide="all"> Lokasi</th>
                                    <th data-hide="all"> Uang Dinas </th>
                                    <th data-hide="all"> Durasi </th>
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
                                @foreach($results as $result)
                                    <tr class="data-row">
                                        
                                        <!-- <td style="display:none"> {{$result['id'] }}</td> -->
                                        <td> {{ implode(',', $result->sendgrader()->get()->pluck('noipl')->toArray()) }} </td>
                                        <td> {{ implode(',', $result->sendgrader()->get()->pluck('surat_perintah')->toArray()) }} </td>
                                        
                                        <td> {{ implode(',', $result->sendgrader()->get()->pluck('grader_id')->toArray()) }} </td>
                                           
                                        <td> {{ implode(',', $result->sendgrader()->get()->pluck('keperluan')->toArray()) }} </td>
                                        
                                        <td> {{ implode(',', $result->sendgrader()->get()->pluck('location_id')->toArray()) }} </td>

                                        <td> {{ implode(',', $result->sendgrader()->get()->pluck('uang_dinas')->toArray()) }} </td>
                                        <td> {{ implode(',', $result->sendgrader()->get()->pluck('start_date')->toArray()) }} - {{ implode(',', $result->sendgrader()->get()->pluck('end_date')->toArray()) }} </td>
                                        <td > {{$result['date']}}</td>
                                        <td > {{$result['tipebiaya']}}</td>
                                        <td > {{$result['keterangan']}}</td>
                                        <td > {{$result['biaya']}}</td>
                                        <td > {{$result['nokendaraan']}} </td>
                                        <td > {{$result['btg']}}</td>
                                        <td > {{$result['m3']}}</td>
                                        <td > {{$result['harga/m3']}}</td>
                                        <td >
                                            @if($result['status'] == 1)
                                                Waiting
                                            @elseif($result['status'] == 2)
                                                Approved
                                            @elseif($result['status'] == 3)
                                                Rejected
                                            @elseif($result['status'] == 4)
                                                Revisi
                                            @else
                                                Created
                                            @endif

                                        </td>
                                        <td align=center>
                                            <a class="demo4" data-id="{{$result->id}}" title="Approve"> <i class="fa fa-check text-navy"> </i> </a>

                                            <a class="demo3" data-id="{{$result->id}}" title="Revise"> <i class="fa fa-pencil text-navy"> </i> </a>
                                            <a class="demo5" data-id="{{$result->id}}" title="Reject"> <i class="fa fa-times"> </i> </a>

                                            
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
<!-- </div> -->
<!-- </div> -->
</div>

<script>
  

    $(document).ready(function () {

        $('.demo3').click(function (e)
        {
            e.preventDefault();
            var id = $(this).data('id');
            swal(
            {
                title: "Are you sure want to revision?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, revise it!",
                cancelButtonText: "No, cancel!",
                },
                    function (isConfirm)
                    {
                        if (isConfirm)
                        {
                            $.ajax({        
                                type : "GET",
                                url : "{{ url('gradingresult/revision')}}" + '/' + id,
                                data: {id:id},

                                success: function (data)
                                {
                                    
                                    swal("Revision!", "Your data has been revise.", "success");
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

        $('.demo4').click(function (e)
        {
            e.preventDefault();
            var id = $(this).data('id');
            swal(
            {
                title: "Are you sure want to approve?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, approve it!",
                cancelButtonText: "No, cancel!",
                },
                    function (isConfirm)
                    {
                        if (isConfirm)
                        {
                            $.ajax({
                                
                                type : "GET",
                                url : "{{ url('gradingresult/approved')}}" + '/' + id,
                                data: {id:id},

                                success: function (data)
                                {
                                    
                                    swal("Approved!", "Your data has been approve.", "success");
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



        $('.demo5').click(function (e)
        {
            e.preventDefault();
            var id = $(this).data('id');
            swal(
            {
                        title: "Are you sure want to reject?",
                        // text: "Your will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!",
                        // closeOnConfirm: false,
                        // closeOnCancel: false 
                        },
                    function (isConfirm)
                    {
                        if (isConfirm)
                        {
                            $.ajax({
                                
                                type : "GET",
                                url : "{{ url('gradingresult/rejected')}}" + '/' + id,
                                data: {id:id},
                                success: function (data)
                                {
                                    swal("Rejected!", "Your data has been reject.", "success");
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