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
              <strong>@yield('content_title_active','Update Grader')</strong>
          </li>
      </ol>
  </div>
  <div class="col-lg-2"></div>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="ibox">
        <div class="ibox-title">
            <h5> Update Grader Skill </h5>
            <div class="ibox-tools">
              <a class="collapse-link">
                  <i class="fa fa-chevron-up"></i>
              </a>
          </div>
        </div>
        <div class="ibox-content">
            

            <form action="{{ route('master.grader.update', ['graders' => $graders->id]) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">User</label>
                    
                    <div class="col-sm-8">
                        <select class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                            <option value=""> --- Choose --- </option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $graders->user_id ?'selected':'' }}> {{$user->username}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label">Species</label>
                    <div class="col-sm-8">
                        <select class="form-control @error('species_id') is-invalid @enderror" name="species_id">
                            @foreach($species as $sp)
                                <option value="{{$sp->id}}" {{ $sp->id == $graders->species_id ?'selected':'' }} > {{$sp->name}}</option>
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
                            <option value="LOG" {{ ($graders->sortimen === 'LOG') ? 'selected' : '' }}> Log </option>
                            <option value="BALOK" {{ ($graders->sortimen === 'BALOK') ? 'selected' : '' }}> Balok </option>
                            <option value="RST" {{ ($graders->sortimen === 'RST') ? 'selected' : '' }}> RST </option>
                            <option value="FP" {{ ($graders->sortimen === 'FP') ? 'selected' : '' }}> FP </option>
                            <option value="WIP" {{ ($graders->sortimen === 'WIP') ? 'selected' : '' }}> WIP </option>
                            <option value="NONKAYU" {{ ($graders->sortimen === 'NONKAYU') ? 'selected' : '' }}> Non Kayu </option>

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