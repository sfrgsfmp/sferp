@extends('menu.mainmenu')

@section('title','Grader')

@section('section_title')
  <div class="col-lg-10">
      <h2>@yield('content_title','Grader')</h2>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="{{ route('home') }}">Home</a>
          </li>
          <li class="breadcrumb-item active">
              <strong>@yield('content_title_active','List Grader')</strong>
          </li>
      </ol>
  </div>
  <div class="col-lg-2"></div>
@endsection

@section('content')
<div class="col-lg-12">
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List Grader </h5>
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
                    @hasrole(['admin'])
                        <a href="{{ route('master.grader.create') }}" class="btn btn-primary btn-rounded btn-fw float-right" ><i class="fa fa-plus"></i> Add</a>
                    @endhasrole
                    <table class="footable table table-bordered toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Grader</td>
                                <th>Species</th>
                                <th>Sortimen</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($graders as $grader)
                            
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{ implode(',', $grader->users()->get()->pluck('username')->toArray()) }} </td>
                                <td>{{ implode(',', $grader->species()->get()->pluck('name')->toArray()) }} </td>
                                <td>{{$grader['sortimen']}}</td>
                                <td>
                                    <a href="{{ route('master.grader.edit', $grader->id) }}" class="float-left">
                                        <button type="button" class="btn btn-primary btn-xs"> Edit </button>
                                    </a>

                                    <form action="{{ route('master.grader.destroy', $grader->id) }}" method="post">
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
</div>

@endsection

