@extends('layouts.settings')

@section('settings-breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('Settings\SettingsController@index') }}">Nastavenia</a></li>
        <li>Poruchy</li>
    </ol>
@endsection

@section('settings-content')

    <h1>{{trans('settings.failures.heading')}}</h1>
    @if(trans('settings.failures.help') != null)
        <div class="alert alert-info" role="alert">{{trans('settings.failures.help')}}</div>
    @endif
    <div class="row">
        <div class="col-sm-12 text-right lead">
            <a id="create-ticket" class="btn btn-default" href="{!! action('Settings\FailureController@create') !!}"
               data-toggle="modal"><span class="fa fa-plus"></span>&nbsp;Nová</a>

        </div>
    </div>

    @if(count($failures) > 0)
        @foreach($failures as $failure)
            <div class="data-list">
                <div class="data-row">
                    <div class="lead">
                        {{$failure->name}}
                    </div>

                    <div>
                        <a href="{!! action('Settings\FailureController@edit', [$failure->id]) !!}"
                           class="btn btn-warning"
                           style="color:#fff; margin-right:5px" data-toggle="modal"><i class="fa fa-pencil"></i> Upraviť</a>
                        <a href="{!! action('Settings\FailureController@delete', [$failure->id]) !!}"
                           class="btn btn-danger"
                           data-toggle="modal"><i class="fa fa-times"></i> Odstrániť</a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>{{trans('settings.failures.empty')}}</p>
    @endif





@endsection