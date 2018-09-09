@extends('layouts.settings')

@section('settings-content')

    <h1>{{trans('settings.heading')}}</h1>
    <div>
        <a class="btn btn-link"
           href="{{action('Settings\ManagersController@index')}}">{{ trans('settings.managers.link') }}</a>
    </div>

    <div>
        <a class="btn btn-link"
           href="{{action('Settings\AreaController@index')}}">{{ trans('settings.areas.link') }}</a>
    </div>

    <div>
        <a class="btn btn-link"
           href="{{action('Settings\FailureController@index')}}">{{ trans('settings.failures.link') }}</a>
    </div>



@endsection