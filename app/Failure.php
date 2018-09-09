<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Failure extends Model
{
    protected $table = 'failures';

    protected $fillable = ['name'];

    public function tickets(){
        return $this->belongsToMany('App\Ticket');
    }

}
