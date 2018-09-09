@if($failure->id == '')
    <form class="form-horizontal" method="post" action="{!! action('FailuresController@store') !!}">
@else
    <form class="form-horizontal" method="post" action="{!! action('FailuresController@update',[$failure->id]) !!}">
        <input type="hidden" name="_method" value="put"/>
@endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

@if($failure->id == '')
                <h4 class="modal-title" id="gridSystemModalLabel">Vytvorenie poruchy</h4>
@else
                <h4 class="modal-title" id="gridSystemModalLabel">Úprava poruchy : {{$failure->name}}</h4>
@endif

        </div>
        <div class="modal-body">

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Názov</label>

                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Názov" name="name" value="{{$failure->name}}">
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-lg">Uložiť</button>
            <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Zrušiť</button>
        </div>
    </form>