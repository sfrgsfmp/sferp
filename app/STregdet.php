<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class STregdet extends Model
{
    protected $table = 'sawntimber_regdetail';
    protected $fillable = ['id','reg_id','code','pallet','height1','height2', 'width1', 'width2','allowence', 'lengthsm3', 'lengthpm3', 'qty'];

    public function st_reg()
    {
        return $this->hasMany('App\STreg', 'code', 'reg_id');
    }
}
