@extends('layouts.app')

@section('content')

    <div class="container">
        <div id="quick-stats">
            <div class="stats-panel ticket-pending">
                <div class="icon">
                    <i class="fa fa-hourglass-start fa-5x fa-spin"></i>
                </div>

                <div class="stats-value">
                    <div class="huge">{{$stats[0]}}</div>
                    <div>neriešených požiadaviek</div>
                </div>
            </div>

            <div class="stats-panel ticket-processing">
                <div class="icon">
                    <i class="fa fa-refresh fa-5x fa-spin"></i>
                </div>
                <div class="stats-value">
                    <div class="huge">{{$stats[1]}}</div>
                    <div>riešených požiadaviek</div>
                </div>
            </div>

            <div class="stats-panel ticket-transfered">
                <div class="icon">
                    <i class="fa fa-exchange fa-5x"></i>
                </div>
                <div class="stats-value">
                    <div class="huge">{{$stats[2]}}</div>
                    <div>presunutých požiadaviek</div>
                </div>
            </div>

            <div class="stats-panel ticket-done">
                <div class="icon">
                    <i class="fa fa-check fa-5x"></i>
                </div>
                <div class="stats-value">
                    <div class="huge">{{$stats[3]}}</div>
                    <div>vyriešených požiadaviek</div>
                </div>
            </div>
        </div>


        <div class="text-center" style="margin-top: 2rem; display:flex; justify-content: space-between">
            <h1>Moje požiadavky</h1>
            <div>
                <a href="{{ action('Tickets\TicketController@create') }}" class="btn btn-danger btn-lg">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Vytvoriť požiadavku
                </a>
            </div>
        </div>

        <div style="margin-top: 2rem;">
            @if(sizeof($tickets) > 0)
                <div class="table-heading">
                    <div class="row">
                        <div class="col-xs-2 col-sm-1">Učebňa</div>
                        <div class="col-xs-2 col-sm-1">PC</div>
                        <div class="hidden-xs col-sm-3">Popis</div>
                        <div class="hidden-xs col-sm-3">Chyby</div>
                        <div class="col-xs-4 col-sm-2">Stav</div>
                        <div class="col-xs-4 col-sm-2">Zmena</div>
                    </div>
                </div>



                @foreach($tickets as $ticket)
                    <a href="{{ action('Tickets\TicketController@show',[$ticket->id]) }}">
                        <div class="ticket ticket-{{$ticket->status()->first()->cssClass()}}">
                            <div class="row">
                                <div class="col-xs-2 col-sm-1">
                                    <strong>{{$ticket->area->name}}</strong>
                                </div>
                                <div class="col-xs-2 col-sm-1">
                                    <strong>{{$ticket->pc}}</strong>
                                </div>
                                <div class="col-xs-4 col-sm-2 col-sm-push-6">
                                    <strong>{{$ticket->status()->first()->name()}} - Úroveň {{$ticket->status()->first()->level}}</strong>
                                </div>
                                <div class="col-xs-4 col-sm-2 col-sm-push-6">
                                    <div class="text-muted"><b>{{$ticket->status()->first()->user->name}}</b></div>
                                    <div class="text-muted" style="margin-top: -2px">({{$ticket->status()->first()->created_at}})</div>

                                </div>
                                <div class="col-xs-12 col-sm-3 col-sm-pull-1 text-middle">
                                    @foreach($ticket->failures as $failure)
                                        <span class="label label-danger">{{$failure->name}}</span>
                                    @endforeach
                                </div>
                                <div class="col-xs-12 col-sm-3 col-sm-pull-7 text-muted text-middle">
                                    {{$ticket->statuses()->where('status',1)->first()->description}}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach


                {{--{!! $users->links() !!}--}}
        </div>
        @elseif(Auth::user()->isAdmin())
            <div class="alert alert-warning text-center" role="alert">Nemate vytvorene ziadne poziadavky!</div>
        @endif
    </div>
    </div>
@stop
