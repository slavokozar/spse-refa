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
            <li role="presentation" class="active"><a href="{{ action('Stats\UserStatsController@show', [$user->id]) }}">Prehlad</a></li>
            <li role="presentation"><a href="{{ action('Stats\UserStatsController@created', [$user->id]) }}">Vytvorene</a></li>
            <li role="presentation"><a href="{{ action('Stats\UserStatsController@updated', [$user->id]) }}">Upravene</a></li>
            <li role="presentation"><a href="{{ action('Stats\UserStatsController@solved', [$user->id]) }}">Vyriesene</a></li>
        </ul>


    </div>
@stop
