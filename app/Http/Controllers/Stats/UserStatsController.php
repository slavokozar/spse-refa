<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserStatsController extends Controller
{

    public function index(Request $request)
    {
        $sort_by = $request->input('sort_by', 'name');
        if (!in_array($sort_by, ['name', 'created_tickets', 'processing_tickets', 'transfered_tickets', 'solved_tickets'])) $sort_by = 'name';

        $sort_order = $request->input('sort_order', 'asc');
        if (!in_array($sort_order, ['asc', 'desc'])) $sort_order = 'asc';


        $users = User::select([
            DB::raw('"users".*'),
            DB::raw('(
                SELECT count(*) FROM "tickets"
                WHERE ("tickets"."user_id" = "users"."id")
            ) as "created_tickets"'),
            DB::raw('(
                SELECT count(*) FROM "tickets"
                WHERE ((select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = 2)
                AND ((select "user_id" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = "users"."id")
            ) as "processing_tickets"'),
            DB::raw('(
                SELECT count(*) FROM "tickets"
                WHERE ((select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = 3)
                AND ((select "user_id" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = "users"."id")
            ) as "transfered_tickets"'),
            DB::raw('(
                SELECT count(*) FROM "tickets"
                WHERE ((select "status" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = 4)
                AND ((select "user_id" FROM "ticket_status" WHERE "tickets"."id" = "ticket_status"."ticket_id" order by "created_at" desc limit 1) = "users"."id")
            ) as "solved_tickets"'),
        ]);

        $users = $users->orderBy($sort_by, $sort_order)->get();

        return view('stats/users/index', compact(['users']));
    }


    public function show(Request $request, $user)
    {
        $user = User::find($user);


        $tickets = $user->tickets;

        $statuses = $user->statuses;

        return view('stats/users/show', compact(['user', 'tickets', 'statuses']));
    }

    public function created(Request $request, $user){
        $user = User::find($user);

        $sort_by = $request->input('sort_by', 'name');
        if (!in_array($sort_by, ['created_at', 'level', 'status', 'changes', 'status_at', 'solved_at'])) $sort_by = 'created_at';


        $sort_order = $request->input('sort_order', 'asc');
        if (!in_array($sort_order, ['asc', 'desc'])) $sort_order = 'asc';


        $tickets = $user->tickets()->select([
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

        return view('stats/users/created', compact(['user', 'tickets']));
    }

    public function updated(Request $request, $user){
        $user = User::find($user);

        $sort_by = $request->input('sort_by', 'name');
        if (!in_array($sort_by, ['created_at', 'level', 'status', 'changes', 'status_at', 'solved_at'])) $sort_by = 'created_at';


        $sort_order = $request->input('sort_order', 'asc');
        if (!in_array($sort_order, ['asc', 'desc'])) $sort_order = 'asc';

        $tickets = Ticket::select([
            DB::raw('"tickets".*'),
            DB::raw('(
                SELECT "ticket_status"."level" FROM "ticket_status"
                WHERE "ticket_status"."ticket_id" = "tickets"."id"
                ORDER BY "created_at" DESC LIMIT 1
            ) as "level"'),
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
        ])->whereHas('statuses', function($query) use($user){
            $query->where('status', '!=', 1)->where('ticket_status.user_id', $user->id);
        });

        $tickets = $tickets->orderBy($sort_by, $sort_order)->get();

        return view('stats/users/updated', compact(['user', 'tickets']));
    }

    public function solved(Request $request, $user){
        $user = User::find($user);

        $sort_by = $request->input('sort_by', 'name');
        if (!in_array($sort_by, ['created_at', 'level', 'status', 'changes', 'status_at', 'solved_at'])) $sort_by = 'created_at';


        $sort_order = $request->input('sort_order', 'asc');
        if (!in_array($sort_order, ['asc', 'desc'])) $sort_order = 'asc';

        $tickets = Ticket::select([
            DB::raw('"tickets".*'),
            DB::raw('(
                SELECT "ticket_status"."level" FROM "ticket_status"
                WHERE "ticket_status"."ticket_id" = "tickets"."id"
                ORDER BY "created_at" DESC LIMIT 1
            ) as "level"'),
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
        ])->whereHas('status', function($query) use($user){
            $query->where('status', 4)->where('ticket_status.user_id', $user->id);
        });

        $tickets = $tickets->orderBy($sort_by, $sort_order)->get();

        return view('stats/users/solved', compact(['user', 'tickets']));
    }
}
