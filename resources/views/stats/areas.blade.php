@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="heading" style="display:flex;justify-content: space-between">
            <h1>Statistiky uzivatelov</h1>
        </div>

        <div style="margin-top: 2rem;">
            @if(sizeof($areas) > 0)
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>
                            Ucebna
                        </th>
                        <th>
                            Vytvorenych poziadaviek
                        </th>
                        <th>
                            Vyriesenych poziadaviek
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($areas as $area)
                        <tr>
                            <th>{{ ucfirst($area->name) }}</th>
                            <td>{{ $area->tickets()->count() }}</td>
                            <td>{{ $area->solvedTickets()->count() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning text-center" role="alert">Nemáte vytvorené žiadne požiadavky!</div>
            @endif
        </div>

    </div>
    </div>
@stop
