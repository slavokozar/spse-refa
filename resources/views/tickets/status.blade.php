    <form class="form-horizontal" method="post" action="{!! action('TicketsController@putStatus',[$ticket->id, $status]) !!}">
        <input type="hidden" name="_method" value="put"/>
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="gridSystemModalLabel">Zmena stavu</h4>
        </div>
        <div class="modal-body">
            <div class="row row-margin">
                <div class="col-md-6"><label>Nový stav</label></div>

                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                        Option one is this and that&mdash;be sure to include why it's great
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                        Option two can be something else and selecting it will deselect option one
                    </label>
                </div>
                <div class="radio disabled">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
                        Option three is disabled
                    </label>
                </div>

                @if($status == 2)
                <div class="col-md-6"><a href="#" class="btn btn-warning btn-status"><i class="fa fa-tasks"></i> Riešená</a></div>
                @elseif($status == 3)
                <div class="col-md-6"><a href="#" class="btn btn-primary btn-status"><i class="glyphicon glyphicon-transfer"></i> Presunutá</a></div>
                @elseif($status == 4)
                <div class="col-md-6"><a href="#" class="btn btn-success btn-status"><i class="fa fa-check"></i> Vyriešená</a></div>
                @endif

            </div>



            <div class="form-group row">
                <div class="col-md-12">
                    <label>Poznámka</label>
                </div>
                <div class="col-md-12">
                    <textarea name="description" class="form-control" rows="10" placeholder="Popíšte zmenu stavu ..."></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-lg">Uložiť</button>
            <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Zrušiť</button>
        </div>
    </form>