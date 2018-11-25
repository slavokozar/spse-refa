<div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail požiadavky - {{$ticketObj->area->name}} - PC{{$ticketObj->pc}}</h4>
            </div>
            <div class="modal-body">
                <div style="margin-bottom: 2rem">
                    @foreach($ticketObj->failures as $failureObj)
                        <span class="label label-danger label-lg">{{$failureObj->name}}</span>
                    @endforeach
                </div>

                <div style="margin-bottom: 2rem">
                    {{$ticketObj->statuses()->where('status',1)->first()->description}}
                </div>

                <h3>História zmien</h3>

                @include('management.tickets.timeline');
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->