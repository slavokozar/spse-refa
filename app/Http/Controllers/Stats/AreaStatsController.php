<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AreaStatsController extends Controller
{
    public function index(Request $request)
    {
        $sort_by = $request->input('sort_by', 'name');
        if (!in_array($sort_by, ['name', 'created_tickets', 'solved_tickets'])) $sort_by = 'name';


        $sort_order = $request->input('sort_order', 'asc');
        if (!in_array($sort_order, ['asc', 'desc'])) $sort_order = 'asc';

        $areas = Area::select([
            DB::raw('"areas".*'),
            DB::raw('(
                SELECT count(*) FROM "tickets"
                WHERE ("tickets"."area_id" = "areas"."id")
            ) as "created_tickets"'),
            DB::raw('(
                SELECT count(*) FROM "tickets"
                WHERE ("tickets"."area_id" = "areas"."id")
                AND ((select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = 4)                
            ) as "solved_tickets"'),
            DB::raw('(
                SELECT "created_at" FROM "tickets"
                WHERE ("tickets"."area_id" = "areas"."id")
                ORDER BY "tickets"."created_at" DESC 
                LIMIT 1                
            ) as "ticket_at"')
        ]);

        $areas = $areas->orderBy($sort_by, $sort_order)->get();
        return view('stats/areas/index', compact(['areas']));
    }

    public function show(Request $request, $user)
    {
        $area = Area::find($user);

        $sort_by = $request->input('sort_by', 'name');
        if (!in_array($sort_by, ['created_at', 'level', 'status', 'changes', 'status_at', 'solved_at'])) $sort_by = 'created_at';


        $sort_order = $request->input('sort_order', 'asc');
        if (!in_array($sort_order, ['asc', 'desc'])) $sort_order = 'asc';


        $tickets = $area->tickets()->select([
            DB::raw('"tickets".*'),
            DB::raw('(
                SELECT "ticket_status"."level" FROM "ticket_status"
                WHERE "ticket_status"."ticket_id" = "tickets"."id"
                ORDER BY "created_at" DESC LIMIT 1
            ) as "level"'),
            DB::raw('(
                SELECT "ticket_status"."status" FROM "ticket_status"
                WHERE "ticket_status"."ticket_id" = "tickets"."id"
                ORDER BY "created_at" DESC LIMIT 1
            ) as "status"'),
            DB::raw('(
                SELECT COUNT(*) FROM "ticket_status"
                WHERE "ticket_status"."ticket_id" = "tickets"."id"
            ) as "changes"'),
            DB::raw('(
                SELECT "ticket_status"."created_at" FROM "ticket_status"
                WHERE "ticket_status"."ticket_id" = "tickets"."id"
                ORDER BY "created_at" DESC LIMIT 1
            ) as "status_at"'),
            DB::raw('(
                SELECT "ticket_status"."created_at" FROM "ticket_status"
                WHERE "ticket_status"."ticket_id" = "tickets"."id"
                AND "ticket_status"."status" = 4
                ORDER BY "created_at" DESC LIMIT 1
            ) as "solved_at"')
        ]);

        $tickets = $tickets->orderBy($sort_by, $sort_order)->get();


        return view('stats/areas/show', compact(['area', 'tickets']));
    }
}
