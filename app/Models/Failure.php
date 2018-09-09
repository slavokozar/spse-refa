<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Failure extends Model
{
    use SoftDeletes;

    protected $table = 'failures';

    protected $fillable = ['name'];

    public function tickets(){
        return $this->belongsToMany('App\Models\Ticket');
    }

}
