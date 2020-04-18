@extends('menu.mainmenu')

@section('title','Supplier Invoice Payment')

@section('section_title')
  <div class="col-lg-10">
      <h2>@yield('content_title','Supplier Invoice Payment')</h2>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a href="{{ route('home') }}">Home</a>
          </li>
          <li class="breadcrumb-item active">
              <strong>@yield('content_title_active','Supplier Invoice Payment')</strong>
          </li>
      </ol>
  </div>
  <div class="col-lg-2"></div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5> Input Supplier Invoice Payment </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('invoice.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-9">
                        <div class="form-group row" >
                            <label class="col-sm-2 col-form-label">Number</label>
                            
                            <div class="col-sm-8">
                                
                                <input type="text" id="number" name="number" class="form-control @error('number') is-invalid @enderror">
                                
                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label class="col-sm-2 col-form-label">Apply Date</label>
                            
                            <div class="col-sm-8">
                                <div class="input-daterange input-group" >
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type='text' class="form-control datepicker-here @error('applydate') is-invalid @enderror" name="applydate" id="applydate" data-language='en' />
                                    @error('applydate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label class="col-sm-2 col-form-label">No PO</label>
                            
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="hidden" id="po_id" name="po_id" class="form-control" readonly>
                                    <input type="text" id="po" name="po" class="form-control" readonly>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal5"> <i class="fa fa-search" id="window"> </i> </button>
                                    </span>
                                </div>
                                @error('po')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Status</label>
                            <div class="col-sm-7">
                                <select class="form-control-sm form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="Approved">Approved</option>
                                    <option value="Hold"> Hold</option>
                                    <option value="Cancel"> Cancel</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Item Group</label>
                            <div class="col-sm-7">
                                <select class="form-control-sm form-control @error('itemgroup') is-invalid @enderror" id="itemgroup_id" name="itemgroup_id">
                                    @foreach($itemgroup as $ig)
                                        <option value="{{$ig->id}}">{{$ig->itemgroup_code}}</option>
                                    @endforeach
                                </select>
                                @error('itemgroup')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label">Division</label>
                            <div class="col-sm-7">
                                <select class="form-control-sm form-control @error('division') is-invalid @enderror" id="division" name="division">
                                    <option value=""> Division </option>
                                    @foreach($company as $com)
                                        <option value="{{$com->code}}">{{$com->code}}</option>
                                    @endforeach
                                </select>
                                @error('division')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-7">
                                <input type="hidden" class="form-control @error('division_id') is-invalid @enderror" id="division_id" name="division_id" readonly>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- //SEARCH PO -->
<div class="modal inmodal fade" id="myModal5" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">PO</h4>
                <small class="font-bold">Purchase Order</small>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="footable table-bordered toggle-arrow-tiny dataTables-example">
                        <thead>
                            <tr>
                                <th data-toggle="true"> Apply Date </th>
                                <th>PO</th>
                                <th>Vendor</th>
                                <th>Species</th>
                                <th>Volume Note</th>
                                <th>Spec1</th>
                                
                                <th> Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pos as $po)
                            <tr>
                                <td> {{ $po->startcontract }} </td>
                                <td> {{ $po->code }} </td>
                                <td> {{ implode(',', $po->vendors()->get()->pluck('name_vendor')->toArray()) }} </td>
                                <td> {{ implode(',', $po->species()->get()->pluck('name')->toArray()) }} </td>
                                <td> {{ $po->volumenote}} </td>
                                <td> {{ implode(',', $po->specification()->get()->pluck('name')->toArray()) }} </td>
                                
                                <td align=center> 
                                    <a class='selectpo' id="selectpo" data-id="{{$po->id}}" title="Choose">                        
                                        <i class="fa fa-check-square-o"> </i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.selectpo').click(function(e){
            e.preventDefault();
            var id = $(this).data('id');
            if(id)
            {
                console.log('id = '+id);

                $.ajax({
                    url: '/invoice/selectpo/'+id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        console.log(data);
                        $('#po_id').val(data[0]);
                        $('#po').val(data[1]);
                        $('#myModal5').modal('hide');
                    }
                })
            }
        })
    })

</script>
@endsection