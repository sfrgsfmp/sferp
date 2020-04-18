<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuIT extends Model
{
    //
    protected $table = 'menu';
    protected $fillable = ['id_menu', 'menu_name', 'link_menu', 'id_dept'];

}
