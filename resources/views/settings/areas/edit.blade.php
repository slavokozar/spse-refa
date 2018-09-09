@extends((( \Request::ajax()) ? 'layouts.modal' : 'layouts.settings_form' ))

@section('settings-breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('Settings\SettingsController@index') }}">Nastavenia</a></li>
        <li><a href="{{ action('Settings\AreaController@index') }}">Učebne</a></li>
        @if($areaObj->id == null)
            <li>vytvorenie</li>
        @else
            <li>{{$areaObj->name}}</li>
            <li>úprava</li>
        @endif
    </ol>
@endsection

@section('form_header')
    @if($areaObj->id == null)
        <h4 class="modal-title" id="gridSystemModalLabel">Vytvorenie učebne</h4>
    @else
        <h4 class="modal-title" id="gridSystemModalLabel">Úprava učebne : {{$areaObj->name}}</h4>
    @endif
@endsection

@section('form_body')
    <div class="form-group">
        <label class="col-sm-4 control-label">Názov</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Názov" name="name" value="{{$areaObj->name}}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4 control-label">Počet počítačov</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" placeholder="Počet počítačov" value="{{$areaObj->pc}}" name="pc">
        </div>
    </div>

    @foreach($managers as $level => $levelManagers)
        <div class="form-group">
            <label class="col-sm-4 control-label">{{trans('settings.managers.label', ['level' => $level])}}</label>
            <div class="col-sm-8">
                <select name="manager[{{$level}}][]" class="select-users form-control" multiple="multiple" style="width: 100%">
                    @foreach($levelManagers as $manager)
                        <option value="{{$manager->id}}" selected>{{$manager->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endforeach
@endsection

@section('form_footer')
    <button type="submit" class="btn btn-primary btn-lg">Uložiť</button>
    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Zrušiť</button>
@endsection
