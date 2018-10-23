@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="heading" style="display:flex;justify-content: space-between">
            <h1>Statistiky uzivatelov</h1>
        </div>

        <div style="margin-top: 2rem;">
            @if(sizeof($users) > 0)
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>
                            Uzivatel
                        </th>
                        <th>
                            Vytvorenych poziadaviek
                        </th>
                        <th>
                            Riesenych poziadaviek
                        </th>
                        <th>
                            Presunutych poziadaviek
                        </th>
                        <th>
                            Vyriesenych poziadaviek
                        </th>
                        <th>
                            Priemerna doba odozvy
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{ ucfirst($user->name) }}</th>
                            <td>{{ $user->tickets()->count() }}</td>
                            <td>{{ $user->processingTickets() }}</td>
                                <td>{{ $user->transferedTickets() }}</td>
                                <td>{{ $user->solvedTickets() }}</td>

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
