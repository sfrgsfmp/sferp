@extends('menu.mainmenu')
@section('title','List Specification')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Specification')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List Specification')</strong>
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
                    <h5>List Specification </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    @hasrole(['admin'])
                        <a href="{{ route('master.specification.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole
                    <table class="footable table table-bordered dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <!-- <th>ID</th> -->
                                <th>Name</th>
                                <th>Legend</th>
                                <th>Autocode</th>
                                <th>Vendor Name</th>
                                <th>Type Specification</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($specs as $spec)
                            <tr>
                                <td>{{$no++}}</td>
                                
                                <!-- <td>{{$spec['id']}}</td> -->
                                <td>{{$spec['name']}}</td>
                                <td>{{$spec['legend']}}</td>
                                <td>{{$spec['autocode']}}</td>
                                <td>{{$spec['vendorname']}}</td>
                                <td>{{$spec['type_specification']}}</td>
                                <td>
                                    
                                    <a href="{{ route('master.specification.edit', $spec->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-sm"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.specification.destroy', $spec['id']) }}" method="post">
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

