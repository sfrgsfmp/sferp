<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemgroup extends Model
{
    protected $table = 'itemgroup';
    protected $fillable = ['id','itemgroup_code','itemgroup_name','create_at','update_at','is_delete', ];

    public function itemgroup()
    {
        return $this->hasMany('App\itemgroup');
    }

    public function hasAnyItemGroup($itemgroup)
    {
        return null !== $this->itemgroup()->where('itemgroup_name', $itemgroup)->first();
    }

}