@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="heading" style="display:flex;justify-content: space-between">
            <h1>Statistiky uzivatelov</h1>
        </div>

        <div style="margin-top: 2rem;">
            @if(sizeof($areas) > 0)
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="2">
                            {!! Filter::sortable('Ucebna', 'name', true) !!}
                        </th>
                        <th colspan="3" class="text-center">
                            Poziadavky
                        </th>
                    </tr>
                    <tr>
                        <th>
                            {!! Filter::sortable('Vytvorenych', 'created_tickets') !!}
                        </th>
                        <th>
                            {!! Filter::sortable('Vyriesenych', 'solved_tickets') !!}
                        </th>
                        <th>
                            {!! Filter::sortable('Posledna', 'ticket_at') !!}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($areas as $area)
                        <tr>
                            <th>
                                <a href="{{ action('Stats\AreaStatsController@show', [$area->id]) }}">
                                    {{ ucfirst($area->name) }}
                                </a>
                            </th>

                            <td>{{ $area->created_tickets }}</td>
                            <td>{{ $area->solved_tickets }}</td>
                            <td>{{ $area->ticket_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning text-center" role="alert">Nemáte vytvorené žiadne požiadavky!</div>
            @endif
        </div>

    </div>
    </div>
@stop
