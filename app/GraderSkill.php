<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GraderSkill extends Model
{
    protected $table = 'grader_skill';

    protected $fillable = ['id', 'user_id', 'species_id', 'sortimen'];

    public function species()
    {
        return $this->belongsTo('App\Species');
    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id', 'id');
    }
}
