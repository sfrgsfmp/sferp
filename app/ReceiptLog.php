<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class ReceiptLog extends Model
{
    //receipt log //tab general
    protected $table = 'receiptlog';
    protected $fillable = ['id','code','pimid','status','itemgroup_id','division','applydate', 'from_warehouse', 'to_warehouse', 'objective', 'ppc', 'remarks', 'perni', 'fakb', 'unitsize', 'unitprice', 'is_delete', 'pph23', 'pph22', 'pph21','ppn', 'trucking', 'administration', 'lainlain', 'unit_trucking'];

    public function pph23()
    {
        return $this->hasMany('App\Tax', 'id', 'pph23');
    }
    public function pph22()
    {
        return $this->hasMany('App\Tax', 'id', 'pph22');
    }
    public function pph21()
    {
        return $this->hasMany('App\Tax', 'id', 'pph21');
    }
    public function ppn()
    {
        return $this->hasMany('App\Tax', 'id', 'ppn');
    }
    public function unitrucking()
    {
        return $this->hasMany('App\Measurement', 'id', 'unit_trucking');
    }

    public function pim()
    {
        // return $this->hasMany('App\PIM', 'id', 'pimid');

        // return $this->hasManyThrough(
        //     'App\Post',
        //     'App\User',
        //     'country_id', // Foreign key on users table...
        //     'user_id', // Foreign key on posts table...
        //     'id', // Local key on countries table...
        //     'id' // Local key on users table...
        // );

        return $this->hasManyThrough('App\PIM','App\TT','pimid', 'id', 'id', 'pimid');
    
    }

    public function pims()
    {
        return $this->hasMany('App\PIM', 'id', 'pimid');
    }


    public function scopereceiptlogandtts()
    {
        return $this->pim()->with('receiptlogandtt')->get();
    }

    public function scopett()
    {
        // return $this->pim()->belongsTo('tandaterima')->get();
        $tt = DB::table('receiptlog')
            ->join('pim', 'receiptlog.pimid', '=', 'pim.id')
            ->join('tandaterima', 'pim.id', '=', 'tandaterima.pimid')
            ->join('po_transaction', 'pim.po_reference', '=', 'po_transaction.id')
            ->join('species', 'po_transaction.speciess', '=', 'species.id')
            ->select('receiptlog.id','receiptlog.code','pim.code_pim','pim.pimno','tandaterima.code_tt', 'tandaterima.tt_no', 'tandaterima.no_document','pim.sortimen', 'pim.noparcel', 'species.name')
            ->get();
        return $tt;
    }

    // public function tandatrm()
    // {
    //     return $this->pim()->with('tandaterima')->get();
    //     // $ttt = PIM::with('tandaterima')->get();
    //     // return $ttt;
    // }

    public function remarks()
    {
        return $this->hasMany('App\Remarks', 'id', 'remarks');
    }

    public function measu()
    {
        return $this->hasMany('App\Measurement', 'id', 'unitsize');
    }

    public function measur()
    {
        return $this->hasMany('App\Measurement', 'id', 'unitprice');
    }

    public function itemgroup()
    {
        return $this->hasMany('App\Itemgroup', 'id', 'itemgroup_id');
    }
    public function objective()
    {
        return $this->hasMany('App\Objective', 'id', 'objective');
    }

    public function warehouseFrom()
    {
        return $this->hasMany('App\Warehouse', 'id', 'from_warehouse');
    }

    public function warehouseTo()
    {
        return $this->hasMany('App\Warehouse', 'id', 'to_warehouse');
    }
}
