<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Ipl;
use App\User;
use App\Vendor;
use App\SendGrader;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class SPgraderController extends Controller
{
   
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    

    public function store(Request $request, $id)
    {
        $get = $request->getipl;
        $sg = SendGrader::find($get);
        // dd($sg);
        $request->validate([
            'surat_perintah' => 'required',
        ]);

        //update
        DB::table('sendgrader')
            ->where('noipl', $get)
            ->update(['surat_perintah' => $request->get('surat_perintah')]);

       
        return redirect()->route('spgrader.spgrader')->with('success', 'Data has been save');

        
    }

    // public function shownoipl(Request $request)
    // {
    //     dd($request->noipl);
    // }


    public function show()
    {
        $graders = DB::table('sendgrader')
                        ->orderBy('noipl', 'asc')
                        ->get();

        return view('sp_grader.show')->with(['datas'=>Departemen::all(), 'ipls'=>Ipl::all(), 'users'=>User::all(), 'vendors'=>Vendor::all(), 'sendgraders'=>SendGrader::orderBy('noipl','asc')->get() ]);
    }
    
    public function PDF($id)
    {
        
        $graders = SendGrader::find($id);
        $ipl = $graders->noipl;
        $nosurat = $graders->surat_perintah;
        $sendgraders = SendGrader::where('noipl', $ipl)->get();
    
        // $users = User::all();
        // $vendors = Vendor::all();
        $pdf = PDF::loadView('send_grader.suratperintahPDF', compact('sendgraders', 'ipl', 'nosurat'));
        // $pdf = PDF::loadView('send_grader.suratperintahPDF', ['sendgraders'=>$sendgraders, 'users'=>$users, 'vendors'=>$vendors]);
        // $pdf = PDF::loadView('send_grader.suratperintahPDF')->with(['sendgraders'=>$sendgraders]);
        return $pdf->download('SuratPerintah-'.$ipl.'.pdf');

         // //pdf
        // $sendgraders = SendGrader::where('noipl', $get)->get();
        // $pdf = PDF::loadView('send_grader.suratperintahPDF', compact(['sendgraders'=>$sendgraders]));
        // return $pdf->download('SuratPerintah-'.$sendgraders->surat_perintah.'.pdf');

    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        
    }

   
    public function destroy($id)
    {
        //
    }
}
