<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">História zmien stavu</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <ul class="timeline">
    @for($i = 0; $i < sizeof($statuses); $i ++ )
        @if($i % 2 == 0)
        <li>
        @else
        <li class="timeline-inverted">
        @endif

        @if($statuses[$i]->status == 1)
            <div class="timeline-badge danger">
                <i class="fa fa-spinner fa-spin"></i>
            </div>
        @elseif($statuses[$i]->status == 2)
            <div class="timeline-badge warning">
                <i class="fa fa-tasks"></i>
            </div>
        @elseif($statuses[$i]->status == 3)
            <div class="timeline-badge primary">
                <i class="fa fa-exchange"></i>
            </div>
        @elseif($statuses[$i]->status == 4)
            <div class="timeline-badge success">
                <i class="fa fa-check"></i>
            </div>
        @endif

            <div class="timeline-panel">
                <div class="timeline-heading">
                    <h4 class="timeline-title">{{$statuses[$i]->name()}} - Úroveň {{$statuses[$i]->level}}</h4>
                    <p><small class="text-muted">{{$statuses[$i]->created_at}} - {{App\User::find($statuses[$i]->user_id)->name}}</small>
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
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Zrušiť</button>
</div>

