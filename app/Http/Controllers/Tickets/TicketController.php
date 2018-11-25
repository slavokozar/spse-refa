<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;

use App\Models\Area;
use App\Models\Failure;
use App\Models\Ticket;
use App\Models\TicketStatus;

use App\Notifications\User;
use App\Notifications\Manager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the tickets owned by logged user.
     */
    public function index()
    {
        $tickets = Auth::user()->tickets()->orderBy('created_at', 'desc')->get();

        $stats = [0, 0, 0, 0];

        return view('tickets.index', compact(['areas', 'failures', 'stats', 'tickets']));
    }


    /**
     * Display form for creating new ticket.
     */
    public function create()
    {
        $areas = Area::all();
        $failures = Failure::all();

        return view('tickets.create', compact(['areas', 'failures']));
    }


    /**
     * Store newly created ticket into database.
     */
    public function store(TicketRequest $request)
    {
        $areaObj = Area::find($request->input('area'));

        $ticketObj = Ticket::create([
            'area_id' => $areaObj->id,
            'pc' => $request->input('computer'),
            'user_id' => Auth::user()->id
        ]);

        $ticketObj->failures()->attach($request->input('failures'));

        $ticketStatus = TicketStatus::create([
            'ticket_id' => $ticketObj->id,
            'user_id' => Auth::user()->id,
            'description' => $request->input('description')
        ]);

        Auth::user()->notify(new User\TicketCreated($ticketObj));

        $managers = $ticketObj->area->managers()->wherePivot('level', 1)->get();
        if ($managers->count() == 0) {
            $managers = Area::withoutGlobalScope('not_global')->find(1)->managers()->wherePivot('level', 1)->get();
        }
        Notification::send($managers, new Manager\Area\TicketCreated($ticketObj));

        return redirect(action('Tickets\TicketController@index'));
    }

    /**
     * Display the specific Ticket
     */
    public function show(Request $request, $id)
    {
        $ticketObj = Ticket::findOrFail($id);

        if($request->ajax()){
            return view('tickets.history', compact(['ticketObj']));
        }else{
            return view('tickets.show', compact(['ticketObj']));
        }
    }
}
