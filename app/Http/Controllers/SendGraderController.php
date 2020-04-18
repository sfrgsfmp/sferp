<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Ipl;
use App\User;
use App\Vendor;
use App\SendGrader;
use App\GraderSkill;
use App\KBM;
use App\KPH;
use App\TPK;
use App\Bank;

class SendGraderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'noipl' => ['required'],
            'grader_id' => ['required'],
            'keperluan' => ['required'],
            'location_id' => ['required'],
            // 'kbm_id' => ['required'],
            // 'kph_id' => ['required'],
            // 'tpk_id' => ['required'],
            'uang_dinas' => ['required', 'numeric'],
            'start_date'=> ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'bank' => ['required'],
            'rekening' => ['required'],
        ]);
        // $request->bank = strtoupper($request->get('bank'));
        $location_id = $request->location_id; //id,provid
        $get = explode(',',$location_id);
        $get_id = $get[0];

        $sg = new SendGrader();
        $sg->noipl = $request->get('noipl');
        $sg->grader_id = $request->get('grader_id');
        $sg->keperluan = $request->get('keperluan');
        $sg->location_id = $get_id;
        $sg->kbm_id = $request->get('kbm_id');
        $sg->kph_id = $request->get('kph_id');
        $sg->tpk_id = $request->get('tpk_id');
        $sg->uang_dinas = $request->get('uang_dinas');
        $sg->start_date = $request->get('start_date');
        $sg->end_date = $request->get('end_date');
        $sg->bank = $request->get('bank');
        $sg->rekening = $request->get('rekening');
        $sg->save();
        
        
        // SendGrader::create($request->all());
        

        return redirect()->back()->with('success', 'Data has been created');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $ipls = Ipl::where('status_approval', '3')->get();
        return view('send_grader.show')->with(['datas'=>Departemen::all(), 'ipls'=>$ipls, 'users'=>User::all(), 'vendors'=>Vendor::all(), 'sendgraders'=>SendGrader::all()]);
        
    }

    public function showgrader($id)
    {
        $ipls = Ipl::find($id);
        $ipl = $ipls->noipl;
        $sortimen = $ipls->sortimen;
        $jk = $ipls->species_id;
        // dd($ipls);
        $sg=SendGrader::where('noipl',$ipl)->get();
        return view('send_grader.input_showgrader')->with(['datas'=>Departemen::all(), 'ipls'=>$ipls, 'graders'=>GraderSkill::where(['sortimen'=>$sortimen, 'species_id'=>$jk])->get(), 'vendors'=>Vendor::all(), 'sendgraders'=>$sg, 'bank'=>Bank::all() ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $ipls=Ipl::find($id);
        // $ipl = $ipls->noipl;
        // dd($ipl);
        $sg=SendGrader::find($id);
        return view('send_grader.edit')->with(['datas'=>Departemen::all(), 'users'=>User::all(), 'vendors'=>Vendor::all(), 'sendgraders'=>$sg, 'bank'=>Bank::all(), 'kbm'=>KBM::all(), 'kph'=>KPH::all(), 'tpk'=>TPK::all() ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sg = SendGrader::find($id);
        $request->validate([
            'noipl' => ['required'],
            'grader_id' => ['required'],
            'keperluan' => ['required'],
            'location_id' => ['required'],
            // 'kbm_id' => ['required'],
            // 'kph_id' => ['required'],
            // 'tpk_id' => ['required'],
            'uang_dinas' => ['required', 'numeric'],
            'start_date'=> ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'bank' => ['required'],
            'rekening' => ['required'],
        ]);
        // $request->bank = strtoupper($request->get('bank'));
        // $sg->update($request->all());
        // $getipl = $sg->noipl;
        
        // $idd = Ipl::where('noipl',$getipl)->first();
        
        // return redirect("/sendgrader/ipl/".$idd->id)->with('success', 'Data has been updated');

        $location_id = $request->location_id; //id,typevendor
        $get = explode(',',$location_id);
        $get_id = $get[0];

        $sg = SendGrader::find($id);
        $sg->noipl = $request->get('noipl');
        $sg->grader_id = $request->get('grader_id');
        $sg->keperluan = $request->get('keperluan');
        $sg->location_id = $get_id;
        $sg->kbm_id = $request->get('kbm_id');
        $sg->kph_id = $request->get('kph_id');
        $sg->tpk_id = $request->get('tpk_id');
        $sg->uang_dinas = $request->get('uang_dinas');
        $sg->start_date = $request->get('start_date');
        $sg->end_date = $request->get('end_date');
        $sg->bank = $request->get('bank');
        $sg->rekening = $request->get('rekening');
        $sg->save();
    
        $getipl = $request->noipl;
        $idd = Ipl::where('noipl',$getipl)->first();
        
        return redirect("/sendgrader/ipl/".$idd->id)->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sg = SendGrader::find($id);
        $sg->delete();
        return redirect()->back()->with('success', 'Data has been deleted');
    }

    public function getKBM($id)
    {
        $get = KBM::where('province_id', $id)->pluck('name_kbm', 'id');
        return json_encode($get);
    }

    public function getKPH($id)
    {
        $get = KPH::where('kbm_id', $id)->pluck('name_kph', 'id');
        return json_encode($get);
    }

    public function getTPK($id)
    {
        $get = TPK::where('kph_id', $id)->pluck('name_tpk', 'id');
        return json_encode($get);
    }
}
