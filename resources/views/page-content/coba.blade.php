@extends('menu.mainmenu')
@section('title','menu 1')

@section('section_title')
<div class="col-lg-10">
    <h2>@yield('content_title','Karyawan')</h2>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <strong>@yield('content_title_active','coba')</strong>
        </li>
    </ol>
</div>
<div class="col-lg-2">
</div>
@endsection

@section('content')
haaaaaaaaaaaiiiiiiiiii
@endsection