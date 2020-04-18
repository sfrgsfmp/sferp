<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PIM extends Model
{
    protected $table = 'pim';
    protected $fillable = ['id','code_pim','pimno','division','itemgroup_id','applydate','objective','process','warehouse_id','carasusun','soplangkah','po_reference','noprocurement', 'noparcel','vendor_id','kbm_id','kph_id','tpk_id','ftebal','flebar','fpanjang','sortimen','spec2_id', 'specs', 'contractor_id','informasilain','note','type_transport_id','notransport','desc','typem3','estdocm3','whbongkar','whstapel','starttime','endtime','headcount','date','date','spb','datesupplierpayment', 'totalqty','totalm3','totalinvprice','desc_sup','workshift','rateused','handling','code_expeditionpayment','paydate_expeditionpayment','price_expeditionpayment','code_freightpayment','emkl','paydate_freightpayment','conttype','price_freightpayment','grading_expenses','biayalelang','retribusi','biayalansir','fee','is_delete'];

    public function po()
    {
        return $this->hasMany('App\PO', 'id', 'po_reference');
    }

    public function vehicle()
    {
        return $this->hasMany('App\Vehicle', 'id', 'type_transport_id');
    }

    public function vendor()
    {
        return $this->hasMany('App\Vendor', 'id', 'vendor_id');
    }

    public function contractor()
    {
        return $this->hasMany('App\Vendor', 'id', 'contractor_id');
    }

    public function kbm()
    {
        return $this->hasMany('App\KBM', 'id', 'kbm_id');
    }
    
    public function kph()
    {
        return $this->hasMany('App\KPH', 'id', 'kph_id');
    }

    public function tpk()
    {
        return $this->hasMany('App\TPK', 'id', 'tpk_id');
    }

    public function warehouse()
    {
        return $this->hasMany('App\Warehouse', 'id', 'warehouse_id');
    }

    public function tandaterima()
    {
        return $this->belongsTo('App\TT', 'id', 'pimid');
    }

    public function receiptlogandtt()
    {
        return $this->hasManyThrough('App\ReceiptLog', 'App\TT', 'pimid', 'pimid', 'id', 'id');
    }
}
