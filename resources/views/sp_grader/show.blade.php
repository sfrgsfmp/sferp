@extends('menu.mainmenu')
@section('title','Surat Perintah Grader')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Surat Perintah Tugas Grader')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Surat Perintah Grader')</strong>
        </li>
    </ol>
</div>

@endsection

@section('content')
<div class="col-lg-12">
<div class="wrapper wrapper-content animated fadeIn">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List Graders </h5>
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
                                        <!-- <th>No </th> -->
                                        <!-- <th>ID </th> -->
                                        <th>Noipl</th>
                                        <th>Grader</th>
                                        <th>Keperluan</th>
                                        <th>Lokasi</th>
                                        <th>Durasi</th>
                                        <th data-hide="all"> KBM</th>
                                        <th data-hide="all"> KPH</th>
                                        <th data-hide="all"> TPK </th>
                                        <th data-hide="all">Uang Dinas</th>
                                        <th data-hide="all">Bank</th>
                                        <th data-hide="all">Rekening</th>
                                        <th>Surat Perintah</th>
                                        <th>PDF</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=0; ?>
                                    <?php $var = ""; ?>
                                    @foreach($sendgraders as $sg)
                                    <?php 
                                        if($var != $sg['noipl'])
                                        {
                                            $var = $sg['noipl'];
                                            $vars = $sg['noipl'];
                                            $no++;
                                        }
                                        else
                                        {
                                            $vars = "";
                                            $no = "";
                                        }
                                    ?>
                                        <tr>
                                            <td> {{ $vars }} </td>
                                            <td> {{ implode(',', $sg->users()->get()->pluck('username')->toArray()) }} </td>
                                            <td> {{$sg['keperluan']}} </td>
                                            <td> {{ implode(',', $sg->vendors()->get()->pluck('name_vendor')->toArray()) }}</td>
                                            <td> {{$sg['start_date']}} - {{$sg['end_date']}}</td>
                                            <td> {{ implode(',', $sg->kbm()->get()->pluck('name_kbm')->toArray()) }} </td>
                                            <td> {{ implode(',', $sg->kph()->get()->pluck('name_kph')->toArray()) }} </td>
                                            <td> {{ implode(',', $sg->tpk()->get()->pluck('name_tpk')->toArray()) }} </td>
                                            <td> {{$sg['uang_dinas']}} </td>
                                            <td> {{$sg['bank']}} </td>
                                            <td> {{$sg['rekening']}}</td>
                                            <td align=center>
                                                @if($sg['surat_perintah'] == '')
                                                
                                                    <?php
                                                    $get = '';
                                                    $get.="<a href='#suratperintah' data-toggle='modal' class='float-center text-center' title='Nomor Surat' onclick=getid('".$sg['noipl']."')>
                                                    
                                                    <i class='fa fa-edit float-center'> </i>
                                                    
                                                    </a>";
                                                    echo $get;
                                                    ?>
                                                   
                                                @else
                                                    {{ $sg['surat_perintah'] }}

                                                @endif

                                                <form action="{{ route('spgrader.store', $sg->id) }}" method="post">
                                                @csrf
                                                    <div id="suratperintah" class="modal fade" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-10"><h3 class="m-t-none m-b float-left">Input Nomor Surat Perintah Grader</h3>
                                                                            <div class="col-lg-12">
                                                                               
                                                                                <input type="text" name="getipl" id="getipl" class="form-control" readonly>
                                                                                
                                                                                <input type="text" class="form-control @error('surat_perintah') is-invalid @enderror" placeholder="Nomor Surat Perintah" name="surat_perintah">
                                                                                @error('surat_perintah')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <strong>{{ $message }}</strong>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                            <br>
                                                                            <div class="col-lg-10 text-right">
                                                                                <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-check">  </i> Save</button>
                                                                                &nbsp
                                                                                <button class="btn btn-danger btn-sm " data-dismiss="modal">
                                                                                    <i class="fa fa-times"> </i>
                                                                                    Cancel
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </td>
                                            <td align=center>
                                                @if($sg['surat_perintah'] != '')
                                                
                                                    <a href="{{ route('spgrader.pdf', $sg->id) }}" class="float-center" title="PDF" > 
                                                        
                                                        <i class="fa fa-file-pdf-o text-black"></i>
                                                    </a>
                                                @else
                                                @endif
                                            </td>
                                        </tr>
                                        
                                        
                                    @endforeach
                                </tbody>
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
    function getid(noipl)
    {
       
        document.getElementById('getipl').value = noipl;
        // alert(noipl);
    }

    function get(id)
    {
        document.getElementById('getipl').value = id;
    }
</script>
@endsection