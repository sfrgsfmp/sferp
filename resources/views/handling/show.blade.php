@extends('menu.mainmenu')
@section('title','List Handling')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Handling')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List Handling')</strong>
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
                    <h5>List Handling </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    <!-- <a href="/master/handling/export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a> -->
                    @hasrole(['admin'])
                        <a href="{{ route('master.handling.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole
                    <table class="footable table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <!-- <th>ID</th> -->
                                <th>Code</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Group</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($hand as $hdl)
                            <tr>
                                <td>{{$no++}}</td>
                                
                                <!--<td>{{$hdl['id']}}</td>-->
                                <td>{{$hdl['code']}}</td>
                                <td>{{$hdl['name']}}</td>
                                <td>
                                    @if ($hdl->is_status === 0)
                                        Inactive
                                    @else
                                        Active
                                    @endif
                                    <!-- {{$hdl['status']}} -->
                                </td>
                                <td>{{$hdl['group']}}</td>
                                <!-- <td>{{$hdl['id_section']}}</td> -->
                                <td> {{ implode(',', $hdl->section()->get()->pluck('name')->toArray()) }} </td>
                                
                                <td>

                                    <a href="{{ route('master.handling.edit', $hdl->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-sm"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.handling.destroy', $hdl['id']) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"> Delete </button>
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

