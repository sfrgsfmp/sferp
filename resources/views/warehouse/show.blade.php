@extends('menu.mainmenu')
@section('title','List Warehouse')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Warehouse')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List Warehouse')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List Warehouse </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    <!-- <a href="/master/warehouse/export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a> -->
                    @hasrole(['admin'])
                        <a href="{{ route('master.warehouse.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <!-- <th>ID</th> -->
                                <th>Code</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Group</th>
                                <th>Objective</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($gudang as $gud)
                            <tr>
                                <td>{{$no++}}</td>
                                
                                <!--<td>{{$gud['id']}}</td>-->
                                <td>{{$gud['warehouse_code']}}</td>
                                <td>{{$gud['warehouse_name']}}</td>
                                <td>
                                    @if ($gud->warehouse_type == '1')
                                        Standard Warehouse
                                    @elseif ($gud->warehouse_type == '2')
                                        Work In Progress
                                    @elseif ($gud->warehouse_type == '3')
                                        Work In Progress Store
                                    @elseif ($gud->warehouse_type == '4')
                                        Third Party Warehouse
                                    @endif
                                    
                                </td>
                                <td>{{$gud['warehouse_group']}}</td>
                                
                                <td> {{ implode(',', $gud->objective()->get()->pluck('objective_name')->toArray()) }} </td>
                                
                                <td>

                                    <a href="{{ route('master.warehouse.edit', $gud->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.warehouse.destroy', $gud['id']) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-xs ml-1"> Delete </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

