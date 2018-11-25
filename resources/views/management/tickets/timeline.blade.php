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