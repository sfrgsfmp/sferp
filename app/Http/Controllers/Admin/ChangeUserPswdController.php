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

class ChangeUserPswdController extends Controller
{

    public function index($id)
    {
       
        $activetab = "active";
        return view('admin.users.showforadmin')->with(['id' => User::find($id), 'datas' => Departemen::all(), 'roles' => Role::all(), 'activetab'=>$activetab ]);
    }

    

    public function update(Request $request, $id)
    {
        // $activetab = "active";
        $user = User::find($id);
        $validation = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|different:old_password',
            'confrim_password' => 'required|same:new_password'
        ]);

        if ($validation->fails())
        {
            return redirect()->back()->withErrors($validation->errors())->with('warning', 'Please check your input');
        }

        $user->password = Hash::make($request['confrim_password']);
        $user->save();

        // return redirect()->route('admin.users.index', ['id' => $user->id])->with('success', 'Password successfully updated');
        return redirect()->back()->with('success', 'Password successfully updated');
    }

   


}
