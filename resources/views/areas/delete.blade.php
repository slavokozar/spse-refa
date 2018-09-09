    {!! Form::open(['method' => 'DELETE', 'action' => ['AreasController@destroy', $failure->id]])  !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="gridSystemModalLabel">Odstránenie učebne</h4>
        </div>
        <div class="modal-body">
            <p>Chcete naozaj odstrániť učebňu : <strong>{{$failure->name}}</strong></p>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-lg">Odstrániť</button>
            <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Zrušiť</button>
        </div>
    </form>
    {!! Form::close() !!}