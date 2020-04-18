<?php

namespace App\Http\Controllers;

use App\Crud;
use App\Departemen;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


class CrudController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // $karyawans = Crud::latest()->paginate(5);
        $karyawans = Crud::all();
        $datas = Departemen::get(); //buat manggil menu
        $users = User::all();
        $roles = Role::all();
        return view('page-content.cobashowdata', compact('karyawans', 'datas', 'users', 'roles'));
        //compact bawa parameter dari file lain
        // return view ('page-content.cobainputdata', compact('karyawans', 'datas'));
    }

   
    public function create()
    {
        // $karyawans = Crud::all();
        $datas = Departemen::get();
        // return view ('page-content.cobainputdata');
        return view ('page-content.cobainputdata', compact('datas'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'namakaryawan' => 'required',
            'alamat' => 'required',
            'notlp' => 'required|numeric',
        ]);

        Crud::create($request->all());
        return redirect()->route('karyawans.index')->with('success', 'Data telah ditambahkan!');
    }

   
    public function show(Crud $karyawans)
    {
        // $datas = Departemen::all();
        $users = User::all();
        $roles = Role::all();
        return view ('page-content.cobashowdata', compact('karyawans', 'datas', 'users', 'roles'));
    }

   
    public function edit(Crud $karyawan, Departemen $datas)
    {
        $datas = Departemen::all();
        return view ('page-content.cobaeditdata', compact('karyawan', 'datas'));
    }

    
    public function update(Request $request, Crud $karyawan)
    {    
        $request->validate([
            'namakaryawan' => 'required',
            'alamat' => 'required',
            'notlp' => 'required',
        ]);

        $karyawan->update($request->all());
        return redirect()->route('karyawans.index')->with('success', 'Data telah berhasil diupdate');

        // alert()->success('Berhasil.','Data telah berhasil diupdate!');
        // return redirect()->route('karyawans.index');
    }

    
    public function destroy(Crud $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('karyawans.index')->with('success', 'Yeayy!! Data karyawan berhasil dihapus');
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'emailto' => 'required'
        ]);

        $data = array(
            'message' => $request->message,
            'emailto' => $request->emailto
        );
        // dd($data);

        Mail::to($request->emailto)->send(new SendMail($data));
        return back()->with('success', 'Message has been sent');

        
    }
}
