@extends((( \Request::ajax()) ? 'layouts.modal' : 'layouts.settings_form' ))

@section('settings-breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('Settings\SettingsController@index') }}">Nastavenia</a></li>
        <li><a href="{{ action('Settings\FailureController@index') }}">Poruchy</a></li>
        @if($failureObj->id == null)
            <li>vytvorenie</li>
        @else
            <li>{{$failureObj->name}}</li>
            <li>úprava</li>
        @endif
    </ol>
@endsection

@section('form_header')
    @if($failureObj->id == '')
        <h4>Vytvorenie poruchy</h4>
    @else
        <h4>Úprava poruchy : {{$failureObj->name}}</h4>
    @endif
@endsection

@section('form_body')
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="inputEmail3" class="col-sm-4 control-label">Názov</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Názov" name="name" value="{{old('name', $failureObj->name)}}">
        </div>
        @if($errors->has('name'))
            <div class="col-sm-12">
                <p class="help-block">{{ $errors->first('name') }}</p>
            </div>
        @endif
    </div>
@endsection

@section('form_footer')
    <button type="submit" class="btn btn-primary btn-lg">Uložiť</button>
    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Zrušiť</button>
@endsection