<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;

class ITDeptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //
    public function index()
    {
        $datas = Departemen::all();
        return view ('page-content.coba', ['datas' => $datas]);
    }

    public function show()
    {
        return view('page-content.coba');

        // $linkto = Menu::all();
        // return view ('page-content.$linkto->link_menu', ['linkto' => $linkto]);
    }
}
