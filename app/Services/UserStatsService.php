<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 26.10.2018
 * Time: 1:10
 */

namespace App\Services;


use App\Models\Ticket;

class UserStatsService
{
    private function firstReactionAfterCreationTime($user)
    {
        $sum = 0;
        $count = 0;

        $statuses = $user->statuses()
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

    private function firstReactionAfterTransferTime($user)
    {
        $sum = 0;
        $count = 0;

        $statuses = $user->statuses()
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

    public function firstReactionTime($user){
        $afterCreation = $this->firstReactionAfterCreationTime($user);
        $afterTransfer = $this->firstReactionAfterTransferTime($user);


        if($afterCreation !== null and $afterTransfer !== null){
            return  ($afterCreation + $afterTransfer) / 2;
        }elseif($afterCreation !== null){
            return $afterCreation;
        }elseif($afterTransfer !== null){
            return $afterTransfer;
        }

        return null;
    }

    public function solutionTime($user){
        $statuses = $user->statuses()->where('status', 4)->get();
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



}