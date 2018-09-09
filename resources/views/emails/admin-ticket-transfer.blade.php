<h1>HW Servis SPŠE</h1>
<p>V učebni ktorú spravujete bola požiadavka na podporu presunutá na Vašu úroveň.</p>


<p>Detaily požiadavky:<br/>
    <table>
    <tr>
        <td>Učebňa</td>
        <td>{{$ticket->area->name}}</td>
    </tr>
    <tr>
        <td>Počítač</td>
        <td>{{$ticket->pc}}</td>
    </tr>
    <tr>
        <td>Poznámka</td>
        <td>{{$ticket->statuses()->where('status',1)->first()->description}}</td>
    </tr>
    <tr>
        <td>Poruchy</td>
        <td>@foreach($ticket->failures as $failure)
                {{$failure->name}},
            @endforeach</td>
    </tr>

    <td>
        <strong>{{$ticket->area->name}} - {{$ticket->pc}}</strong>
    </td>
    <td>
        {{$ticket->statuses()->where('status',1)->first()->description}}
    </td>
    <td >
        @foreach($ticket->failures as $failure)
            <span class="label label-danger">{{$failure->name}}</span>
        @endforeach

    </td>

</table>
</p>
<p>Zmena stavu požiadavky po prihlásení na <a href="http://is.spse-po.sk">is.spse-po.sk</a></p>

<p>Systém na správu porúch SPŠE Prešov</p>