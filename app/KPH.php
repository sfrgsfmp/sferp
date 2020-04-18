<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KPH extends Model
{
    protected $table = 'kph';
    protected $fillable = ['id', 'kbm_id', 'name_kph', 'kphtype_id'];

    public function kbm()
    {
        return $this->belongsTo('App\KBM');
    }

    public function vendor()
    {
        return $this->hasMany('App\Vendor');
    }

    public function tpk()
    {
        return $this->belongsTo('App\TPK', 'id', 'id');
    }

    public function kphtype()
    {
        return $this->hasOne('App\kphtype', 'id', 'kphtype_id');
    }
}
