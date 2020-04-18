<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    protected $table = 'karyawans';
    protected $fillable = ['id', 'namakaryawan', 'alamat', 'notlp'];
}
