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
                    asdfpasdfop asdfnl asjdh ajshdfjk adhsjlfk asd
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

                <ul class="timeline">
                    @php $statuses = $ticketObj->statuses; @endphp
                    @for($i = 0; $i < sizeof($statuses); $i ++ )
                        <li{!! $i % 2 == 1 ? ' class="timeline-inverted"' : '' !!} >

                            @if($statuses[$i]->status == 1)
                                <div class="timeline-badge ticket-pending">
                                    <i class="fa fa-hourglass-start fa-spin"></i>
                                </div>
                            @elseif($statuses[$i]->status == 2)
                                <div class="timeline-badge ticket-processing">
                                    <i class="fa fa-refresh"></i>
                                </div>
                            @elseif($statuses[$i]->status == 3)
                                <div class="timeline-badge ticket-transfered">
                                    <i class="fa fa-exchange"></i>
                                </div>
                            @elseif($statuses[$i]->status == 4)
                                <div class="timeline-badge ticket-done">
                                    <i class="fa fa-check"></i>
                                </div>
                            @endif

                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">
                                        {{$statuses[$i]->name()}} - Úroveň {{$statuses[$i]->level}}
                                    </h4>
                                    <p>
                                        <small class="text-muted">
                                            <strong>{{$statuses[$i]->user->name}}</strong>
                                            ({{$statuses[$i]->created_at}})
                                        </small>
                                    </p>
                                </div>
                                <div class="timeline-body">
                                    <p>{{$statuses[$i]->description}}</p>
                                </div>
                            </div>
                        </li>
                    @endfor

                </ul>
            </div>
        </div>

    </div>
@endsection