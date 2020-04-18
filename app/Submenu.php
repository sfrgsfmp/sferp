<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $table = 'submenu';
    protected $fillable = ['id','submenu','link_menu','id_menu'];

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'id_menu', 'id_menu');
    }
}
