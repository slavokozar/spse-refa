@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-pills nav-stacked">
                    <li{!! $_controller == 'SettingsController' ? ' class="active"' : '' !!}>
                        <a href="{{action('Settings\SettingsController@index')}}">{{ trans('settings.index.link') }}</a>
                    </li>
                    <li{!! $_controller == 'ManagersController' ? ' class="active"' : '' !!}>
                        <a href="{{action('Settings\ManagersController@index')}}">{{ trans('settings.managers.link') }}</a>
                    </li>
                    <li{!! $_controller == 'AreaController' ? ' class="active"' : '' !!}>
                        <a href="{{action('Settings\AreaController@index')}}">{{ trans('settings.areas.link') }}</a>
                    </li>
                    <li{!! $_controller == 'FailureController' ? ' class="active"' : '' !!}>
                        <a href="{{action('Settings\FailureController@index')}}">{{ trans('settings.failures.link') }}</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
                @yield('settings-breadcrumb')

                @yield('settings-content')
            </div>
        </div>
    </div>
@endsection