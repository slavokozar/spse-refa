@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="heading" style="display:flex;justify-content: space-between">
            <h1>Statistiky uzivatelov</h1>
        </div>

        <div style="margin-top: 2rem;">
            @if(sizeof($users) > 0)
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="2">
                            {!! Filter::sortable('Uzivatel', 'name', true) !!}
                        </th>
                        <th colspan="4" class="text-center">
                            Poziadavky
                        </th>
                        <th rowspan="2">
                            Priemerna doba odozvy
                        </th>
                        <th rowspan="2">
                            Priemerna doba vyriesenia
                        </th>
                    <tr>
                        <th>
                            {!! Filter::sortable('Vytvorenych', 'created_tickets') !!}
                        </th>
                        <th>
                            {!! Filter::sortable('Riesenych', 'processing_tickets') !!}
                        </th>
                        <th>
                            {!! Filter::sortable('Presunutych', 'transfered_tickets') !!}
                        </th>
                        <th>
                            {!! Filter::sortable('Vyriesenych', 'solved_tickets') !!}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>
                                <a href="{{ action('Stats\UserStatsController@show', [$user->id]) }}">
                                    {{ ucfirst($user->name) }}
                                </a>
                            </th>
                            <td>{{ $user->created_tickets }}</td>
                            <td>{{ $user->processing_tickets }}</td>
                            <td>{{ $user->transfered_tickets }}</td>
                            <td>{{ $user->solved_tickets }}</td>
                            <td>{{ TimeService::humanDiff(UserStatsService::firstReactionTime($user)) }}</td>
                            <td>{{ TimeService::humanDiff(UserStatsService::solutionTime($user)) }}</td>
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
