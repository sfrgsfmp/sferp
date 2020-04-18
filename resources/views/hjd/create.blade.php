@extends('menu.mainmenu')
@section('title','HJD ')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','HJD')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','List HJD')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">

</div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5> List HJD</h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">
                <table id="list_hjd" class="footable table-bordered dataTables-example">
                    <thead>
                        <tr>
                            <th> Year </th>
                            <th> Species </th>
                            <th> Spec1</th>
                            <th> Quality</th>
                            <th> Quality Type</th>
                            <th> KPH Type</th>
                            <th> Sort Class</th>
                            <th> Dia Min</th>
                            <th> Dia Max</th>
                            <th> Length Min</th>
                            <th> Length Max</th>
                            <th> Price </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection