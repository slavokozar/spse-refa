@extends('layouts.settings')

@section('settings-breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('Settings\SettingsController@index') }}">Nastavenia</a></li>
        <li><a href="#">Učebne</a></li>
    </ol>
@endsection

@section('settings-content')

    <h1>{{trans('settings.areas.heading')}}</h1>
    @if(trans('settings.areas.help') != null)
        <div class="alert alert-info" role="alert">{{trans('settings.areas.help')}}</div>
    @endif
    <div class="row">
        <div class="col-sm-12 text-right lead">
            <a class="btn btn-default" href="{!! action('Settings\AreaController@create') !!}" data-toggle="modal">
                <span class="fa fa-plus"></span>&nbsp;Nová</a>
        </div>
    </div>

    @if(count($areas) > 0)
        @foreach($areas as $areaObj)

            <div class="data-list">
                <div class="data-row">
                    <div class="lead">
                        {{$areaObj->name}} ({{$areaObj->pc}} PC)
                        <ul>
                            @for($i = 1; $i <= env('MANAGER_LEVELS'); $i++)
                                @php
                                    $managers = $areaObj->managers()->where('level', $i)->get();
                                    $li = '';
                                    foreach($managers as $manager){
                                        $li .= $manager->name . ', ';
                                    }
                                @endphp
                                @if(strlen($li) > 0)
                                    <li><span class="text-muted">{{ trans('settings.managers.label', ['level' => $i]) }}</span> {{ rtrim($li, ', ') }}</li>
                                @endif
                            @endfor
                        </ul>
                    </div>

                    <div>
                        <a href="{!! action('Settings\AreaController@edit', [$areaObj->id]) !!}" class="btn btn-warning"
                           style="color:#fff; margin-right:5px" data-toggle="modal"><i class="fa fa-pencil"></i> Upraviť</a>
                        <a href="{!! action('Settings\AreaController@delete', [$areaObj->id]) !!}" class="btn btn-danger"
                           data-toggle="modal"><i class="fa fa-times"></i> Odstrániť</a>
                    </div>
                </div>
            </div>
            {{--<div class="form-group">--}}
            {{--<label for="inputPassword3" class="col-md-2 control-label">{{trans('settings.areas.label', ['level' => $level])}}</label>--}}
            {{--<div class="col-md-6">--}}
            {{--<select name="admin[{{$level}}][]" class="select-users form-control" multiple="multiple">--}}
            {{--@foreach($levelareas as $manager)--}}
            {{--<option value="{{$manager->id}}" selected>{{$manager->name}}</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
            {{--<p class="text-muted">{{trans('settings.areas.hints')[$level]}}</p>--}}
            {{--</div>--}}
            {{--</div>--}}
        @endforeach
    @else
        <p>{{trans('settings.areas.empty')}}</p>
    @endif






@endsection