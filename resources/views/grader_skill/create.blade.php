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
              <strong>@yield('content_title_active','Grader')</strong>
          </li>
      </ol>
  </div>
  <div class="col-lg-2"></div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5> Create Grader Skill </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('master.grader.store') }}" method="POST">
                @csrf
               
                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">User</label>
                    
                    <div class="col-sm-8">
                        <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                            <option value=""> --- Choose --- </option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}"> {{$user->username}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Species</label>
                    <div class="col-sm-8">
                        <select class="form-control @error('species_id') is-invalid @enderror" name="species_id">
                            @foreach($species as $sp)
                            <option value="{{$sp->id}}"> {{$sp->name}}</option>
                            @endforeach
                        </select>
                        @error('species_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Sortimen</label>
                    <div class="col-sm-8">
                        <select class="form-control @error('sortimen') is-invalid @enderror" name="sortimen" id="sortimen">
                            <option value=""> ---Choose --- </option>
                            <option value="LOG"> Log </option>
                            <option value="BALOK"> Balok </option>
                            <option value="RST"> RST </option>
                            <option value="FP"> FP </option>
                            <option value="WIP"> WIP </option>
                            <option value="NONKAYU"> Non Kayu </option>
                        </select>
                        @error('sortimen')
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


@endsection