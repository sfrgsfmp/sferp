<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    protected $table = 'po_transaction';
    protected $fillable = ['id','ipl','speciess','code','amended1','amended2','amended3','startcontract','expiredcontract','status','itemgroup_id','spec_id', 'vendor_id', 'paymentnote', 'taxppn_id', 'taxpph_id', 'npwp','currency', 'incoterms', 'transport', 'certificate', 'certnote', 'volumenote', 'qualitynote', 'measurement', 'document', 'division_id','division', 'dia_allowence', 'hei_allowence', 'wid_allowence', 'leng_allowence', 'detailnote', 'sellunit', 'teres', 'created_by', 'is_delete'];

    public function users()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function measu()
    {
        return $this->hasOne('App\Measurement', 'id', 'sellunit');
    }

    public function certificate()
    {
        return $this->hasOne('App\Certificate', 'id', 'certificate');
    }

    public function itemgroup()
    {
        return $this->hasOne('App\Itemgroup', 'id', 'itemgroup_id');
    }

    public function specification()
    {
        return $this->hasOne('App\Specification', 'id', 'spec_id');
    }

    public function currency()
    {
        return $this->hasOne('App\currency', 'id', 'currency');
    }

    public function ipl()
    {
        return $this->hasMany('App\Ipl', 'id', 'ipl');
    }

    public function species()
    {
        return $this->hasMany('App\Species', 'id', 'speciess');
    }

    public function taxppn()
    {
        return $this->hasMany('App\Tax', 'id', 'taxppn_id');
    }
    public function taxpph()
    {
        return $this->hasMany('App\Tax', 'id', 'taxpph_id');
    }

    public function vendors()
    {
        return $this->hasMany('App\Vendor', 'id', 'vendor_id');
    }

    public function podetail()
    {
        return $this->hasMany('App\PO_detail', 'code_po', 'code');
    }

    public function pocondition()
    {
        return $this->hasMany('App\PO_condition', 'code_po', 'code');
    }

}
