@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="heading">
                    <h1>Zmena stavu</h1>
                </div>

                <form class="form-horizontal" method="post"
                      action="{{ action('Management\StatusController@store',[$ticketObj->id]) }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-3">Nový stav</label>
                        <div class="col-md-9">

                            <div>
                                <label class="ticket-radio ticket-pending disabled">
                                    <input type="radio" name="status" value="1" disabled>
                                    <span class="checkmark"></span>
                                    <i class="fa fa-hourglass-start fa-spin"></i>
                                    nová
                                </label>
                                <span class="help-block">A block of help text that breaks onto a new line.</span>
                            </div>

                            <div>
                                <label class="ticket-radio ticket-processing">
                                    <input type="radio" name="status" value="2">
                                    <span class="checkmark"></span>
                                    <i class="fa fa-refresh fa-spin"></i>
                                    riešená
                                </label>
                                <span class="help-block">A block of help text that breaks onto a new line.</span>
                            </div>

                            <div>

                                <label class="ticket-radio ticket-transfered">
                                    <input type="radio" name="status" value="3">
                                    <span class="checkmark"></span>
                                    <i class="fa fa-exchange "></i>
                                    presunutá
                                </label>
                                <span class="help-block">A block of help text that breaks onto a new line.</span>

                            </div>

                            <div>
                                <label class="ticket-radio ticket-done">
                                    <input type="radio" name="status" id="" value="4">
                                    <span class="checkmark"></span>
                                    <i class="fa fa-check"></i>
                                    Vyriešená
                                </label>
                                <span class="help-block">A block of help text that breaks onto a new line.</span>

                            </div>

                        </div>


                    </div>


                    <div class="form-group">
                        <label class="col-md-3">Poznámka</label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" rows="2"
                                      placeholder="Popíšte zmenu stavu ..."></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-9 col-xs-offset-3 text-right" style="display: flex; justify-content: space-around">
                            <a href="{{ action('Management\TicketController@show', $ticketObj->id) }}" class="btn btn-danger btn-lg pull-right">Zrušiť</a>
                            <button type="submit" class="btn btn-primary btn-lg pull-right">Uložiť</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>



