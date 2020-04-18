@extends('menu.mainmenu')
@section('title','Bank Account')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Bank Account')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Update Bank Account')</strong>
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
            <h5> Update Bank Account</h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            <form id="act" action="{{ route('master.account.update', ['b' => $b->id]) }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Bank</label>
                    <div class="col-sm-8">
                        
                        <select id="bank_id" name="bank_id" class="form-control @error('bank_id') is-invalid @enderror">
                            @foreach($bb as $bank)
                            
                            <option value="{{ $bank->id }}" {{ $bank->id == $b->bank_id ?'selected':'' }}> {{$bank['namebank']}}</option>
                            @endforeach
                        </select>
                        @error('bank_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Account Name</label>
                    <div class="col-sm-8">
                        
                       <input type="text" class="form-control @error('accountname') is-invalid @enderror" id="accountname" name="accountname" value="{{$b->accountname}}">
                        @error('accountname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Account Number</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control @error('accountno') is-invalid @enderror" id="accountno" name="accountno" value="{{$b->accountno}}">
                        @error('accountno')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Swift Code</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control @error('swiftcode') is-invalid @enderror" id="swiftcode" name="swiftcode" value="{{$b->swiftcode}}">
                        @error('swiftcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-8">
                       <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{$b->phone}}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-8">
                       <textarea class="form-control" id="address" name="address"> {{$b->address}}</textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        <!-- <button class="btn btn-white btn-sm" type="reset">Cancel</button> -->

                        <a href="{{ route('master.account.index') }}">
                            <button type="button" class="btn btn-white btn-sm " >Cancel</button>
                        </a>
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
                    
                    <table class="footable table table-bordered ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bank</th>
                                <th>Account Name</th>
                                <th>Account No</th>
                                <th>Swift Code</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            @foreach($banks as $bank)
                            <tr class="data-row">
                                <td>{{$no++}}</td>
                                
                                <td class="bankid">{{ implode(',', $bank->banks()->get()->pluck('namebank')->toArray()) }}</td>
                                <td class="accountname">{{$bank['accountname']}}</td>
                                <td class="accountno">{{$bank['accountno']}}</td>
                                <td class="swiftcode">{{$bank['swiftcode']}}</td>
                                <td class="phone">{{$bank['phone']}}</td>
                                <td class="address">{{$bank['address']}}</td>
                                <td>
                                    <a class="float-left" href="{{ route('master.account.edit', $bank->id) }}">
                                        <button type="button" title="Edit" class="btn btn-primary btn-xs " id="edit-item" data-item-id=<?php echo $bank['id']; ?>>Edit</button>
                                    </a>

                                    <form action="{{ route('master.account.destroy', $bank->id) }}" method="post">
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