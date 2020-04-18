<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ipl extends Model
{
    protected $table = 'ipl';

    protected $fillable = ['id', 'noipl', 'transaction_date', 'vendor_id', 'species_id', 'sortimen', 'diameter_from', 'diameter_to', 'uom_diameter', 'length_from', 'length_to', 'uom_length', 'width_from', 'width_to', 'uom_width', 'thick_from', 'thick_to', 'uom_thick', 'status', 'quality', 'kwt', 'wood_drying', 'schema', 'volume', 'uom_volume', 'approvalto_id', 'status_approval', 'createdby_id', 'send_approval'];

    public function approvalto()
    {
        return $this->hasMany('App\User', 'id', 'approvalto_id');
    }

    public function createdby()
    {
        return $this->hasMany('App\User', 'id', 'createdby_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

    public function species()
    {
        return $this->belongsTo('App\Species');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'approvalto_id', 'id');
    }

    
}
