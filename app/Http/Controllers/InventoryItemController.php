<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;

class InventoryItemController extends Controller
{
    public function index()
    {
        return view('inventory-item.create')->with(['datas'=>Departemen::all()]);
    }

    public function store()
    {
        
    }
}
