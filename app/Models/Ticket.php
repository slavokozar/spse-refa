<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = ['area_id', 'pc', 'user_id'];


    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area');
    }


    public function failures(){
        return $this->belongsToMany('App\Models\Failure');
    }

    public function statuses(){
        return $this->hasMany('App\Models\TicketStatus');
    }

    public function status(){
        return $this->statuses()->orderBy('created_at', 'desc')->limit(1);
    }
}
