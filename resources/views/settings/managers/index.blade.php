@extends('layouts.settings')

@section('settings-breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('Settings\SettingsController@index') }}">Nastavenia</a></li>
        <li>Globálni správcovia</li>
    </ol>
@endsection

@section('settings-content')

    <h1>{{trans('settings.managers.heading')}}</h1>
    <div class="alert alert-info" role="alert">{{trans('settings.managers.help')}}</div>


    <form class="form form-horizontal" method="post" action="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

        @foreach($managers as $level => $levelManagers)

            <div class="form-group">
                <label for="inputPassword3" class="col-md-2 control-label">{{trans('settings.managers.label', ['level' => $level])}}</label>
                <div class="col-md-6">
                    <select name="manager[{{$level}}][]" class="select-users form-control" multiple="multiple">
                        @foreach($levelManagers as $manager)
                        <option value="{{$manager->id}}" selected>{{$manager->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <p class="text-muted">{{trans('settings.managers.hints')[$level]}}</p>
                </div>
            </div>
        @endforeach


        <div class="form-group">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-large btn-primary">
                    <span class="fa fa-floppy-o"></span>&nbsp;Uložiť
                </button>
            </div>
        </div>
    </form>


@endsection