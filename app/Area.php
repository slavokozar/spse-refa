<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['name','pc'];

    public function tickets(){
        return $this->hasMany('App\Ticket');
    }

    public function admins(){
        return $this->belongsToMany('App\User')->withPivot('level');

    }


}
