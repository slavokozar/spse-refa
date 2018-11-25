@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="heading" style="display:flex;justify-content: space-between">
            <h1>
                <a href="{{ action('Stats\UserStatsController@show', [$user->id]) }}">
                    {{ ucfirst($user->name) }}
                </a>
            </h1>
        </div>

        <ul class="nav nav-tabs">
            <li role="presentation"><a href="{{ action('Stats\UserStatsController@show', [$user->id]) }}">Prehlad</a></li>
            <li role="presentation"><a href="{{ action('Stats\UserStatsController@created', [$user->id]) }}">Vytvorene</a></li>
            <li role="presentation" class="active"><a href="{{ action('Stats\UserStatsController@updated', [$user->id]) }}">Upravene</a></li>
            <li role="presentation"><a href="{{ action('Stats\UserStatsController@solved', [$user->id]) }}">Vyriesene</a></li>
        </ul>

        <div class="alert alert-info" role="alert">Vsetky poziadavky, v ktorych stav upravil uzivatel {{ ucfirst($user->name) }}</div>

        <div style="margin-top: 2rem;">
            @if(sizeof($tickets) > 0)
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>PC</th>
                        <th class="col-md-4">Popis</th>
                        <th class="col-md-2">Poruchy</th>
                        <th>
                            {!! Filter::sortable('Vytvorene', 'created_at', true) !!}
                        </th>
                        <th>Vytvoril</th>
                        <th>
                            {!! Filter::sortable('Uroven', 'level') !!}
                        </th>
                        <th>
                            {!! Filter::sortable('Stav', 'status') !!}
                        </th>
                        <th>
                            {!! Filter::sortable('Pocet zmien', 'changes') !!}
                        </th>
                        <th>
                            {!! Filter::sortable('Posledna zmena', 'status_at') !!}
                        </th>
                        <th>
                            {!! Filter::sortable('Vyriesena', 'solved_at') !!}
                        </th>
                        <th>Vyriesil</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <th>
                                <a href="{{ action('Tickets\TicketController@show', [$ticket->id]) }}" >
                                    {{ $ticket->pc }}
                                </a>
                            </th>
                            <td>
                                <a href="{{ action('Tickets\TicketController@show', [$ticket->id]) }}">
                                    {{ $ticket->statuses()->first()->description }}
                                </a>
                            </td>
                            <td>
                                <ul>
                                    @foreach($ticket->failures as $failure)
                                        <li>{{ $failure->name }}</li>
                                    @endforeach
                                </ul>
                            </td>

                            <td>{{ $ticket->created_at }}</td>
                            <td>
                                <a href="{{ action('Stats\UserStatsController@show', [$ticket->actualStatus()->user->id]) }}">
                                    {{ ucfirst($ticket->statuses()->first()->user->name) }}
                                </a>
                            </td>
                            <td>{{ $ticket->level }}</td>
                            <td>{{ $ticket->actualStatus()->name() }}</td>
                            <td>{{ $ticket->statuses()->count() - 1 }}</td>
                            <td>{{ $ticket->status_at }}</td>
                            <td>{{ $ticket->actualStatus()->status == 4 ? $ticket->solved_at : '-' }}</td>
                            <td>
                                @if($ticket->actualStatus()->status == 4)
                                    <a href="{{ action('Stats\UserStatsController@show', [$ticket->actualStatus()->user->id]) }}">
                                        {{ ucfirst($ticket->actualStatus()->user->name) }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning text-center" role="alert">Ziadne poziadavky v tejto miestnosti!</div>
            @endif
        </div>

    </div>
@stop
