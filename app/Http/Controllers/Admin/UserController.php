<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use App\Departemen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use PDF;


class UserController extends Controller
{
    
    public function index()
    {
        $datas = Departemen::get(); 
        $users = User::where('status', '1')->get();

        return view('admin.users.index', compact('users', 'datas'));
    }

    public function create()
    {
        $datas = Departemen::get();
        $roles = Role::all();
        return view ('admin.users.create', compact('datas', 'roles'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
        ]);

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
        ]);

        $user->roles()->sync($request->get('role'));

        return redirect()->route('admin.users.index')->with('success', 'User has been created.');
        
    }


    public function show($id)
    {
        // $user = Auth::user();

        $activetab = "active";
        return view('admin.users.showforadmin')->with(['user' => User::find($id), 'datas' => Departemen::all(), 'roles' => Role::all(), 'activetab'=>$activetab]);
    }

    

    public function edit($id)
    {
        // if(Auth::user()->id == $id)
        // {
        //     return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself.');
        // }

        return view('admin.users.edit')->with(['user' => User::find($id), 'roles' => Role::all(), 'datas' => Departemen::all()]);
    }

    
    public function update(Request $request, $id)
    {
        // if(Auth::user()->id == $id)
        // {
        //     return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself.');
        // }

        $user = User::find($id);

            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'role' => 'required',
            ]);
            $user->update($request->all()); 

        $user->roles()->sync($request->role);

        // return redirect()->route('admin.users.index')->with('success', 'User has been updated.');

        return redirect()->to('admin/users/profile/'.$id)->with('success', 'User has been updated.');

    }

    
    public function destroy($id)
    {
        if(Auth::user()->id == $id)
        {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to delete yourself.');
        }

        // User::destroy($id); //hapus id di tabel user
        $user = User::find($id);
        if($user)
        {
            // $user->roles()->detach(); //detach untuk hapus id di tabel relationship (fk)
            // $user->delete();
            // return redirect()->route('admin.users.index')->with('success', 'User has been deleted');

            //mengubah status user menjadi 0=nonaktif. user trsbt di tabel masih ada
            $user->update(['status'=>'0']);
            // return redirect()->route('admin.users.index')->with('success', 'User has been deleted');
            return back()->with('success', 'User has been delete.');
        }

        // return redirect()->route('admin.users.index')->with('warning', 'This user can not be delete');
    }


    public function generatePDF($id)
    {
        $user = User::find($id);
        $pdf = PDF::loadView('myPDF', compact('user'));
        
        return $pdf->download('cobapdf.pdf');
    }

    public function PDF()
    {
        $users = User::all();

        $pdf = PDF::loadView('PDF', compact('users'));
        return $pdf->download('trypdf.pdf');

    }
}
