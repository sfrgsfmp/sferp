<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;

class HJDcontroller extends Controller
{
    public function index()
    {
        return view('hjd.create')->with(['datas'=>Departemen::all()]);
    }
}
