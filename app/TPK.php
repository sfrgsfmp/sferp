<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPK extends Model
{
    //name_tpk
    protected $table = 'tpk';
    protected $fillable = ['id', 'name_tpk', 'kph_id'];

    public function kph()
    {
        return $this->hasMany('App\KPH', 'id', 'kph_id');
    }
}
