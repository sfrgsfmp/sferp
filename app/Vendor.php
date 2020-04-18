<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendor';
    protected $fillable = ['id', 'name_vendor', 'address','province_id','city_id','postalcode','portofloading','phone','fax','email','website','bankaccount_id','type_vendor'];

    // public function GroupVendor()
    // {
    //     return $this->belongsTo('App\GroupVendor','type_vendor_id');
    // }

    public function province()
    {
        return $this->hasOne('App\IndProv', 'id', 'province_id');
    }

    // public function provinces()
    // {
    //     return $this->hasMany('App\KBM', 'province_id', 'province_id');
    // }

    public function city()
    {
        return $this->hasOne('App\IndCity', 'city_id');
    }

    public function bankaccount()
    {
        return $this->hasOne('App\BankAccount', 'id','bankaccount_id');
    }

    // public function kph()
    // {
    //     return $this->belongsTo('App\KPH');
    // }

    public function ipl()
    {
        return $this->hasMany('App\Ipl');
    }
}
