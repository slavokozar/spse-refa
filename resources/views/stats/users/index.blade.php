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
                            <td>
                                <a href="{{ Action('Stats\UserStatsController@created', [$user->id])  }}">
                                    {{ $user->created_tickets }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ Action('Stats\UserStatsController@updated', [$user->id])  }}">
                                    {{ $user->processing_tickets }}
                                </a>
                            </td>

                            <td>
                                <a href="{{ Action('Stats\UserStatsController@updated', [$user->id])  }}">
                                    {{ $user->transfered_tickets }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ Action('Stats\UserStatsController@solved', [$user->id])  }}">
                                    {{ $user->solved_tickets }}
                                </a>
                            </td>
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
