@extends('menu.mainmenu')
@section('title','List KPH')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','KPH')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List KPH')</strong>
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
                    <h5>List KPH </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    @hasrole(['admin'])
                        <a href="{{ route('master.kph.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole
                    <table class="footable table table-bordered dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name KPH</th>
                                <th>Type KPH</th>
                                <th>KBM</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($kphs as $kph)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$kph['name_kph']}}</td>
                                <td>{{ implode(',', $kph->kphtype()->get()->pluck('code')->toArray()) }}</td>
                                <td> {{ implode(',', $kph->kbm()->get()->pluck('name_kbm')->toArray()) }} </td>
                                <td>
                                    <a href="{{ route('master.kph.edit', $kph->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.kph.destroy', $kph->id) }}" method="post">
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