@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Detail požiadavky - {{$ticketObj->area->name}} - PC{{$ticketObj->pc}}</h1>

                <div style="margin-bottom: 2rem">
                    @foreach($ticketObj->failures as $failureObj)
                        <span class="label label-danger label-lg">{{$failureObj->name}}</span>
                    @endforeach
                </div>

                <div style="margin-bottom: 2rem">
                    {{$ticketObj->statuses()->where('status',1)->first()->description}}
                </div>

                <div style="display: flex; justify-content: space-between">
                    <h3>História zmien</h3>
                    <div>
                        <a style="margin-bottom: 0;" href="{{ action('Management\StatusController@create', [$ticketObj->id]) }}"
                           class="btn btn-danger">
                            <i class="fa fa-wrench" aria-hidden="true"></i>
                            Zmenit stav
                        </a>
                    </div>
                </div>

                @include('management.tickets.timeline');
            </div>
        </div>

    </div>
@endsection