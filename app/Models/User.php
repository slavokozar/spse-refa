<?php

namespace App\Models;

use Carbon\Carbon;
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
        'password',
        'remember_token',
        'superadmin',
        'created_at',
        'updated_at',
    ];

    public function areas()
    {
        return $this->belongsToMany('App\Models\Area')->withPivot('level');
    }

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function statuses()
    {
        return $this->hasMany('App\Models\TicketStatus');
    }

    public function adminTickets()
    {
        return $this->hasManyThrough('App\Models\Ticket', 'App\Models\Area');
    }

    public function processingTickets()
    {
        return $tickets = Ticket::select(['*',])
            ->whereRaw('(select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [2])
            ->whereRaw('(select "user_id" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [$this->id])
            ->count();
    }

    public function transferedTickets()
    {
        return $tickets = Ticket::select(['*',])
            ->whereRaw('(select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [3])
            ->whereRaw('(select "user_id" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [$this->id])
            ->count();
    }

    public function solvedTickets()
    {
        return $tickets = Ticket::select(['*',])
            ->whereRaw('(select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [4])
            ->whereRaw('(select "user_id" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = ?', [$this->id])
            ->count();
    }

    public function firstReactionAfterCreationTime()
    {
        $sum = 0;
        $count = 0;

        $user = $this;

        $statuses = $this->statuses()
            ->whereHas('ticket', function ($query) use ($user) {
                return $query->where('user_id', '!=', $user->id);
            })->with('ticket')->get();

        foreach ($statuses as $status) {
            $ticket = $status->ticket;

            //prva odpoved po vytvoreni = ak je nejaky status, ktory nepatri "vyrobcovi" ticketu

            $previousStatuses = $ticket->statuses()
                ->where('status', '!=', 1)
                ->where('created_at', '<', $status->getOriginal('created_at'))
                ->count();

            if ($previousStatuses == 0) {
                $count++;
                $sum += (strtotime($status->getOriginal('created_at')) - strtotime($ticket->getOriginal('created_at')));
            }
        }


        return $count > 0 ? $sum / $count : null;
    }

    public function firstReactionAfterTransferTime()
    {
        $sum = 0;
        $count = 0;

        $user = $this;

        $statuses = $this->statuses()
            ->whereHas('ticket', function ($query) use ($user) {
                return $query->where('user_id', '!=', $user->id);
            })->with('ticket')->get();

        foreach ($statuses as $status) {
            $ticket = $status->ticket;

            // prva odpoved na urovni = este neexistuje status, na aktualnej urovni (okrem presunu na uroven)

            if ($status->level !== 1) {
                $previousStatusesOnLevel = $ticket->statuses()
                    ->where('level', $status->level)
                    ->where('status', '!=', 3)
                    ->where('created_at', '<', $status->getOriginal('created_at'))
                    ->count();

                if ($previousStatusesOnLevel == 0) {
                    $count += 1;
                    $sum += (strtotime($status->getOriginal('created_at')) - strtotime($ticket->getOriginal('created_at')));
                }
            }
        }


        return $count > 0 ? ($sum / $count) : null;
    }

    public function firstReactionTime(){
        $afterCreation = $this->firstReactionAfterCreationTime();
        $afterTransfer = $this->firstReactionAfterTransferTime();


        if($afterCreation !== null and $afterTransfer !== null){
            return  ($afterCreation + $afterTransfer) / 2;
        }elseif($afterCreation !== null){
            return $afterCreation;
        }elseif($afterTransfer !== null){
            return $afterTransfer;
        }

        return null;
    }

    public function solutionTime(){
        $statuses = $this->statuses()->where('status', 4)->get();
        $sum = 0;
        $count = 0;

        foreach($statuses as $status){
            $ticket = $status->ticket;

            if($status->level == 1){
                $count += 1;
                $sum += (strtotime($status->getOriginal('created_at')) - strtotime($ticket->getOriginal('created_at')));
            }else{

                $transferStatus = $ticket->statuses()
                    ->where('level', $status->level)
                    ->where('status', 3)
                    ->first();

                $count += 1;
                $sum += (strtotime($status->getOriginal('created_at')) - strtotime($transferStatus->getOriginal('created_at')));
            }

            if ($status->level !== 1) {
                $previousStatusesOnLevel = $ticket->statuses()
                    ->where('level', $status->level)
                    ->where('status', '!=', 3)
                    ->where('created_at', '<', $status->getOriginal('created_at'))
                    ->count();

                if ($previousStatusesOnLevel == 0) {
                    $count += 1;
                    $sum += (strtotime($status->getOriginal('created_at')) - strtotime($ticket->getOriginal('created_at')));
                }
            }
        }

        return $count > 0 ? ($sum / $count) : null;
    }

    public function isAdmin()
    {

        return ($this->areas()->withoutGlobalScope('not_global')->count() > 0);
    }

    public function isSuperAdmin()
    {
        return $this->superadmin;
    }
}
