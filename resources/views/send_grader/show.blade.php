@extends('menu.mainmenu')
@section('title','Approve IPL')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','IPL')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List Approved IPL')</strong>
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
                <div class="table-responsive">
                    <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                    
                        <thead>
                            <tr>
                                <th>No</th>
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
                                <th>Approval to</th>
                                <th>Status Approval</th>
                                
                                <th>Grader</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($ipls as $ipl)
                            
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$ipl['noipl']}}</td>
                                <td>{{$ipl['transaction_date']}}</td>
                                <td>{{ implode(',', $ipl->vendor()->get()->pluck('name_vendor')->toArray()) }} </td>
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
                                
                                <td align="center">
                                    <!-- // 1=Created, 2=WaitingApproval 3=Approved, 4=Rejected, 5=Revisi -->
                                    @if ($ipl['status_approval'] == '3')
                           

                                            <a href="{{ route('sendgrader.input_showgrader', $ipl->id) }}" class='text-center' title='Choose Grader'>
                                                <i class='fa fa-user-o text-center'> </i>
                                            </a>

                                    @else
                                    @endif     
                                    
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



<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });

    $('.chosen-select').chosen({width: "100%"});

    function showInputGrader(noipl)
    {
        document.getElementById('showinputgrader').style.display = 'block';
        document.getElementById('field_noipl').value = noipl;
        // alert(noipl);
    }

</script>



@endsection