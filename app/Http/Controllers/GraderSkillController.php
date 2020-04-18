<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Species;
use App\User;
use App\GraderSkill;

class GraderSkillController extends Controller
{
    
    public function index()
    {

    }

    public function show()
    {
        $datas = Departemen::all();
        return view('grader_skill.show')->with(['datas'=> $datas, 'graders'=>GraderSkill::all()]);
    }

    public function create()
    {
        $datas = Departemen::all();
        return view('grader_skill.create')->with(['datas'=>$datas, 'users'=>User::all(), 'species'=>Species::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'species_id' => ['required'],
            'sortimen' => ['required'],
        ]);

        GraderSkill::create($request->all());
        return redirect()->route('master.grader.show')->with('success', 'Data has been created.');
    }

    public function edit($id)
    {
        return view('grader_skill.edit')->with(['datas'=>Departemen::all(), 'users'=>User::all(), 'species'=>Species::all(), 'graders'=>GraderSkill::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => ['required'],
            'species_id' => ['required'],
            'sortimen' => ['required'],
        ]);

        $grader = GraderSkill::find($id);
        $grader->update($request->all());
        return redirect()->route('master.grader.show')->with('success', 'Data has been updated.');
    }

    public function destroy($id)
    {
        $grader = GraderSkill::find($id);
        $grader->delete();
        return redirect()->route('master.grader.show')->with('success', 'Data has been delete.');
    }
}
