@extends('menu.mainmenu')
@section('title','List IPL')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','IPL')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List IPL')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')
<!-- SHOW -->
<div class="col-lg-12">
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List IPL </h5>
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
                    
                    <!-- <table class="footable table table-bordered toggle-arrow-tiny"> -->
                    <!-- <div class="table-responsive"> -->
                    <!-- <div class=""> -->
                    <table class="footable table table-stripped toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <th > No</th>
                                <th data-toggle="true">No IPL</th>
                                <th>Transaction</th>
                                <th>Vendor</th>
                                <th>Species</th>
                                <th>Sortimen</th>
                                <th data-hide="all">Diameter</th>
                                <th data-hide="all">Length</th>
                                <th data-hide="all">Width</th>
                                <th data-hide="all">Thick</th>
                                <th data-hide="all">Status</th>
                                <th data-hide="all">Quality</th>
                                <th data-hide="all">KWT</th>
                                <th>Wood Drying</th>
                                <th>Schema</th>
                                <th data-hide="all">Volume</th>
                                <th>Created By</th>
                                <th>Approval to</th>
                               
                                <th>Status</th>
                                <th>Send</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($ipls as $ipl)
                            
                            <tr>
                                <td> {{$no++}}</td>
                                <td>{{$ipl['noipl']}}</td>
                                <td>{{$ipl['transaction_date']}}</td>
                                <!-- <td>{{$ipl['vendor_id']}}</td> -->
                                <td> {{ implode(',', $ipl->vendor()->get()->pluck('name_vendor')->toArray()) }} </td>
                                <td>{{ implode(',', $ipl->species()->get()->pluck('name')->toArray()) }} </td>
                                <td>{{$ipl['sortimen']}}</td>
                                <td>{{$ipl['diameter_from']}} - {{$ipl['diameter_to']}} {{$ipl['uom_diameter']}}</td>
                                <td>{{$ipl['length_from']}} - {{$ipl['length_to']}} {{$ipl['uom_length']}}</td>
                                <td>{{$ipl['width_from']}} - {{$ipl['width_to']}} {{$ipl['uom_width']}}</td>
                                <td>{{$ipl['thick_from']}} - {{$ipl['thick_to']}} {{$ipl['uom_thick']}}</td>
                                <td>{{$ipl['status']}}</td>
                                <td>{{$ipl['quality']}}</td>
                                <td>{{$ipl['kwt']}}</td>
                                <td>{{$ipl['wood_drying']}}</td>
                                <td>{{$ipl['schema']}}</td>
                                <td>{{$ipl['volume']}} {{$ipl['uom_volume']}}</td>
                                <td>{{ implode(',', $ipl->createdby()->get()->pluck('username')->toArray()) }} </td>
                                <td>{{ implode(',', $ipl->approvalto()->get()->pluck('username')->toArray()) }}</td>
                                
                                <td>
                                    
                                   <!-- 1=Created, 2=WaitingApproval 3=Approved, 4=Rejected, 5=Revisi -->
                                    @if($ipl['status_approval'] == '1')
                                        Created
                                   
                                    @elseif ($ipl['status_approval'] == '2')
                                        Waiting Approval
                                   
                                    @elseif ($ipl['status_approval'] == '3')
                                        Approved
                                    
                                    @elseif ($ipl['status_approval'] == '4')
                                        Rejected
                                   
                                    @else
                                        Revise
                                    @endif
                                    
                                </td>
                                <td align=center>
                                    
                                    <!-- //CEK YG BIKIN PENGAJUAN == YG LOGIN -->
                                    <!-- //HANYA YG MEMBUAT PENGAJUAN YG DAPAT MENGIRIM EMAIL KPD APPROVE YG DITUJU -->
                                    @if($ipl['createdby_id'] == Auth::user()->id)
                                        <a href="{{ route('ipl.send', $ipl->id) }}" class="float-left" title="Send Email">
                                            <i class="fa fa-envelope"> </i>
                                        </a>
                                    @endif

                                </td>
                                <td align=center>
                                    @if ($ipl['approvalto_id'] == Auth::user()->id && $ipl['createdby_id'] != Auth::user()->id) 
                                        <!-- //cek yang login == approveid dituju -->
                                           
                                            <a class="demo4" title="Approve" data-id="{{$ipl->id}}"> <i class="fa fa-check text-navy"> </i> </a>

                                            <a class="demo3" title="Revisi" data-id="{{$ipl->id}}"> <i class="fa fa-pencil text-navy"> </i> </a>
                                            
                                            <a class="demo5" title="Reject" data-id="{{$ipl->id}}"> <i class="fa fa-times"> </i> </a>

                                    @elseif($ipl['createdby_id'] == Auth::user()->id)
                                                <!-- // 1=Created, 2=WaitingApproval 3=Approved, 4=Rejected, 5=Revisi -->
                                                @if ($ipl['status_approval'] == '1' || $ipl['status_approval'] == '5')
                                                    <a href="{{ route('ipl.edit', $ipl->id) }}" class='float-center' title="Edit">
                                                        
                                                        <i class="fa fa-edit"> </i>
                                                    </a>
                                                @else
                                                @endif

                                                <!-- if ($ipl['status_approval'] == '1')
                                                    <form action="{{ route('ipl.destroy', $ipl->id) }}" method="post">
                                                        {{ method_field('DELETE') }}
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-xs"> Delete </button>
                                                    </form>
                                                else
                                                endif -->
                                    @else
                                    @endif

                                    
                                </td>
                            </tr>
                            

                            @endforeach
                        </tbody>
                    @hasrole(['admin'])
                        <a href="{{ route('ipl.create') }}" class="btn btn-white btn-fw float-left" ><i class="fa fa-plus"></i> Add </a> 
                    @endhasrole
                    </table>
                    
                    <!-- </div> -->
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });

    $(document).ready(function() {
            $('.animation_select').click( function(){
                $('#animation_box').removeAttr('class').attr('class', '');
                var animation = $(this).attr("data-animation");
                $('#animation_box').addClass('animated');
                $('#animation_box').addClass(animation);
                return false;
            });

            
        });

</script>

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
                                url : "{{ url('ipl/revision')}}" + '/' + id,
                                data: {id:id},

                                success: function (data)
                                {
                                    
                                    swal("Revision!", "Your imaginary file has been revise.", "success");
                                    location.reload();
                                }         
                            });
                        }
                        else
                        {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
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
                                url : "{{ url('ipl/approved')}}" + '/' + id,
                                data: {id:id},

                                success: function (data)
                                {
                                    
                                    swal("Approved!", "Your imaginary file has been approve.", "success");
                                    location.reload();
                                }         
                            });
                        }
                        else
                        {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
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
                        text: "Your will not be able to recover this imaginary file!",
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
                                url : "{{ url('ipl/rejected')}}" + '/' + id,
                                data: {id:id},
                                success: function (data)
                                {
                                    swal("Rejected!", "Your imaginary file has been reject.", "success");
                                    location.reload();
                                }         
                            });
                        }
                        else
                        {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    }
                );
        });
    });

</script>

<script>
$(document).on('click', '.button', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
            title: "Are you sure?",
            type: "warning",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "GET",
                url : "{{ url('ipl/rejected')}}" + '/' + id,
                data: {id:id},
                success: function (data) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    location.reload();
                }         
            });
    });
});
</script>



@endsection