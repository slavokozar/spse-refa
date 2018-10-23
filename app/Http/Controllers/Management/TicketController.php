<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($area = null)
    {
        $areaObj = Area::find($area);
        $areas = Area::all();

        $areasLevels = [];


        $managedAreas = Auth::user()->areas()->when($area != null, function ($query) use ($area) {
            return $query->where('areas.id', $area);
        })->get();

        foreach ($managedAreas as $manAreaObj) {
            $areasLevels[] = [
                'area_id' => $manAreaObj->id,
                'level' => $manAreaObj->pivot->level
            ];
        }

        $globalAreas = Auth::user()->areas()->withoutGlobalScope('not_global')->where('areas.id', 1)->get();
        foreach ($globalAreas as $globalArea) {
            $level = $globalArea->pivot->level;

            $managedAreas = Area::when($area != null, function ($query) use ($area) {
                return $query->where('areas.id', $area);
            })->whereDoesntHave('managers', function ($q) use ($level) {
                $q->where('level', '=', $level);
            })->get();

            foreach ($managedAreas as $manAreaObj) {
                $areasLevels[] = [
                    'area_id' => $manAreaObj->id,
                    'level' => $level
                ];
            }
        }


        if(count($areasLevels) > 0){


            $tickets = Ticket::select(['*', DB::raw('(select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) as "status"')])
                ->with('statuses')->where(function ($query) use ($areasLevels) {
                    foreach ($areasLevels as $areaLevel) {
                        $query->orWhere(function ($query) use ($areaLevel) {
                            $query
                                ->where('area_id', $areaLevel['area_id'])
                                ->where(DB::raw('(select "level" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1)'), $areaLevel['level']);
                        });
                    }
                })->orderBy('status', 'desc');

            for ($i = 0; $i < 4; $i++) {
                $status = $i + 1;
                $tickesStatus = clone $tickets;

                $stats[$i] = 0;
                $stats[$i] = $tickesStatus->where(function ($query) use ($status) {
                    $query->where(DB::raw('(select "status" from "ticket_status" where "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1)'), $status);
                })->count();
            }

            $tickets = $tickets->paginate(10);
        }else{
            $tickets = [];
        }


        return view('management.index', compact(['areaObj', 'areas', 'tickets', 'stats']));
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticketObj = Ticket::findOrFail($id);
        return view('management.tickets.show', compact(['ticketObj']));
    }

}
