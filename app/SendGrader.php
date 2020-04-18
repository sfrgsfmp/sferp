<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendGrader extends Model
{
    protected $table = 'sendgrader';
    protected $fillable = ['id','noipl','grader_id','keperluan','location_id', 'kbm_id', 'kph_id', 'tpk_id', 'uang_dinas','start_date', 'end_date', 'bank', 'rekening', 'surat_perintah'];

    public function users()
    {
        return $this->hasOne('App\User', 'id', 'grader_id');
    }
    

    public function vendors()
    {
        return $this->hasMany('App\Vendor', 'id', 'location_id');
    }

    public function kbm()
    {
        return $this->hasMany('App\KBM', 'id', 'kbm_id');
    }
    public function kph()
    {
        return $this->hasMany('App\KPH', 'id', 'kph_id');
    }
    public function tpk()
    {
        return $this->hasMany('App\TPK', 'id', 'tpk_id');
    }

    public function ipl()
    {
        return $this->hasMany('App\Ipl', 'noipl', 'noipl');
    }
    
    public function results()
    {
        return $this->hasMany('App\GradingResult', 'id', 'sendgrader_id');
    }
}
