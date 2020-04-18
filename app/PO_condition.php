<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PO_condition extends Model
{
    protected $table = 'po_transactioncondition';
    protected $fillable = ['id','code_po','trucking','unit_trucking','sort_min','sort_max','dia_min', 'dia_max', 'length_min', 'length_max', 'M3_min', 'M3_max', 'dia_value_min', 'dia_value_max', 'length_value_min', 'length_value_max', 'value_type', 'value', 'is_delete'];

    public function po()
    {
        return $this->belongsTo('App\PO', 'code_po', 'code');
    }

    public function unitrucking()
    {
        return $this->hasOne('App\Measurement', 'id', 'unit_trucking');
    }
}
