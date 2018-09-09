@if($area->id == '')
    <form class="form-horizontal" method="post" action="{!! action('AreasController@store') !!}">
@else
    <form class="form-horizontal" method="post" action="{!! action('AreasController@update',[$area->id]) !!}">
        <input type="hidden" name="_method" value="put"/>
        <input type="hidden" id="adminL1" value=""/>
        <input type="hidden" id="adminL2" value=""/>

        @endif

        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>



            @if($area->id == '')
                <h4 class="modal-title" id="gridSystemModalLabel">Vytvorenie učebne</h4>
            @else
                <h4 class="modal-title" id="gridSystemModalLabel">Úprava učebne : {{$area->name}}</h4>
            @endif

        </div>
        <div class="modal-body">

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Názov</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Názov" name="name" value="{{$area->name}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Počet počítačov</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Počet počítačov" value="{{$area->pc}}" name="pc">
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Správca prvej úrovne</label>
                <div class="col-sm-8">
                    <select name="adminL1[]" class="select user form-control" multiple="multiple" style="width: 100%">
                        @if(isset($adminsL1))
                            @foreach($adminsL1 as $admin)
                                <option value="{{$admin->id}}" selected>{{$admin->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">

                <label for="inputPassword3" class="col-sm-4 control-label">Správca druhej úrovne</label>
                <div class="col-sm-8">
                    <select name="adminL2[]" class="select user form-control" multiple="multiple" style="width: 100%">
                        @if(isset($adminsL2))
                            @foreach($adminsL2 as $admin)
                                <option value="{{$admin->id}}" selected>{{$admin->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-lg">Uložiť</button>
            <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Zrušiť</button>
        </div>
    </form>
