<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KBM extends Model
{
    protected $table = 'kbm';
    protected $fillable = ['id', 'province_id','name_kbm'];

    public function kph()
    {
        return $this->hasMany('App\KPH');
    }

    public function province()
    {
        return $this->hasMany('App\IndProv', 'id', 'province_id');
    }

    // public function hasAnyKph($kph)
    // {
    //     return null !== $this->kph()->where('name_kph', $kph)->first();
    // }
}
