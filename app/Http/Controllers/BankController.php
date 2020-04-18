<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\Bank;
use App\BankAccount;

class BankController extends Controller
{
    public function index()
    {
        return view('bank.index')->with(['datas'=>Departemen::all(), 'banks'=>Bank::all()]);
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'namebank' => ['required'],
        ]);
        $bank = Bank::find($id);
        $bank->update($request->all());
        return redirect()->route('master.bank.index')->with('success', 'Data has been updated.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namebank' => ['required'],
        ]);

        Bank::create($request->all());
        return redirect()->route('master.bank.index')->with('success', 'Data has been created.');
    }

    public function destroy($id)
    {
        $bank=Bank::find($id);
        $bank->delete();
        return redirect()->back()->with('success', 'Data has been delete.');
    }

    public function indexaccount()
    {
        return view('bank.account')->with(['datas'=>Departemen::all(), 'banks'=>BankAccount::all(), 'b'=>Bank::all() ]);
    }

    public function saveaccount(Request $request)
    {
        $request->validate([
            'bank_id' => ['required'],
            'accountname' => ['required'],
            'accountno'=> ['required'],
            // 'swiftcode'=> ['required'],
            'phone'=> ['required', 'numeric'],
            'address'=> ['required'],
        ]);
        BankAccount::create($request->all());
        return redirect()->back()->with('success', 'Data has been created.');
    }

    public function updateaccount(Request $request, $id)
    {
        $request->validate([
            'bank_id' => ['required'],
            'accountname' => ['required'],
            'accountno'=> ['required'],
            // 'swiftcode'=> ['required'],
            'phone'=> ['required', 'numeric'],
            'address'=> ['required'],
        ]);
        $b = BankAccount::find($id);
        $b->update($request->all());
        return redirect()->route('master.account.index')->with('success', 'Data has been updated.');
    }

    public function editaccount($id)
    {
        return view('bank.editaccount')->with(['datas'=>Departemen::all(), 'b'=>BankAccount::find($id), 'banks'=>BankAccount::all(), 'bb'=>Bank::all()]);
    }

    public function destroyaccount($id)
    {
        $bank=BankAccount::find($id);
        $bank->delete();
        return redirect()->back()->with('success', 'Data has been delete.');
    }

}
