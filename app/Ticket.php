<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = ['area_id', 'pc', 'user_id'];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function area(){
        return $this->belongsTo('App\Area');
    }


    public function failures(){
        return $this->belongsToMany('App\Failure');
    }

    public function status(){
        return $this->statuses()->get()->last();
    }

    public function statuses(){
        return $this->hasMany('App\TicketStatus');
    }


}
