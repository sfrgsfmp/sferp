@extends('menu.mainmenu')
@section('title','Vendor')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Vendor')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List Vendor')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')

<!-- SHOW -->
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List Vendor </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                     @hasrole(['admin'])
                        <a href="{{ route('master.vendor.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole
                    <table class="footable table table-bordered toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <!-- <th data-toggle="true">No</th> -->
                                <th data-toggle="true">Type Vendor</th>
                                <th>Name Vendor</th>
                                <th>Province</th>
                                <th data-hide="all"> Address</th>
                                <th data-hide="all"> Postal Code</th>
                                <th data-hide="all"> Phone</th>
                                <th data-hide="all"> Email</th>
                                <th data-hide="all"> Bank Account </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($gvs as $gv)
                            <tr>
                                <!-- <td>{{$no++}}</td> -->
                                <td>{{$gv['type_vendor']}}</td>
                               
                                <td> {{ $gv['name_vendor'] }}</td>
                                <td> {{ implode(',', $gv->province()->get()->pluck('name')->toArray()) }} </td>
                                <td> {{ $gv['address']}} </td>
                                <td> {{$gv['postalcode']}} </td>
                                <td> {{$gv['phone']}} </td>
                                <td> {{$gv['email']}} </td>
                                <td> {{ implode(',', $gv->bankaccount()->get()->pluck('accountname')->toArray()) }} - {{ implode(',', $gv->bankaccount()->get()->pluck('accountno')->toArray()) }}</td>
                               
                                <td>
                                    <a href="{{ route('master.vendor.edit', $gv->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.vendor.destroy', $gv->id) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-xs ml-1"> Delete </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection