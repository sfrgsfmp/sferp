@extends('menu.mainmenu')
@section('title','Bank')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Bank Account')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Bank')</strong>
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
            <h5> Create Bank </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form id="act" action="{{ route('master.bank.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name Bank</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('namebank') is-invalid @enderror" name="namebank" id="namebank">
                        @error('namebank')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        <button class="btn btn-white btn-sm" type="reset">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- SHOW -->
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>List Bank </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    
                    <table class="footable table table-bordered dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bank Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($banks as $bank)
                            <tr class="data-row">
                                <td>{{$no++}}</td>
                                
                                <td class="namebank">{{$bank['namebank']}}</td>
                                
                                <td>
                                    <a class="float-left">
                                        <button type="button" title="Edit" class="btn btn-primary btn-xs " id="edit-item" data-item-id=<?php echo $bank['id']; ?>>Edit</button>
                                    </a>

                                    <form action="{{ route('master.bank.destroy', $bank->id) }}" method="post">
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

<script>
    $(document).on('click', "#edit-item", function() {
        $(this).addClass('edit-item-trigger-clicked'); 
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
        var row = el.closest(".data-row");
        var id = el.data('item-id');
        var namebank = row.children(".namebank").text();
        $("#namebank").val(namebank);

        $("#act").attr('action', '/master/bank/update/'+id);

    })


</script>
@endsection