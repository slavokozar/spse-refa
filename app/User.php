<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function areas(){
        return $this->belongsToMany('App\Area')->withPivot('level');
    }

    public function tickets(){
        return $this->hasMany('App\Ticket');
    }

    public function adminTickets(){
        return $this->hasManyThrough('App\Ticket', 'App\Area');

    }

    public function isAdmin(){

        return (sizeof($this->areas) > 0);
    }

    public function isSuperAdmin(){
        return $this->superadmin;
    }

}
