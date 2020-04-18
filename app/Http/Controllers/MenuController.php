<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen; //Model departemen
use Illuminate\Support\Facades\DB;
use App\MenuIT; 
use App\User;


class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $datas = Departemen::all();
        $menu1 = MenuIT::get();
        $user = User::all();
        
        return view ('menu.mainmenu', compact('datas', 'menu1', 'user'));

    }


}
