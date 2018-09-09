@extends((( \Request::ajax()) ? 'layouts.modal' : 'layouts.settings_form' ))

@section('settings-breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('Settings\SettingsController@index') }}">Nastavenia</a></li>
        <li><a href="{{ action('Settings\AreaController@index') }}">Učebne</a></li>
        <li>{{$areaObj->name}}</li>
        <li>odstránenie</li>
    </ol>
@endsection

@section('form_header')
    <h4>Odstránenie učebne</h4>
@endsection

@section('form_body')
    <p>Chcete naozaj odstrániť učebňu : <strong>{{$areaObj->name}}</strong></p>
@endsection

@section('form_footer')
    <button type="submit" class="btn btn-primary btn-lg">Odstrániť</button>
    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Zrušiť</button>
@endsection