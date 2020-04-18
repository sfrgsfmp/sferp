<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    protected $table = 'warehouse';
    protected $fillable = ['id','warehouse_code','warehouse_name','warehouse_group','warehouse_type','id_objective','warehouse_loc','warehouse_desc'];

    public function objective()
    {
        return $this->belongsTo('App\objective', 'id_objective', 'id');
    }
}
