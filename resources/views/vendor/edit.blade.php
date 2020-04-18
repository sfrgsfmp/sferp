@extends('menu.mainmenu')
@section('title','Vendor')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Vendor')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('master.vendor.index') }}">List</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','Edit Vendor')</strong>
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
            <h5> Edit Vendor </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('master.vendor.update', ['gvs' => $gvs->id]) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Type Vendor</label>
                    <div class="col-sm-10">
                        
                        <select class="form-control @error('type_vendor') is-invalid @enderror" name="type_vendor" id="type_vendor" onclick="getTypeVendor();">
                            
                            
                            <option value="Perhutani" {{ ($gvs->type_vendor === 'Perhutani') ? 'selected' : '' }}> Perhutani </option>
                            <option value="NonPerhutani" {{ ($gvs->type_vendor === 'NonPerhutani') ? 'selected' : '' }}> Non Perhutani </option>
                            
                                    
                        </select>
                        @error('type_vendor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name_vendor') is-invalid @enderror" name="name_vendor" value="{{$gvs->name_vendor}}">
                        @error('name_vendor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" > {{$gvs->address}}</textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Province</label>
                    <div class="col-sm-10">
                        <select name="province" id="province" class="form-control @error('province') is-invalid @enderror" >
                            <option value="">Province</option>
                            @foreach($provs as $prov)
                                <option value="{{ $prov->id }}" {{ $prov->id == $gvs->province_id ? 'selected':'' }}> {{ $prov->name }} </option>
                            @endforeach
                        </select>

                        

                        @error('province')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-10">
                        <select name="city" id="city" class="form-control @error('city') is-invalid @enderror">
                            <option value=""> City </option>
                            @foreach($city as $ct)
                                <option value="{{ $ct->id }}" {{ $ct->id == $gvs->city_id ? 'selected':'' }}> {{ $ct->name }} </option>
                            @endforeach
                        </select>
                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Postal Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('postalcode') is-invalid @enderror" id=postalcode name=postalcode value="{{$gvs->postalcode}}">
                        @error('postalcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Port of Loading</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('portofloading') is-invalid @enderror" id=portofloading name=portofloading value="{{$gvs->portofloading}}">
                        @error('portofloading')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id=phone name=phone value="{{ $gvs->phone }}">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Fax</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('fax') is-invalid @enderror" id=fax name=fax value="{{ $gvs->fax }}">
                        @error('fax')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id=email name=email value="{{$gvs->email}}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Website</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id=website name=website value="{{$gvs->website}}">
                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Payment</label>
                    <div class="col-sm-10">
                        <select id=bankaccount_id name=bankaccount_id class="form-control @error('payment') is-invalid @enderror">
                            <option value=""> Choose </option>
                            @foreach($bankacc as $ba)
                                <option value="{{ $ba->id }}" {{ $ba->id == $gvs->bankaccount_id ? 'selected':'' }}> {{ implode(',', $ba->banks()->get()->pluck('namebank')->toArray()) }} - {{ $ba->accountname }} </option>
                            @endforeach
                        </select>
                        @error('payment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- <div id="getkph">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Group KPH</label>
                        <div class="col-sm-10">
                            
                            <select class="form-control @error('kph_id') is-invalid @enderror" id="kph_id" name="kph_id" readonly>

                                <option value=""> --- Choose KPH --- </option>
                                @foreach($kphs as $kph)
                                    <option value="{{$kph->id}}" {{ $kph->id == $gvs->kph_id ?'selected':'' }} > {{ $kph->name_kph }}</option>
                                @endforeach
                            </select>

                            @error('kph_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div> -->

                <div class="form-group row">
                    <div class="col-lg-12 text-center">
                        
                        <button class="btn btn-primary btn-sm" type="submit">Save</button>
                        <a href="{{ route('master.vendor.index') }}" class="btn btn-white btn-sm"> Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    // function getTypeVendor()
    // {
    //     var get = document.getElementById('type_vendor').value;
        
    //     if(get != 'Perhutani')
    //     {
    //         document.getElementById('getkph').style.display = 'none';
    //         document.getElementById('kph_id').disabled = true;
    //     }
    //     else
    //     {
    //         document.getElementById('getkph').style.display = 'block';
    //         document.getElementById('kph_id').disabled = false;
    //     }

       
    // }
</script>
<script>
$(document).ready(function(){
    $('select[name="province"]').on('change', function(){
        var provid = $(this).val();
        if(provid)
        {
            console.log('prov'+provid);
            $.ajax({
                url: '/master/vendor/getcity/'+provid,
                type: 'GET',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    $('select[name="city"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="city"]').append('<option value="'+key+'">'+value+'</option>');
                    })
                }
            })
        }
    })
})

$(document).ready(function(){
    $('select[name="city"]').on('change', function(){
        var cityid = $(this).val();
        console.log('cityid'+cityid);
    })
})

 </script>


@endsection