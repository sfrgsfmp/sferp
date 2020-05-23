<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Departemen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class changepasswordController extends Controller
{
    public function index($id)
    {
        
        return view('changepassworduser')->with(['user' => User::find($id), 'datas' => Departemen::all(), 'roles' => Role::all()]);

        
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

       

        if (!(Hash::check($request->old_password, Auth::user()->password))) {
            return redirect()->back()->with('warning', 'Your old password not same');
        }
        else
        {
            $user->password = Hash::make($request['confrim_password']);
        
            $user->save();
            return redirect()->back()->with('success', 'Password successfully updated');
        }
    }


}
