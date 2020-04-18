<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndCity extends Model
{
    protected $table = 'indonesia_cities';

    protected $fillable = ['id', 'province_id', 'name', 'meta'];


    public function province()
    {
        return $this->belongsTo('App\IndProv', 'province_id', 'id');
    }

    
}
