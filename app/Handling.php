<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class handling extends Model
{
    protected $table = 'handling';
    protected $fillable = ['id','code','name','group','tipe','is_status','id_section','id_measurement','id_currency','rate10','rate15','rate20','reference'];

    public function section()
    {
        return $this->belongsTo('App\section', 'id_section', 'id');
    }

    public function measurement()
    {
        return $this->belongsTo('App\measurement', 'id_measurement', 'id');
    }

    public function currency()
    {
        return $this->belongsTo('App\currency', 'id_currency', 'id');
    }
}
