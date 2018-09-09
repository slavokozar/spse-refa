@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Vytvorenie požiadavky</h1>
                <form class="form-horizontal" action="{{action('Tickets\TicketController@store')}}" method="post">
                    {!! csrf_field() !!}

                    @if (isset($errors) && count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul class="errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="form-group">
                        <div class="col-xs-3">
                            <label>Učebňa</label>
                        </div>
                        <div class="col-xs-9">
                            <select name="area" class="form-control select">
                                @foreach($areas as $areaObj)
                                    <option value="{{$areaObj->id}}"
                                            data-pc="{{$areaObj->pc}}" {{(old('area') == $areaObj->id) ? 'selected' : ''}}>{{$areaObj->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-3">
                            <label>Počítač</label>
                        </div>
                        <div class="col-xs-9">
                            <select name="computer" class="form-control select">
                                @php  $area = $areas[old('area', 0)]; @endphp
                                @for($i = 1; $i <= $area->pc; $i++)
                                    <option value="{{ $i }}" {{(old('computer') == $i) ? 'selected' : ''}}>
                                        PC {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-3">
                            <label>Poruchy</label>
                        </div>
                        <div class="col-xs-9">

                            @foreach($failures as $failureObj)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="failures[]"
                                               value="{{$failureObj->id}}"/> {{$failureObj->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-xs-3">
                            <label>Poznámka</label>
                        </div>
                        <div class="col-xs-9">
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-9 col-xs-offset-3 text-right"
                             style="display: flex; justify-content: space-around">
                            <a href="{{ action('Tickets\TicketController@index') }}"
                               class="btn btn-danger btn-lg pull-right">Zrušiť</a>
                            <button type="submit" class="btn btn-primary btn-lg pull-right">Vytvoriť</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
