<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Departemen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

//change password untuk SELAIN admin
class changepasswordController extends Controller
{
    public function index($id)
    {
        // $user = User::find($id);
        // return view('admin.users.show')->with(['id' => $user->id, 'datas' => Departemen::all(), 'roles' => Role::all()]);
        // view('admin.users.show')
        return view('changepassworduser')->with(['user' => User::find($id), 'datas' => Departemen::all(), 'roles' => Role::all()]);

        // $user = User::find($id);
        // $departments = Departemen::all();
        // $roles = Role::all();

        // return view('admin.users.show', ['id' => $user->id, 'departments' => $departments, 'roles' => $roles]);

    }

    
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validation = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|different:old_password',
            'confrim_password' => 'required|same:new_password'
        ]);

        if ($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors());
        }

        $user->password = Hash::make($request['confrim_password']);
        
        $user->save();

        // return redirect()->route('changepassword.index', ['user' => $user->id])->with('success', 'Password successfully updated');
        return redirect()->back()->with('success', 'Password successfully updated');
    }


}
