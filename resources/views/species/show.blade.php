@extends('menu.mainmenu')
@section('title','List Species')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Species')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List Species')</strong>
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
                    <h5>List Species </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    @hasrole(['admin'])
                        <a href="{{ route('master.species.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole
                    <table class="footable table table-bordered dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <!-- <th>Id</th> -->
                                <th>Code</th>
                                <th>Name</th>
                                <th>Legend</th>
                                <th>Autocode</th>
                                <th>Spec</th>
                                <th>Latin Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($speciess as $species)
                            <tr>
                                <td>{{$no++}}</td>
                                <!-- <td>{{$species['id']}}</td> -->
                                <td>{{$species['code']}}</td>
                                <td>{{$species['name']}}</td>
                                <td>{{$species['legend']}}</td>
                                <td>{{$species['autocode']}}</td>
                                <td>{{$species['spec']}}</td>
                                <td>{{$species['latinname']}}</td>
                                <td>
                                    
                                    <a href="{{ route('master.species.edit', $species->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.species.destroy', $species->id) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-xs ml-1"> Delete </button>
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

@endsection

