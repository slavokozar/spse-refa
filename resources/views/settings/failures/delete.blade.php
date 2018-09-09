@extends((( \Request::ajax()) ? 'layouts.modal' : 'layouts.settings_form' ))

@section('settings-breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('Settings\SettingsController@index') }}">Nastavenia</a></li>
        <li><a href="{{ action('Settings\FailureController@index') }}">Poruchy</a></li>
        <li>{{$failureObj->name}}</li>
        <li>vymazanie</li>
    </ol>
@endsection

@section('form_header')
    <h4>Odstránenie poruchy</h4>
@endsection

@section('form_body')
    <p>Chcete naozaj odstrániť poruchu : <strong>{{$failureObj->name}}</strong></p>
@endsection

@section('form_footer')
    <button type="submit" class="btn btn-primary btn-lg">Odstrániť</button>
    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Zrušiť</button>
@endsection