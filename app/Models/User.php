<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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

    public function processingTickets(){
        return $tickets = Ticket::select(['*',])
            ->whereRaw('(select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [2])
            ->whereRaw('(select "user_id" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [$this->id])
            ->count();
    }

    public function transferedTickets(){
        return $tickets = Ticket::select(['*',])
            ->whereRaw('(select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [3])
            ->whereRaw('(select "user_id" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [$this->id])
            ->count();
    }

    public function solvedTickets(){
        return $tickets = Ticket::select(['*',])
            ->whereRaw('(select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [4])
            ->whereRaw('(select "user_id" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [$this->id])
            ->count();
    }

//    public function firstReactionTime(){
//        return $tickets = Ticket::select(['*',])
//            ->whereRaw('(select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [4])
//
//            ->count();
//    }

    public function isAdmin(){

        return ($this->areas()->withoutGlobalScope('not_global')->count() > 0);
    }

    public function isSuperAdmin(){
        return $this->superadmin;
    }
}
