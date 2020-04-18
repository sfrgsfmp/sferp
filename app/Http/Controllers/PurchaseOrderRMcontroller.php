<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;
use App\ItemGroup;
use App\Specification;
use App\Vendor;
use App\IndCity;
use App\BankAccount;
use App\Bank;
use App\KBM;
use App\KPH;
use App\TPK;
use App\Tax;
use App\PO;
use App\PO_detail;
use App\PO_condition;
use Illuminate\Support\Facades\Auth;
use App\Ipl;
use App\Quality;
use App\Species;
use App\Measurement;
use Indonesia;
use App\IndProv;
use App\Company;
use App\Certificate;
use App\currency;
use App\Sortimen;

class PurchaseOrderRMcontroller extends Controller
{
    public function index()
    {
        
    }

    public function show()
    {
        
        $datas = Departemen::all();
        return view('po_prm.show')->with(['datas'=> $datas, 'pos'=>PO::all()]);
    }

    public function create()
    {
        return view('po_prm.create')->with(['datas'=>Departemen::all(), 'itemgroup'=>ItemGroup::all(), 'specs'=>Specification::all(), 'vendors'=>Vendor::all(), 'ba'=>BankAccount::all(), 'taxs'=>Tax::all(), 'pos'=>PO::where('is_delete','0')->get(), 'pod'=>PO_detail::where('is_delete','0')->get(),'poc'=>PO_condition::where('is_delete','0')->get(),'quality'=>Quality::all(), 'species'=>Species::all(), 'measu'=>Measurement::all(), 'provinces'=>Indonesia::allProvinces(), 'company'=>Company::all(), 'certificate'=>Certificate::all(), 'kbm'=>KBM::all(), 'kph'=>KPH::all(), 'tpk'=>TPK::all(), 'ipl'=>Ipl::where(['status_approval'=>'3'])->get(), 'currency'=>currency::where('is_delete','0')->get(), 'sortimens'=>Sortimen::all() ]);
    }

    public function getKBM($id)
    {
        $provid = Vendor::where('id', $id)->pluck('province_id');
        $gett = KBM::where('province_id', $provid)->pluck('name_kbm', 'id');

        return json_encode($gett);
       
    }

    public function selectipl($id)
    {
        $ipl = Ipl::where(['id'=>$id, 'status_approval'=>'3'])->pluck('noipl');
        $species_id = Ipl::where(['id'=>$id, 'status_approval'=>'3'])->pluck('species_id');
        $species = Species::where('id',$species_id)->pluck('name');


        
        return json_encode(array($id, $ipl, $species, $species_id));
    }

    public function get($id)
    {
        
        $vendor = Vendor::find($id);
        $nmvendor = $vendor->name_vendor;
        $address = $vendor->address;

        $city = $vendor->city_id;
        $cty = IndCity::find($city);
        $name_city = $cty->name;
        
        $bankaccount = $vendor->bankaccount_id;
        $an = BankAccount::find($bankaccount);
        $accountname = $an->accountname;
        
        $accountno = $an->accountno;
        $bankid = $an->bank_id;
        $bank = Bank::find($bankid);
        $bankname = $bank->namebank;

        $type = $vendor->type_vendor;

        return json_encode(array($nmvendor, $address, $name_city, $bankname, $accountno, $accountname, $type));
        
        
    }

    public function getaccount($id)
    {
        $bank_id = BankAccount::where('id', $id)->pluck('bank_id');
        $banks = Bank::where('id', $bank_id)->pluck('namebank');
        $accountnos = BankAccount::where('id', $id)->pluck('accountno');
        $accountnames = BankAccount::where('id', $id)->pluck('accountname');
        return json_encode(array($banks, $accountnos, $accountnames));
    }


    public function getpo($id)
    {
        $code_po = PO::where('id', $id)->pluck('code');

        $totalitem = PO_detail::where(['code_po'=>$code_po,'is_delete'=>'0'])->count();
        $totalm3 = PO_detail::where(['code_po'=>$code_po,'is_delete'=>'0'])->sum('m3');
        $totalprice = PO_detail::where(['code_po'=>$code_po,'is_delete'=>'0'])->sum('totalprice_det');

        $dia_allowence = PO::where('id', $id)->pluck('dia_allowence');
        $hei_allowence = PO::where('id', $id)->pluck('hei_allowence');
        $wid_allowence = PO::where('id', $id)->pluck('wid_allowence');
        $leng_allowence = PO::where('id', $id)->pluck('leng_allowence');
        $detailnote = PO::where('id', $id)->pluck('detailnote');

        $species_id = PO::where(['id'=>$id])->pluck('speciess');
        $speciesname = Species::where('id',$species_id)->pluck('name');

        return json_encode(array($code_po, $totalm3, $totalitem, $totalprice, $dia_allowence,$hei_allowence, $wid_allowence, $leng_allowence, $detailnote, $species_id, $speciesname ));
    }

    

    public function getbeneficiary($id)
    {
        $name_beneficiary = Company::where('code', $id)->pluck('name');
        $address_beneficiary = Company::where('code', $id)->pluck('address');
        $contactperson_beneficiary = Company::where('code', $id)->pluck('contact_person');
        
        $code_beneficiary = Company::where('code', $id)->pluck('code');
        $id_division_beneficiary = Company::where('code', $id)->pluck('id');

        $province_beneficiary_id = Company::where('code', $id)->pluck('province_id');
        $name_province = IndProv::where('id', $province_beneficiary_id)->pluck('name');

        $city_beneficiary_id = Company::where('code', $id)->pluck('city_id');
        $name_city = IndCity::where('id', $city_beneficiary_id)->pluck('name');

        return json_encode(array($name_beneficiary, $address_beneficiary, $contactperson_beneficiary, $code_beneficiary, $province_beneficiary_id, $name_province, $city_beneficiary_id, $name_city, $id_division_beneficiary));
    }

    public function storeGeneral(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'ipl' => ['required'],

            'startcontract' => ['required','date'],
            'expiredcontract' => ['required','date'],
            'status' => ['required'],
            'itemgroup_id' => ['required'],
            'spec_id' => ['required'],
            'speciess' => ['required'],
            'vendor_id' => ['required'],
            'paymentnote' => ['required'],
            'taxppn_id' => ['required'],
            'taxpph_id' => ['required'],
            'npwp' => ['required'],
            'currency'=> ['required'],
            'incoterms'=> ['nullable'],
            'transport' => ['required'],
            'certificate' => ['required'],
            'certnote' => ['required'],
            'volumenote' => ['required'],
            'qualitynote' => ['required'],
            'measurement' => ['required'],
            'document' => ['required'],
            'division_id' => ['required'],
            'division' => ['required'],
            // 'amended1' => ['required'],
            // 'amended2' => ['required'],
            // 'amended3' => ['required'],
            // 'code_beneficiary' => ['required'],
            // 'name_beneficiary' => ['required'],
            // 'address_beneficiary' => ['required'],
            // 'province_beneficiary' => ['required'],
            // 'city_beneficiary' => ['required'],
            // 'contactperson_beneficiary' => ['required'],
            
        ]);
        // dd($request->code);
        
        // dd($request->code_po);
        $request['created_by'] = Auth::user()->id;
        
        PO::create($request->all());
        // return redirect()->route('po.create')->with('success', 'Data has been created.');
        return back()->with('success', 'Data has been created.')->withInput($request->only('code'));
        
    }

    public function storeDetail(Request $request)
    {
        $request->validate([
            'code_id' => ['required'],
            // 'species' => ['required'],
            'spec1' => ['required'],
            'spec2' => ['required'],
            // // 'sortimen' => ['required'],
            // 'quality' => ['required'],
            // 'price' => ['required'],
            // 'charge' => ['required'],
            // 'discount' => ['required'],
            // 'totalprice_det' => ['required'],
            // 'komposisi_desc' => ['required'],
            // 'komposisipjg_desc' => ['required'],
            // 'cuttdia_min' => ['required'],
            // 'cuttdia_max' => ['required'],
            // 'invdia_min' => ['required'],
            // 'invdia_max' => ['required'],
            // 'cuttheight_min' => ['required'],
            // 'cuttheight_max' => ['required'],
            // 'invheight_min' => ['required'],
            // 'invheight_max' => ['required'],
            // 'cuttwidth_min' => ['required'],
            // 'cuttwidth_max' => ['required'],
            // 'invwidth_min' => ['required'],
            // 'invwidth_max' => ['required'],
            // 'cuttlength_min' => ['required'],
            // 'cuttlength_max' => ['required'],
            // 'invlength_min' => ['required'],
            // 'invlength_max' => ['required'],
            // 'm3' => ['required'],
            // 'mutukayu_desc' => ['required'],
            // 'statuskayu_desc' => ['required'],
            // 'dia_allowence' => ['required'],
            // 'hei_allowence' => ['required'],
            // 'wid_allowence' => ['required'],
            // 'leng_allowence' => ['required'],
            // 'detailnote' => ['required'],
            // 'sellunit' => ['required'],
            // 'teres' => ['required'],
        ]);

        $det = new PO_detail();
        $det->code_po = $request->get('code_id');
        $det->species_id = $request->get('species_id');
        $det->spec1_id = $request->get('spec1');
        $det->spec2_id = $request->get('spec2');
        $det->sortimen = $request->get('sortimen');
        $det->quality_id = $request->get('quality');
        $det->price = $request->get('price');
        $det->charge = $request->get('charge');
        $det->discount = $request->get('discount');
        $det->totalprice_det = $request->get('totalprice_det');
        // $det->komposisi_desc = $request->get('totalprice');
        $det->komposisi_desc = $request->get('komposisi_desc');
        $det->komposisipjg_desc = $request->get('komposisipjg_desc');
        $det->cuttdia_min = $request->get('cuttdia_min');
        $det->cuttdia_max = $request->get('cuttdia_max');
        $det->invdia_min = $request->get('invdia_min');
        $det->invdia_max = $request->get('invdia_max');
        $det->cuttheight_min = $request->get('cuttheight_min');
        $det->cuttheight_max = $request->get('cuttheight_max');
        $det->invheight_min = $request->get('invheight_min');
        $det->invheight_max = $request->get('invheight_max');
        $det->cuttwidth_min = $request->get('cuttwidth_min');
        $det->cuttwidth_max = $request->get('cuttwidth_max');
        $det->invwidth_min = $request->get('invwidth_min');
        $det->invwidth_max = $request->get('invwidth_max');
        $det->cuttlength_min = $request->get('cuttlength_min');
        $det->cuttlength_max = $request->get('cuttlength_max');
        $det->invlength_min = $request->get('invlength_min');
        $det->invlength_max = $request->get('invlength_max');
        $det->m3 = $request->get('m3');
        $det->mutukayu_desc = $request->get('mutukayu_desc');
        $det->statuskayu_desc = $request->get('statuskayu_desc');
        $det->save();

        
        $p = PO::where('code',$request->get('code_id'))->get();
        
        foreach($p as $p)
        {
            $po = PO::find($p->id);
            $po->dia_allowence = $request->get('dia_allowence');
            $po->hei_allowence = $request->get('hei_allowence');
            $po->wid_allowence = $request->get('wid_allowence');
            $po->leng_allowence = $request->get('leng_allowence');
            $po->detailnote = $request->get('detailnote');
            $po->sellunit = $request->get('sellunit');
            $po->teres = $request->get('teres');
            $po->save();
        }
       

        return redirect()->to('po/detail')->with('success', 'Data has been created.');
        // try{
        //     return redirect()->to('po/detail')->with('success', 'Data has been created.');
        // }
        // catch(\Illuminate\Database\QueryException $e)
        // {
        //     $errorCode = $e->errorInfo[1];
        //     if($errorCode == '1062')
        //     {
        //         // return back()->with('warning', 'Duplicate entry.');
        //         return redirect()->to('po#po_detail')->with('warning', 'Error.');
        //     }
        // }

        // if ( $result_json['status'] == '200') {
        //     return redirect()->to('po/detail')->with('success', 'Data has been created.');
        // } else {
        //     // return Redirect::to('/account/'.$id.'/#hardware') ->with('error', $result_json['message']);
        //     return redirect()->to('po/detail#po_detail')->with('warning', 'Error.');
        // }
    }
    
    public function storeCondition(Request $request)
    {
        $request->validate([
            'codeid' => ['required'],
            'trucking' => ['required'],
            'unit_trucking' => ['required'],
            'sort_min' => ['required'],
            'sort_max' => ['required'],
            'dia_min' => ['required'],
            'dia_max' => ['required'],
            'length_min' => ['required'],
            'length_max' => ['required'],
            'M3_min' => ['required'],
            'M3_max' => ['required'],
            'dia_value_min' => ['required'],
            'dia_value_max' => ['required'],
            'length_value_min' => ['required'],
            'length_value_max' => ['required'],
            'value_type' => ['required'],
            'value' => ['required'],
        ]);

        $po = new PO_condition();
        $po->code_po = $request->get('codeid');
        $po->trucking = $request->get('trucking');
        $po->unit_trucking = $request->get('unit_trucking');
        $po->sort_min = $request->get('sort_min');
        $po->sort_max = $request->get('sort_max');
        $po->dia_min = $request->get('dia_min');
        $po->dia_max = $request->get('dia_max');
        $po->length_min = $request->get('length_min');
        $po->length_max = $request->get('length_max');
        $po->M3_min = $request->get('M3_min');
        $po->M3_max = $request->get('M3_max');
        $po->dia_value_min = $request->get('dia_value_min');
        $po->dia_value_max = $request->get('dia_value_max');
        $po->length_value_min = $request->get('length_value_min');
        $po->length_value_max = $request->get('length_value_max');
        $po->value_type = $request->get('value_type');
        $po->value = $request->get('value');
        $po->save();

        return redirect()->to('po/condition')->with('success', 'Data has been created.');
    }

    public function editGeneral($id)
    {
        $code = PO::where('id', $id)->pluck('code');
        $p = PO::find($id);
        // $div = $p->division_id;
        //get_beneficiary
        $division = PO::where('id', $id)->pluck('division_id');
        // dd($division);
        // $name_beneficiary = Company::where('code', $division)->pluck('name');
        $address_beneficiary = Company::where('id', $division)->pluck('address');
        $contactperson_beneficiary = Company::where('id', $division)->pluck('contact_person');
        
        $code_beneficiary = Company::where('id', $division)->pluck('code');
        $id_division_beneficiary = Company::where('id', $division)->pluck('id');

        $province_beneficiary_id = Company::where('id', $division)->pluck('province_id');
        $name_province = IndProv::where('id', $province_beneficiary_id)->pluck('name');

        $city_beneficiary_id = Company::where('id', $division)->pluck('city_id');
        $name_city = IndCity::where('id', $city_beneficiary_id)->pluck('name');
        
        //get_vendor
        $vendor_id = PO::where('id', $id)->pluck('vendor_id');
        // dd($vendor_id);
        $nmvendor = Vendor::where('id', $vendor_id)->pluck('name_vendor');
        $address = Vendor::where('id', $vendor_id)->pluck('address');
        
        $getcity = Vendor::where('id', $vendor_id)->pluck('city_id');
        $city = IndCity::where('id', $getcity)->pluck('name');

        $paymentid = Vendor::where('id', $vendor_id)->pluck('bankaccount_id');
        
        $bankid = BankAccount::where('id', $paymentid)->pluck('bank_id');
        
        $accountname = BankAccount::where('id', $paymentid)->pluck('accountname');
        $accountno = BankAccount::where('id', $paymentid)->pluck('accountno');
        
        $bank = Bank::where('id', $bankid)->pluck('namebank');
        // dd($bank);
        $type = Vendor::where('id', $vendor_id)->pluck('type_vendor');
        // $kph_id = Vendor::where('id', $vendor_id)->pluck('kph_id');
        // $name_kph = KPH::where('id', $kph_id)->pluck('name_kph');

        // return json_encode(array($nmvendor, $address, $city, $bank, $accountno, $accountname, $type, $name_kph));
        

        return view('po_prm.edit')->with([
            'datas'=>Departemen::all(), 'itemgroup'=>ItemGroup::all(), 'specs'=>Specification::all(), 'vendors'=>Vendor::all(), 'ba'=>BankAccount::all(), 'taxs'=>Tax::all(), 'pos'=>PO::where('is_delete','0')->get(), 'po'=>PO::find($id),'pod'=>PO_detail::where(['is_delete'=>'0', 'code_po'=>$code])->get(),'pog'=>PO::all(), 'poc'=>PO_condition::where(['is_delete'=>'0', 'code_po'=>$code])->get(),'quality'=>Quality::all(), 'species'=>Species::all(), 'measu'=>Measurement::all(), 'provinces'=>Indonesia::allProvinces(), 'city'=>IndCity::all(), 'company'=>Company::all(), 'certificate'=>Certificate::all(),
            // 'name_beneficiary'=>$division,
            'address_beneficiary'=>$address_beneficiary, 'contactperson_beneficiary'=>$contactperson_beneficiary, 'code_beneficiary'=>$code_beneficiary, 'province_beneficiary_id'=>$province_beneficiary_id, 'name_province'=>$name_province, 'city_beneficiary_id'=>$city_beneficiary_id, 'name_city'=>$name_city, 'name_vendor'=>$nmvendor, 'address_vendor'=>$address, 'city_vendor'=>$city,  
            'paymentid'=>$paymentid,
            'name_bank'=>$bank,
            'accountno'=>$accountno,
            'accountname'=>$accountname,
            'tpk'=>TPK::all(), 'kph'=>KPH::all(), 'kbm'=>KBM::all(),
            'ipl'=>Ipl::where(['status_approval'=>'3'])->get(),
            'currency'=>currency::where('is_delete','0')->get()
            
        ]);
        
    }

    public function updateGeneral(Request $request, $id)
    {
        $po = PO::find($id);

        $request->validate([
            'code' => ['required'],
            'ipl' => ['required'],
            'startcontract' => ['required','date'],
            'expiredcontract' => ['required','date'],
            'status' => ['required'],
            'itemgroup_id' => ['required'],
            'spec_id' => ['required'],
            'speciess' => ['required'],
            'vendor_id' => ['required'],
            // 'paymentnote' => ['required'],
            'taxppn_id' => ['required'],
            'taxpph_id' => ['required'],
            'npwp' => ['required'],
            'currency' => ['required'],
            'transport' => ['required'],
            'certificate' => ['required'],
            'certnote' => ['required'],
            'volumenote' => ['required'],
            'qualitynote' => ['required'],
            'measurement' => ['required'],
            'document' => ['required'],
            'division_id' => ['required'],
            'division' => ['required'],
            // 'amended1' => ['required'],
            // 'amended2' => ['required'],
            // 'amended3' => ['required'],
        ]);

        $po->code = $request->get('code');
        $po->ipl = $request->get('ipl');
        $po->speciess = $request->get('speciess');

        $po->startcontract  = $request->get('startcontract');
        $po->expiredcontract  = $request->get('expiredcontract');
        $po->status  = $request->get('status');
        $po->itemgroup_id  = $request->get('itemgroup_id');
        $po->spec_id  = $request->get('spec_id');
        $po->vendor_id  = $request->get('vendor_id');
        $po->paymentnote  = $request->get('paymentnote');
        $po->taxppn_id  = $request->get('taxppn_id');
        $po->taxpph_id  = $request->get('taxpph_id');
        $po->npwp  = $request->get('npwp');
        $po->currency = $request->get('currency');
        $po->incoterms = $request->get('incoterms');
        $po->transport  = $request->get('transport');
        $po->certificate  = $request->get('certificate');
        $po->certnote  = $request->get('certnote');
        $po->volumenote  = $request->get('volumenote');
        $po->qualitynote  = $request->get('qualitynote');
        $po->measurement  = $request->get('measurement');
        $po->document = $request->get('document');
        $po->division_id  = $request->get('division_id');
        $po->division  = $request->get('division');
        $po->amended1 = $request->get('amended1');
        $po->amended2 = $request->get('amended2');
        $po->amended3 = $request->get('amended3');
        $po->save();

        return back()->with('success', 'Data has been updated.');
    }

    public function deleteGeneral($id)
    {
        $idg = PO::find($id);
        $idg->is_delete = '1';
        $idg->save();

        $idd = PO_detail::where('code_po',$idg->code)->get();
        foreach($idd as $idd)
        {
            $idd->is_delete = '1';
            $idd->save();
        }

        $idc = PO_condition::where('code_po',$idg->code)->get();
        foreach($idc as $idc)
        {
            $idc->is_delete = '1';
            $idc->save();
        }

        // return json_encode(array($idGeneral, $c, $d));
        return back()->with('success', 'Data has been delete.');
    }

    public function editDetail($id)
    {
        $code_po = PO_detail::where('id', $id)->pluck('code_po');
        $id_po_general = PO::where('code', $code_po)->pluck('id');
        
        //get totalprice/item
        
        $totalitem = PO_detail::where(['code_po'=>$code_po,'is_delete'=>'0'])->count();
        $totalm3 = PO_detail::where(['code_po'=>$code_po,'is_delete'=>'0'])->sum('m3');
        $totalprice = PO_detail::where(['code_po'=>$code_po,'is_delete'=>'0'])->sum('totalprice_det');


        //get_beneficiary
        $division = PO::where('id', $id_po_general)->pluck('division');
        $name_beneficiary = Company::where('code', $division)->pluck('name');
        $address_beneficiary = Company::where('code', $division)->pluck('address');
        $contactperson_beneficiary = Company::where('code', $division)->pluck('contact_person');
        
        $code_beneficiary = Company::where('code', $division)->pluck('code');
        $id_division_beneficiary = Company::where('code', $division)->pluck('id');

        $province_beneficiary_id = Company::where('code', $division)->pluck('province_id');
        $name_province = IndProv::where('id', $province_beneficiary_id)->pluck('name');

        $city_beneficiary_id = Company::where('code', $division)->pluck('city_id');
        $name_city = IndCity::where('id', $city_beneficiary_id)->pluck('name');
        
        // //get_vendor
        // $vendor_id = PO::where('id', $id_po_general)->pluck('vendor_id');
        // $nmvendor = Vendor::where('id', $vendor_id)->pluck('name_vendor');
        // $address = Vendor::where('id', $vendor_id)->pluck('address');
        
        // $getcity = Vendor::where('id', $vendor_id)->pluck('city_id');
        // $city = IndCity::where('id', $getcity)->pluck('name');

        // $paymentid = Vendor::where('id', $vendor_id)->pluck('bankaccount_id');
        // $accountname = BankAccount::where('id', $paymentid)->pluck('accountname');
        // $accountno = BankAccount::where('id', $paymentid)->pluck('accountno');
        // $bank_id = BankAccount::where('id', $paymentid)->pluck('bank_id');
        // $bank = Bank::where('id', $bank_id)->pluck('namebank');
        
        // $type = Vendor::where('id', $vendor_id)->pluck('type_vendor');
        // $kph_id = Vendor::where('id', $vendor_id)->pluck('kph_id');
        // $name_kph = KPH::where('id', $kph_id)->pluck('name_kph');

        return view('po_prm.editDetail')->with([
            'datas'=>Departemen::all(),
            'itemgroup'=>ItemGroup::all(),
            'specs'=>Specification::all(),
            'vendors'=>Vendor::all(),
            'ba'=>BankAccount::all(),
            'taxs'=>Tax::all(),
            'po'=>PO::find($id_po_general),
            'pos'=>PO::where(['is_delete'=>'0', 'code'=>$code_po])->get(),
            'pog'=>PO::all(),
            'totalitem'=>$totalitem,
            'totalprice'=>$totalprice,
            'totalm3'=>$totalm3,
            // 'po_g'=>$po_g,
            // 'pog'=>PO::where('code', $code_po)->get(),
            'pod'=>PO_detail::where(['is_delete'=>'0'])->get(),
            'pods'=>PO_detail::find($id),
            'poc'=>PO_condition::where(['is_delete'=>'0', 'code_po'=>$code_po])->get(),
            'quality'=>Quality::all(),
            'species'=>Species::all(),
            'measu'=>Measurement::all(),
            'provinces'=>Indonesia::allProvinces(),
            'city'=>IndCity::all(),
            'company'=>Company::all(),
            'certificate'=>Certificate::all(),
            'name_beneficiary'=>$name_beneficiary,
            'address_beneficiary'=>$address_beneficiary, 'contactperson_beneficiary'=>$contactperson_beneficiary,
            'code_beneficiary'=>$code_beneficiary,
            'province_beneficiary_id'=>$province_beneficiary_id,
            'name_province'=>$name_province,
            'city_beneficiary_id'=>$city_beneficiary_id,
            'name_city'=>$name_city,
            // 'name_vendor'=>$nmvendor,
            // 'address_vendor'=>$address,
            // 'city_vendor'=>$city,
            // 'paymentid'=>$paymentid,
            // 'name_bank'=>$bank,
            // 'accountno'=>$accountno,
            // 'accountname'=>$accountname
            'tpk'=>TPK::all(), 'kph'=>KPH::all(), 'kbm'=>KBM::all(), 'currency'=>currency::where('is_delete','0')->get()
        ]);
    }
    public function updateDetail(Request $request, $id)
    {
        
        $request->validate([
            'code_id' => ['required'],
            // 'species' => ['required'],
            'spec1' => ['required'],
            'spec2' => ['required'],
            // // 'sortimen' => ['required'],
            // 'quality' => ['required'],
            // 'price' => ['required'],
            // 'charge' => ['required'],
            // 'discount' => ['required'],
            // 'totalprice_det' => ['required'],
            // 'komposisi_desc' => ['required'],
            // 'komposisipjg_desc' => ['required'],
            // 'cuttdia_min' => ['required'],
            // 'cuttdia_max' => ['required'],
            // 'invdia_min' => ['required'],
            // 'invdia_max' => ['required'],
            // 'cuttheight_min' => ['required'],
            // 'cuttheight_max' => ['required'],
            // 'invheight_min' => ['required'],
            // 'invheight_max' => ['required'],
            // 'cuttwidth_min' => ['required'],
            // 'cuttwidth_max' => ['required'],
            // 'invwidth_min' => ['required'],
            // 'invwidth_max' => ['required'],
            // 'cuttlength_min' => ['required'],
            // 'cuttlength_max' => ['required'],
            // 'invlength_min' => ['required'],
            // 'invlength_max' => ['required'],
            // 'm3' => ['required'],
            // 'mutukayu_desc' => ['required'],
            // 'statuskayu_desc' => ['required'],
            
        ]);

        $det = PO_detail::find($id);
        $det->code_po = $request->get('code_id');
        $det->species_id = $request->get('species');
        $det->spec1_id = $request->get('spec1');
        $det->spec2_id = $request->get('spec2');
        $det->sortimen = $request->get('sortimen');
        $det->quality_id = $request->get('quality');
        $det->price = $request->get('price');
        $det->charge = $request->get('charge');
        $det->discount = $request->get('discount');
        $det->totalprice_det = $request->get('totalprice_det');
        $det->komposisi_desc = $request->get('komposisi_desc');
        $det->komposisipjg_desc = $request->get('komposisipjg_desc');
        $det->cuttdia_min = $request->get('cuttdia_min');
        $det->cuttdia_max = $request->get('cuttdia_max');
        $det->invdia_min = $request->get('invdia_min');
        $det->invdia_max = $request->get('invdia_max');
        $det->cuttheight_min = $request->get('cuttheight_min');
        $det->cuttheight_max = $request->get('cuttheight_max');
        $det->invheight_min = $request->get('invheight_min');
        $det->invheight_max = $request->get('invheight_max');
        $det->cuttwidth_min = $request->get('cuttwidth_min');
        $det->cuttwidth_max = $request->get('cuttwidth_max');
        $det->invwidth_min = $request->get('invwidth_min');
        $det->invwidth_max = $request->get('invwidth_max');
        $det->cuttlength_min = $request->get('cuttlength_min');
        $det->cuttlength_max = $request->get('cuttlength_max');
        $det->invlength_min = $request->get('invlength_min');
        $det->invlength_max = $request->get('invlength_max');
        $det->m3 = $request->get('m3');
        $det->mutukayu_desc = $request->get('mutukayu_desc');
        $det->statuskayu_desc = $request->get('statuskayu_desc');
        $det->save();

        
        $p = PO::where('code',$request->get('code_id'))->get();
        
        foreach($p as $p)
        {
            $po = PO::find($p->id);
            $po->dia_allowence = $request->get('dia_allowence');
            $po->hei_allowence = $request->get('hei_allowence');
            $po->wid_allowence = $request->get('wid_allowence');
            $po->leng_allowence = $request->get('leng_allowence');
            $po->detailnote = $request->get('detailnote');
            $po->sellunit = $request->get('sellunit');
            $po->teres = $request->get('teres');
            $po->save();
        }
       

        return back()->with('success', 'Data has been updated.');
    }

    public function deleteDetail($id)
    {
        $pod = PO_detail::find($id);
        $pod->update(['is_delete'=> '1']);
        return back()->with('success', 'Data has been delete.');
    }

    public function editCondition($id)
    {
        $po_c = PO_condition::where('id', $id)->pluck('code_po');

        return view('po_prm.editCondition')->with([
            'datas'=>Departemen::all(),
            'itemgroup'=>ItemGroup::all(),
            'specs'=>Specification::all(),
            'vendors'=>Vendor::all(),
            'ba'=>BankAccount::all(),
            'taxs'=>Tax::all(),
            // 'po'=>PO::find($id_po_general),
            'pos'=>PO::where(['is_delete'=>'0', 'code'=>$po_c])->get(),
            // 'pog'=>PO::all(),
            
            'pod'=>PO_detail::where(['is_delete'=>'0', 'code_po'=>$po_c])->get(),
            // 'pods'=>PO_detail::find($id),
            'poc'=>PO_condition::where(['is_delete'=>'0'])->get(),
            'pocs'=>PO_condition::find($id),
            'quality'=>Quality::all(),
            'species'=>Species::all(),
            'measu'=>Measurement::all(),
            'provinces'=>Indonesia::allProvinces(),
            'city'=>IndCity::all(),
            'company'=>Company::all(),
            'certificate'=>Certificate::all(),
            'tpk'=>TPK::all(), 'kph'=>KPH::all(), 'kbm'=>KBM::all(), 'currency'=>currency::where('is_delete','0')->get()
            
        ]);
    }

    public function updateCondition(Request $request, $id)
    {
        $request->validate([
            'codeid' => ['required'],
            'trucking' => ['required'],
            'unit_trucking' => ['required'],
            'sort_min' => ['required'],
            'sort_max' => ['required'],
            'dia_min' => ['required'],
            'dia_max' => ['required'],
            'length_min' => ['required'],
            'length_max' => ['required'],
            'M3_min' => ['required'],
            'M3_max' => ['required'],
            'dia_value_min' => ['required'],
            'dia_value_max' => ['required'],
            'length_value_min' => ['required'],
            'length_value_max' => ['required'],
            'value_type' => ['required'],
            'value' => ['required'],
        ]);

        $po = PO_condition::find($id);
        $po->code_po = $request->get('codeid');
        $po->trucking = $request->get('trucking');
        $po->unit_trucking = $request->get('unit_trucking');
        $po->sort_min = $request->get('sort_min');
        $po->sort_max = $request->get('sort_max');
        $po->dia_min = $request->get('dia_min');
        $po->dia_max = $request->get('dia_max');
        $po->length_min = $request->get('length_min');
        $po->length_max = $request->get('length_max');
        $po->M3_min = $request->get('M3_min');
        $po->M3_max = $request->get('M3_max');
        $po->dia_value_min = $request->get('dia_value_min');
        $po->dia_value_max = $request->get('dia_value_max');
        $po->length_value_min = $request->get('length_value_min');
        $po->length_value_max = $request->get('length_value_max');
        $po->value_type = $request->get('value_type');
        $po->value = $request->get('value');
        $po->save();

        return back()->with('success', 'Data has been updated.');
    }

    public function deleteCondition($id)
    {
        $poc = PO_condition::find($id);
        $poc->update(['is_delete'=> '1']);
        return back()->with('success', 'Data has been delete.');
    }
}
