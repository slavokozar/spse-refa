<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 25.2.18
 * Time: 23:09
 */

namespace App\Http\Controllers\Management;


use App\Models\Area;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Notifications\Manager;
use App\Notifications\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class StatusController
{

    public function create($ticket)
    {
        $ticketObj = Ticket::findOrFail($ticket);
        return view('management.status.create', compact(['ticketObj']));
    }

    public function store($ticket, Request $request)
    {
        //todo moze uzivatel vytvorit novy status?
        //todo moze uzivatel presunut?

        $data = $request->all();

        $ticketObj = Ticket::find($ticket);
        $areaObj = $ticketObj->area;

        if ($data['status'] == 3) {

            // presun poziadavky na vyssi level

            $oldLevel = $ticketObj->status()->level;
            $newLevel = $ticketObj->status()->level + 1;

            //presun na vyssiu uroven
            $ticketStatus = TicketStatus::create([
                'ticket_id' => $ticketObj->id,
                'user_id' => Auth::user()->id,
                'status' => $data['status'],
                'level' => $newLevel,
                'description' => $data['description']
            ]);

            //notifikacia autorovi ticketu
            $ticketObj->user->notify(new User\TicketTransfered($ticketObj));

            //notifikacia manazerovi, ktory upravil ticket
            Auth::user()->notify(new Manager\TicketTransfered($ticketObj));




            //notifikacia pre vsetkych adminov urovne $oldLevel
            $managers = $ticketObj->area->managers()
                ->where('users.id', '!=', Auth::user()->id)
                ->wherePivot('level', $oldLevel)->get();

            if ($managers->count() == 0) {

                $managers = Area::withoutGlobalScope('not_global')->find(1)
                    ->managers()->where('users.id', '!=', Auth::user()->id)
                    ->wherePivot('level', $oldLevel)->get();
            }

            Notification::send($managers, new Manager\Area\TicketTransfered($ticketObj));

            //notifikacia pre vsetkych adminov urovne $newLevel
            $managers = $ticketObj->area
                ->managers()->wherePivot('level', $newLevel)
                ->where('users.id', '!=', Auth::user()->id)->get();

            if ($managers->count() == 0) {

                $managers = Area::withoutGlobalScope('not_global')->find(1)
                    ->managers()->wherePivot('level', $newLevel)
                    ->where('users.id', '!=', Auth::user()->id)->get();
            }

            Notification::send($managers, new Manager\Area\TicketTransfered($ticketObj));

        } else {
            //zmena stavu
            TicketStatus::create([
                'ticket_id' => $ticketObj->id,
                'user_id' => Auth::user()->id,
                'status' => $data['status'],
                'level' => $ticketObj->status()->level,
                'description' => $data['description']
            ]);


            if ($data['status'] == env('MANAGER_LEVELS')) {
                //notifikacia autorovi ticketu
                $ticketObj->user->notify(new User\TicketSolved($ticketObj));

                //notifikacia manazerovi, ktory upravil ticket
                Auth::user()->notify(new Manager\TicketSolved($ticketObj));

            } else {

                //notifikacia autorovi ticketu
                $ticketObj->user->notify(new User\TicketUpdated($ticketObj));

                //notifikacia manazerovi, ktory upravil ticket
                Auth::user()->notify(new Manager\TicketUpdated($ticketObj));

                $managers = $ticketObj->area->
                    managers()->wherePivot('level', $ticketObj->status()->level)
                    ->where('users.id', '!=', Auth::user()->id)->get();

                if ($managers->count() == 0) {

                    $managers = Area::withoutGlobalScope('not_global')->find(1)
                        ->managers()->wherePivot('level', $ticketObj->status()->level)
                        ->where('users.id', '!=', Auth::user()->id)->get();
                }

                Notification::send($managers, new Manager\Area\TicketUpdated($ticketObj));
            }

            //todo notifikacia - pre vsetkch adminov danej urovne tejto oblasti

        }

        return redirect(action('Management\TicketController@show', [$ticketObj->id]));
    }
}