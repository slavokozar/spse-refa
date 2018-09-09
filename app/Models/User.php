<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function areas(){
        return $this->belongsToMany('App\Models\Area')->withPivot('level');
    }

    public function tickets(){
        return $this->hasMany('App\Models\Ticket');
    }

    public function adminTickets(){
        return $this->hasManyThrough('App\Models\Ticket', 'App\Models\Area');

    }

    public function isAdmin(){

        return ($this->areas()->withoutGlobalScope('not_global')->count() > 0);
    }

    public function isSuperAdmin(){
        return $this->superadmin;
    }
}
