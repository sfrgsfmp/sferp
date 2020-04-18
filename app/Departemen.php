<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    //
    protected $table = 'departemen';
    protected $fillable = ['id_dept', 'name_dept', 'hod'];

    public function menu()
    {
        return $this->hasMany('App\Menu', 'id_dept', 'id_dept');
    }
}
