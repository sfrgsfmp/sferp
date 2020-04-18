<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class objective extends Model
{
    protected $table = 'objective';
    protected $fillable = ['id','objective_code','objective_name','create_at','update_at','is_delete', ];

    public function warehouse()
    {
        return $this->hasMany('App\warehouse');
    }

    public function hasAnyWarehouse($warehouse)
    {
        return null !== $this->warehouse()->where('warehouse_name', $warehouse)->first();
    }

}