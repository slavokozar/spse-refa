<?php

namespace App\Http\Controllers;

use App\Area;
use App\Failure;
use App\Http\Requests\TicketRequest;
use App\Ticket;
use App\TicketStatus;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

        $this->logged = Auth::user();

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stats = [
            0,
            0,
            0,
            0
        ];

        if($this->logged->active == 0){
            $this->logged->active = 1;
            $this->logged->save();

            return redirect(action('Auth\PasswordController@getChange'));
        }

        if (count($this->logged->areas()->find(1)) > 0) {
            $areas = Area::all()->pluck('id');
        } else {
            $areas = $this->logged->areas->pluck('id');
        }

        $adminLevel = [];

        foreach ($areas as $area){
            $pivots = DB::table('area_user')
                ->where('user_id', $this->logged->id)
                ->where('area_id', $area)
                ->orWhere('area_id',1)
                ->get();

            foreach($pivots as $pivot){
                if($pivot != null && (!isset($adminLevel[$area]) || $adminLevel[$area] < $pivot->level)){
                    $adminLevel[$area] = $pivot->level;
                }
            }

        }






        if($this->logged->isAdmin()) {

            $tickets = Ticket::whereIn('area_id', $areas)->orWhere('user_id', $this->logged->id)->orderBy('created_at','desc')->get();
            foreach ($tickets as $ticket) {
                $ticket->level = $ticket->statuses()->get()->last()->status;

                if(isset($adminLevel[$ticket->area_id])){
                    $stats[$ticket->status()->status - 1]++;

                    if ($adminLevel[$ticket->area_id] >= $ticket->status()->level) {
                        $ticket->admin = true;
                    }
                }

                if($ticket->user_id == $this->logged->id){
                    $ticket->owner = true;
                }
            };

        }else{
            $tickets = $this->logged->tickets()->orderBy('created_at','desc')->get();
            foreach ($tickets as $ticket){
                $ticket->status = $ticket->statuses()->get()->last()->status;
            }
        }

//        return $tickets;
//        return compact(['tickets','adminLevel']);
        $users = User::all();
//        $areas = Area::where('enable',1)->where('id','!=',1)->orderBy('order', 'asc')->get();
        $areas = Area::where('enable',1)->where('id','!=',1)->get();
        $failures = Failure::where('enable',1)->get();


        $logged = $this->logged;
        return view('tickets.index',compact(['users','logged','areas','failures','stats','tickets']));
    }

    public function area($areaId){
        $area = Area::find($areaId);

        $stats = [
            0,
            0,
            0,
            0
        ];

        $tickets = [];

        $adminLevel = 0;

        $pivots = DB::table('area_user')
            ->where('user_id', $this->logged->id)
            ->where('area_id', $areaId)
            ->orWhere('area_id',1)
            ->get();

        foreach($pivots as $pivot){
            if($pivot != null && (!isset($adminLevel) || $adminLevel < $pivot->level)){
                $adminLevel = $pivot->level;
            }
        }


        if($this->logged->isAdmin()) {
            $tickets = $area->tickets()->orderBy('created_at','desc')->get();
            foreach ($tickets as $ticket) {
                $ticket->level = $ticket->statuses()->get()->last()->status;

                if(isset($adminLevel)){
                    $stats[$ticket->status()->status - 1]++;

                    if ($adminLevel >= $ticket->status()->level) {
                        $ticket->admin = true;
                    }
                }

                if($ticket->user_id == $this->logged->id){
                    $ticket->owner = true;
                }
            };
        }else{
            $tickets = $area->tickets()->orderBy('created_at','desc')->get();;

        }


        $users = User::all();
        $areas = Area::where('enable',1)->where('id','!=',1)->orderBy('order', 'asc')->get();
        $failures = Failure::where('enable',1)->get();

        $logged = $this->logged;

        return view('tickets.index',compact(['areaId','users','logged','areas','failures','stats','tickets']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {

        //create ticket
        $ticket = Ticket::create([
            'area_id' => $request->area,
            'pc' => $request->computer,
            'user_id' => $this->logged->id
        ]);

        //asociate with failures
        $ticket->failures()->attach($request->failures);


        //create ticket status
        $ticketStatus = TicketStatus::create([
            'ticket_id' => $ticket->id,
            'user_id' => $this->logged->id,
            'description' => $request->description
        ]);

        $area = Area::find($request->area);


        $email = $this->logged->email;
        Mail::send('emails.client-ticket-create', compact(['ticket']), function ($message) use ($email, $area, $request){
            $message->from('hwservis@spse-po.sk', 'HW servis');
            $message->subject('HW Servis SPSE - vytvorenie požiadavky: '.$area->name.' - '.$request->computer);
            $message->to($email);
        });

        $admins = $ticket->area->admins()->where('level',1)->get();
        foreach($admins as $admin){
            Mail::send('emails.client-ticket-create', compact(['ticket']), function ($message) use ($admin, $area, $request){
                $message->from('hwservis@spse-po.sk', 'HW servis');
                $message->subject('HW Servis SPSE - vytvorenie požiadavky: '.$area->name.' - '.$request->computer);
                $message->to($admin->email);
            });
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function history($id)
    {
        $ticket = Ticket::find($id);

        $statuses = $ticket->statuses()->get();
        $logged = $this->logged;
        return view('tickets.history',compact(['logged','ticket','statuses']));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function editStatus($ticket, $status){
        $ticket = Ticket::find($ticket);
        return view('tickets.status', compact(['ticket','status']));
    }

    public function putStatus($ticket, $status, Request $request){

        $ticket = Ticket::find($ticket);
        $area = Area::find($ticket->area->id);


        $adminLevel = 0;

        $pivots = DB::table('area_user')
            ->where('user_id', $this->logged->id)
            ->where('area_id', $area->id)
            ->orWhere('area_id',1)
            ->get();

        foreach($pivots as $pivot){
            if($pivot != null && (!isset($adminLevel) || $adminLevel < $pivot->level)){
                $adminLevel = $pivot->level;
            }
        }



        if($ticket->status()->level > $adminLevel){
            return redirect()->back();
        }



        if($status == 3){

            $oldLevel = $ticket->status()->level;
            $newLevel = $ticket->status()->level + 1;

            //presun na vyssiu uroven
            $ticketStatus = TicketStatus::create([
                'ticket_id' => $ticket->id,
                'user_id' => $this->logged->id,
                'status' => 3,
                'level' => $newLevel,
                'description' => $request->description
            ]);

            $email = $this->logged->email;
            Mail::send('emails.client-ticket-update', compact(['ticket']), function ($message) use ($email, $area, $ticket){
                $message->from('hwservis@spse-po.sk', 'HW servis');
                $message->subject('HW Servis SPSE - presun požiadavky: '.$area->name.' - '.$ticket->pc);
                $message->to($email);
            });

            $admins = $ticket->area->admins()->where('level',$oldLevel)->get();
            foreach($admins as $admin){
                Mail::send('emails.admin-ticket-update', compact(['ticket']), function ($message) use ($admin, $area, $ticket){
                    $message->from('hwservis@spse-po.sk', 'HW servis');
                    $message->subject('HW Servis SPSE - presun požiadavky: '.$area->name.' - '.$ticket->pc);
                    $message->to($admin->email);
                });
            }

            $admins = $ticket->area->admins()->where('level',$newLevel)->get();
            foreach($admins as $admin){
                Mail::send('emails.admin-ticket-transfer', compact(['ticket']), function ($message) use ($admin, $area, $ticket){
                    $message->from('hwservis@spse-po.sk', 'HW servis');
                    $message->subject('HW Servis SPSE - presun požiadavky: '.$area->name.' - '.$ticket->pc);
                    $message->to($admin->email);
                });
            }

        }else{
            //zmena stavu
            TicketStatus::create([
                'ticket_id' => $ticket->id,
                'user_id' => $this->logged->id,
                'status' => $request->status,
                'level' => $ticket->status()->level,
                'description' => $request->description
            ]);

            $email = $this->logged->email;

            Mail::send('emails.client-ticket-update', compact(['ticket']), function ($message) use ($email, $area, $ticket){
                $message->from('hwservis@spse-po.sk', 'HW servis');
                $message->subject('HW Servis SPSE - úprava požiadavky: '.$area->name.' - '.$ticket->pc);
                $message->to($email);
            });

            $admins = $ticket->area->admins()->where('level',$ticket->status()->level)->get();
            foreach($admins as $admin){
                Mail::send('emails.admin-ticket-update', compact(['ticket']), function ($message) use ($admin, $area, $ticket){
                    $message->from('hwservis@spse-po.sk', 'HW servis');
                    $message->subject('HW Servis SPSE - úprava požiadavky: '.$area->name.' - '.$ticket->pc);
                    $message->to($admin->email);
                });
            }
        }

        return redirect()->back();
    }

    private function ticketStatus($ticket, $status, $description){



    }
}
