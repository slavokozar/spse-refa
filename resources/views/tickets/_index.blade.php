@extends('app')

@section('content')


    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-spinner fa-5x fa-spin"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$stats[0]}}</div>
                            <div>Neriešených požiadaviek</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$stats[1]}}</div>
                            <div>Riešených požiadaviek</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-transfer" style="font-size:5em"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$stats[2]}}</div>
                            <div>Presunutých požiadaviek</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-check fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$stats[3]}}</div>
                            <div>Vyriešených požiadaviek</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--<div class="row">--}}
        {{--<div class="col-lg-12">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading" style="background:#337ab7; color:#fff;">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-lg-10">--}}
                            {{--@if($logged->isAdmin())--}}
                            {{--<h2>Moje požiadavky</h2>--}}
                            {{--@else--}}
                            {{--<h2>Vytvorenie požiadavky</h2>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--@if($logged->isAdmin() || isset($areaId))--}}
                        {{--<div class="col-lg-2">--}}
                            {{--<h3 class="pull-right"><a id="create-ticket" class="btn btn-default" href=""><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Vytvoriť požiadavku</a></h3>--}}
                        {{--</div>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<form action="{{action('TicketsController@store')}}" method="post" id="create" @if($logged->isAdmin() || isset($areaId)) style="display:none" @endif>--}}
                        {{--<input type="hidden" name="_token" value="{{csrf_token()}}">--}}


                        {{--<div class="row" style="background:#fff; color:#337ab7; padding-top:20px">--}}
                            {{--@if($logged->isAdmin() || isset($areaId))--}}
                            {{--<div class="col-lg-4 col-lg-offset-6">--}}
                                {{--<button id="create-close" type="button" class="btn btn-primary btn-circle pull-right"><i class="fa fa-times"></i></button>--}}
                            {{--</div>--}}
                            {{--@endif--}}
                        {{--</div>--}}

                        {{--<div class="row" style="background:#fff; color:#337ab7;">--}}
                                {{--<div class="col-lg-8 col-lg-offset-2">--}}
                                    {{--@if (isset($errors) && count($errors) > 0)--}}
                                        {{--<div class="alert alert-danger">--}}
                                            {{--<ul class="errors">--}}
                                                {{--@foreach ($errors->all() as $error)--}}
                                                    {{--<li>{{ $error }}</li>--}}
                                                {{--@endforeach--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--@endif--}}
                                {{--</div>--}}

                            {{--<div class="col-lg-4 col-lg-offset-2">--}}
                                {{--<div class="form-group row">--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<label>Učebňa</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-8">--}}
                                        {{--<select name="area" class="form-control">--}}

                                            {{--@foreach($areas as $area)--}}
                                            {{--<option value="{{$area->id}}" {{(isset($areaId) && $areaId == $area->id) ? 'selected' : ''}}>{{$area->name}}</option>--}}

                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}




                                {{--<div class="form-group row">--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<label>Počítač</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-8">--}}
                                        {{--<input name="computer" class="form-control">--}}
                                    {{--</div>--}}

                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<label>Poznámka</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-8">--}}
                                        {{--<textarea name="description" class="form-control" rows="3"></textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-lg-4">--}}
                                {{--<div class="form-group row">--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<label>Poruchy</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-8">--}}
                                        {{--<input type="hidden" name="_toadken" value="asdasd">--}}

                                    {{--@foreach($failures as $failure)--}}
                                        {{--<div class="checkbox">--}}
                                            {{--<label>--}}
                                                {{--<input name="failures[]" value="{{$failure->id}}" type="checkbox" value="">{{$failure->name}}--}}
                                            {{--</label>--}}
                                        {{--</div>--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row" style="background:#fff; color:#337ab7; padding-bottom:20px">--}}

                            {{--<div class="col-lg-4 col-lg-offset-6">--}}
                                {{--<button type="submit" class="btn btn-primary btn-lg pull-right">Vytvoriť</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--<!-- /.panel-heading -->--}}
                {{--<div class="panel-body">--}}
                    {{--@if(sizeof($tickets) > 0)--}}

                    {{--<div class="table-responsive">--}}
                        {{--<table class="table">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th class="col-md-1">Učebňa - PC</th>--}}
                                {{--<th class="col-md-3">Popis</th>--}}
                                {{--<th class="col-md-4">Chyby</th>--}}

                                {{--<th class="col-md-1">Stav - Úroveň</th>--}}

                                {{--<th class="col-md-2">Posledná zmena</th>--}}

                                {{--<th class="col-md-1">Akcie</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}

                                {{--@foreach($tickets as $ticket)--}}
                                {{--<tr @if($ticket->owner) class="info" @elseif($logged->isAdmin() && !$ticket->admin) class="muted" @endif>--}}
                                    {{--<td>--}}
                                        {{--<strong>{{$ticket->area->name}} - {{$ticket->pc}}</strong>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--{{$ticket->statuses()->where('status',1)->first()->description}}--}}
                                    {{--</td>--}}
                                    {{--<td >--}}
                                        {{--@foreach($ticket->failures as $failure)--}}
                                            {{--<span class="label label-danger">{{$failure->name}}</span>--}}
                                        {{--@endforeach--}}

                                    {{--</td>--}}

                                    {{--<td style="opacity:1">--}}
                                        {{--@if($ticket->status()->status == 1)--}}
                                            {{--<a href="{{action('TicketsController@history',[$ticket])}}" class="btn btn-danger btn-history" data-toggle="modal" style="width:100%" ><i class="fa fa-spinner fa-spin"></i> {{$ticket->status()->name()}} - Úroveň {{$ticket->status()->level}}</a>--}}
                                        {{--@elseif($ticket->status()->status == 2)--}}
                                            {{--<a href="{{action('TicketsController@history',[$ticket])}}" class="btn btn-warning btn-history" data-toggle="modal" style="width:100%" ><i class="fa fa-tasks"></i> {{$ticket->status()->name()}} - Úroveň {{$ticket->status()->level}}</a>--}}
                                        {{--@elseif($ticket->status()->status == 3)--}}
                                            {{--<a href="{{action('TicketsController@history',[$ticket])}}" class="btn btn-primary btn-history" data-toggle="modal" style="width:100%" ><i class="fa fa-exchange"></i> {{$ticket->status()->name()}}  - Úroveň {{$ticket->status()->level}}</a>--}}
                                        {{--@elseif($ticket->status()->status == 4)--}}
                                            {{--<a href="{{action('TicketsController@history',[$ticket])}}" class="btn btn-success btn-history" data-toggle="modal" style="width:100%" ><i class="fa fa-check"></i> {{$ticket->status()->name()}} - Úroveň {{$ticket->status()->level}}</a>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                    {{--<td>--}}

                                        {{--<span style="font-size:1.2em">{{$ticket->status()->user->name}}</span>--}}
                                        {{--<br/>--}}
                                        {{--<span class="text-muted" >{{$ticket->status()->created_at}}</span>--}}

                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--@if($ticket->admin)--}}
                                         {{--<div class="btn-group">--}}
                                                {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                                    {{--Zmeniť stav <span class="caret"></span>--}}
                                                {{--</button>--}}
                                                {{--<ul class="dropdown-menu ">--}}
                                                    {{--@if($ticket->status()->status <= 2 || ($ticket->status()->status == 3 && $ticket->level < $ticket->adminLevel))--}}
                                                        {{--<li><a href="{{action('TicketsController@editStatus',[$ticket,2])}}" class="btn btn-warning btn-status" data-toggle="modal"><i class="fa fa-tasks"></i> Riešená</a></li>--}}
                                                    {{--@endif--}}
                                                    {{--@if($ticket->adminLevel < 4 && ($ticket->status()->status < 4 || ($ticket->status()->status == 3 && $ticket->level < $ticket->adminLevel)))--}}
                                                        {{--<li><a href="{{action('TicketsController@editStatus',[$ticket,3])}}" class="btn btn-primary btn-status" data-toggle="modal"><i class="glyphicon glyphicon-transfer"></i> Presunutá</a></li>--}}
                                                    {{--@endif--}}
                                                    {{--@if($ticket->status()->status < 4 || ($ticket->status()->status == 3 && $ticket->level < $ticket->adminLevel))--}}
                                                        {{--<li><a href="{{action('TicketsController@editStatus',[$ticket,4])}}" class="btn btn-success btn-status" data-toggle="modal"><i class="fa fa-check"></i> Vyriešená</a></li>--}}
                                                    {{--@endif--}}
                                                {{--</ul>--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--@endforeach--}}

                            {{--</tbody>--}}

                        {{--</table>--}}
                    {{--</div>--}}
                    {{--@elseif($logged->isAdmin())--}}
                        {{--Nie su vytvorene ziadne poziadavky--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>

@stop
