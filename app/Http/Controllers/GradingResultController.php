<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Ipl;
use App\SendGrader;
use App\User;
use App\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\GradingResult;
use PDF;
use App\KBM;
use App\KPH;
use App\TPK;

class GradingResultController extends Controller
{
    
    public function index()
    {
        return view('grading_result.index')->with(['datas'=>Departemen::all(), 'results'=>GradingResult::all() ]);;
    }

    
    public function create(Request $request)
    {
        $id = $request->sendgrader;
        // $ipl = SendGrader::where('id', $id)->pluck('noipl');
        $getipl = Ipl::where('noipl', $id)->get();
        $results = GradingResult::orderBy('tipebiaya')->where('sendgrader_id', $id)->get();
        
        return view('grading_result.index')->with(['datas'=>Departemen::all(), 'sgs'=>SendGrader::where('surat_perintah', '!=', null)->get(), 'graders'=>SendGrader::where('id', $id)->get() , 'ipls'=>Ipl::all(), 'ipl'=>$getipl, 'results'=>$results ]);
    }

    public function getdata($id)
    {
        
        $ipl = SendGrader::where('id', $id)->pluck('noipl');
        
        $getipl = Ipl::where('noipl', $ipl)->get();

        $results = GradingResult::where('sendgrader_id', $id)->paginate(10);

        return view('grading_result.create')->with(['datas'=>Departemen::all(), 'sgs'=>SendGrader::where('surat_perintah', '!=', null)->get(), 'graders'=>SendGrader::where('id', $id)->get(), 'ipl'=>$getipl, 'resu'=>$results, 'pdf'=>$id, 'kbm'=>KBM::all(), 'kph'=>KPH::all(), 'tpk'=>TPK::all() ]);
    }

    public function getIdGrader()
    {
        // cek id yg login
        $grader = Auth::user()->id;
       
        $idgrader = SendGrader::where('grader_id', $grader)
            // ->where('surat_perintah', '<>', '')
            // ->get();
            ->pluck('grader_id');
            // ->first();
        // dd($idgrader);
        // $graders = SendGrader::all();
        $graders = SendGrader::pluck('grader_id');
        

        foreach($idgrader as $gr)
        {
            if ($gr == $grader) 
            {
                //  return View::make('users.login');
                echo "GAKADA";
            }
            else
            { 
                // return View::make('users.login1');  
                echo "ADA";
            }    
        }

        
    }

   
    public function pdf($id)
    {
        $gradingresult = GradingResult::orderBy('tipebiaya')
        ->where('sendgrader_id', $id)->get();

        $sg = GradingResult::orderBy('tipebiaya')->where('sendgrader_id', $id)->pluck('sendgrader_id');
        
        $sendgraders = SendGrader::find($sg);
        // dd($sg);
        $pdf = PDF::loadView('grading_result.resultpdf', compact('gradingresult', 'sendgraders'));
        
        return $pdf->download('Grading Result.pdf');
        // dd($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sendgrader_id' => ['required'],
            'date' => ['required'],
            'tipebiaya' => ['required'],
            'keterangan' => ['required'],
            'biaya' => ['required', 'numeric'],
            'nokendaraan' => ['required'],
            'btg' => ['required', 'numeric'],
            'm3' => ['required'],
            'harga/m3' => ['required', 'numeric'],
            'created_by' => ['required'],
        ]);
        $id = $request->get('sendgrader_id');
        GradingResult::create($request->all());
        return redirect()->back()->with('success', 'Data has been created.');
        // return redirect('gradingresult/getdata/'.$id)->with('success', 'Data has been created.');
        
        

    }

    
    public function show()
    {
        // $graderss = SendGrader::all();
        return view('grading_result.create')->with(['datas'=>Departemen::all(), 'graders'=>SendGrader::all(), 'ipls'=>Ipl::all() ]);
    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $gr = GradingResult::find($id);
        $request->validate([
            'sendgrader_id' => ['required'],
            'date' => ['required'],
            'tipebiaya' => ['required'],
            'keterangan' => ['required'],
            'biaya' => ['required', 'numeric'],
            'nokendaraan' => ['required'],
            'btg' => ['required', 'numeric'],
            'm3' => ['required'],
            'harga/m3' => ['required', 'numeric'],
            'created_by' => ['required'],
        ]);
        $gr->update($request->all());
        return redirect()->back()->with('success', 'Data has been updated.');
        // return redirect('gradingresult/getdata/'.$id)->with('success', 'Data has been updated.');
        // dd($request->get('keterangan'));
    }

    
    public function destroy($id)
    {
        $result = GradingResult::find($id);
        $result->delete();
        return redirect()->back()->with('success', 'Data has been delete.');
    }

    public function acc()
    {
        //show all grading result
        // $sendgraders = GradingResult::where(['status'=> '2'])->get();
        $sendgraders = DB::table('sendgrader')
                    ->join('grading_result', 'sendgrader.id', 'grading_result.sendgrader_id')
                    ->join('vendor', 'sendgrader.location_id', 'vendor.id')
                    ->join('users', 'sendgrader.grader_id', 'users.id')
                    ->select('sendgrader.*', 'vendor.name_vendor', 'users.username')
                    ->where('grading_result.status','=', '2')
                    ->get();
       
        return view('grading_result.acc')->with(['datas'=>Departemen::all(), 'results'=>GradingResult::where('status','!=','5')->get(), 'sendgraders'=>$sendgraders ]);
    }

    public function selectprint(Request $request)
    {
        $getsendgrader_id = $request->get('choose');
       
        $result = GradingResult::where(['sendgrader_id'=>$getsendgrader_id, 'status'=>2])->get();
        $send = SendGrader::where('id', $getsendgrader_id)->get();
        // $results = GradingResult::where(['sendgrader_id'=>$getsendgrader_id, 'status'=>2])->pluck('nokendaraan');
        // dd($results);
        // $result = DB::table('sendgrader')
        //         ->join('grading_result', 'sendgrader.id', '=', 'grading_result.sendgrader_id')
        //         ->join('users', 'sendgrader.grader_id', '=', 'users.id')
        //         ->join('vendor', 'sendgrader.location_id', '=', 'vendor.id')
        //         ->join('ipl', 'sendgrader.noipl', '=', 'ipl.noipl')
        //         ->join('species', 'ipl.species_id', '=', 'species.id') //spesies jeniskayu
        //         // ->join('vendor', 'ipl.vendor_id', '=', 'vendor.id')//supplier
        //         ->select('sendgrader.*', 'grading_result.*', 'ipl.*', 'users.username', 'vendor.name_vendor as location','species.name as namaspesies')
        //         ->where(['grading_result.status'=>2,'sendgrader.id'=>$getsendgrader_id])
        //         ->get();
        // dd($result);
        if($getsendgrader_id == '')
        {
            return back()->with('warning', 'You must choose first.');
        }
        else
        {
            $pdf = PDF::loadView('grading_result.resultpdf', compact('result',  'send'));
        
            return $pdf->download('Grading Result.pdf');
        }
        
    }

    public function approve($id)
    {
        //1=Waiting, 2=Approved 3=Rejected, 4=Revisi //5 created
        $gr = GradingResult::find($id);
        $gr->update([
            'status'=>'2', 
            'approval_statusby'=>Auth::user()->id,
        ]);
        return back()->with('success', 'Request has been approved.');
    }

    public function reject($id)
    {
        $gr = GradingResult::find($id);
        $gr->update([
            'status'=>'3',
            'approval_statusby'=>Auth::user()->id, 
        ]);
        return back()->with('success', 'Request has been rejected.');
    }

    public function revise($id)
    {
        $gr = GradingResult::find($id);
        $gr->update([
            'status'=>'4',
            'approval_statusby'=>Auth::user()->id,
        ]);
        return back()->with('success', 'Request has been revision.');
    }

    public function send($id)
    {
        $gr = GradingResult::find($id);
        $gr->update([
            'status'=>'1',
            
        ]);
        return back()->with('success', 'Request has been send.');
    }
}
