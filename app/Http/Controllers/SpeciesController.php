<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Species;
use App\User;
use App\Role;

class SpeciesController extends Controller
{
   
    public function index()
    {
        
        return view('species.show')->with(['datas'=>Departemen::all(), 'speciess'=>Species::all()]);
    }

   
    public function create()
    {
        return view('species.create')->with(['datas'=>Departemen::all(), 'speciess'=>Species::all()]);
    }

    
    public function store(Request $request)
    {
        // if($request->get('species') == Species::where('species'))
        // {
        //     return redirect()->route('species.index')->with('warning', 'Duplicate entry');
        // }
        // else
        // {
        //     $request->validate([
        //         'species' => 'required',
        //     ]);
    
        //     Species::create($request->all());
        //     return redirect()->route('species.index')->with('success', 'Data has been created.');
        // }
        

        $request->validate([
            // 'code' => ['required','unique:species'],
            'name' => ['required'],
            'legend' => ['required'],
            'autocode' => ['required'],
            'spec' => ['required'],
            'latinname' => ['required'],
        ]);

        Species::create($request->all());
        return redirect()->route('master.species.index')->with('success', 'Data has been created.');

        
    }

    
   
    
    public function edit($id)
    {
        
        return view('species.edit')->with(['datas'=>Departemen::all(), 'species'=>Species::find($id)]);
        
    }

    
    public function update(Request $request, $id)
    {
        $species = Species::find($id);

        $request->validate([
            // 'code' => ['required','unique:species'],
            'name' => ['required'],
            'legend' => ['required'],
            'autocode' => ['required'],
            'spec' => ['required'],
            'latinname' => ['required'],
        ]);

        $species->update($request->all());
        return redirect()->route('master.species.index')->with('success', 'Data has been updated.');
    }
    
    public function destroy(Species $species)
    {
        $species->delete();
        return redirect()->route('master.species.index')->with('success', 'Data has been delete.');
    }

}
