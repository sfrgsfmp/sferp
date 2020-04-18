<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    protected $table = 'species';
    protected $fillable = ['id','code','name','legend','autocode','spec','latinname'];

    public function ipl()
    {
        return $this->hasMany('App\Ipl');
    }
}
