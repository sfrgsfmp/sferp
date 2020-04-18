<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\PO;
use App\Company;
use App\Itemgroup;

class SupplierInvoicePaymentController extends Controller
{
    public function create()
    {
        return view('invoice.create')->with(['datas'=>Departemen::all(), 'pos'=>PO::where('is_delete','0')->get(), 'company'=>Company::all(), 'itemgroup'=>Itemgroup::where('is_delete','0')->get() ]);
    }

    public function selectpo($id)
    {
        $po = PO::where(['id'=>$id, 'is_delete'=>'0'])->pluck('code');

        return json_encode(array($id, $po));
    }
}
