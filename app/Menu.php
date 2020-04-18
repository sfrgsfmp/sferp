<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    
    protected $table = 'menu';
    protected $fillable = ['id_menu', 'menu_name', 'link_menu', 'id_dept'];

    public function departemen()
    {
        return $this->belongsTo('App\Departemen', 'id_dept', 'id_dept');
    }

    public function submenu()
    {
        return $this->hasMany('App\Submenu', 'id_menu', 'id_menu');
    }

}
