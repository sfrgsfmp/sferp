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
            <strong>@yield('content_title_active','List Purchase Order for Raw Material')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')
<div class="col-lg-12">
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List PO </h5>
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
                        <table class="footable table table-bordered toggle-arrow-tiny dataTables-example">
                            <thead>
                                <tr>
                                    <th data-toggle="true"> Code </th>
                                    <th> Contract </th>
                                    <th> Status</th>
                                    <th data-hide="all"> Item Group </th>
                                    <th data-hide="all"> Spec</th>
                                    <th data-hide="all"> Vendor</th>
                                    <th data-hide="all"> Payment Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach($pos as $po)
                                <tr>
                                    <td> {{$po['code']}}</td>
                                    <td> {{$po['startcontract']}} - {{$po['expiredcontract']}}</td>
                                    <td>{{$po['status']}}</td>
                                    <td>{{$po['itemgroup_id']}}</td>
                                    <td>{{$po['spec_id']}}</td>
                                    <td> {{ implode(',', $po->vendors()->get()->pluck('name_vendor')->toArray()) }}</td>
                                    <td>{{$po['paymentnote']}}</td>
                                    <td> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        @hasrole(['admin'])
                            <a href="{{ route('po.create') }}" class="btn btn-primary btn-fw float-left" ><i class="fa fa-plus"></i> Add </a> 
                        @endhasrole
                        </table>
                    
                    </div>
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
</script>
@endsection