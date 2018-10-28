<h1>HW Servis SPŠE</h1>
<p>Vaša požiadavka na HW servis bola zmenená.</p>


<p>Detai požiadavky:<br/>
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
    <tr>
        <td>Stav</td>
        <td>
            {{$ticket->actualStatus()->name()}} - Úroveň {{$ticket->actualStatus()->level}}
        </td>
    </tr>


</table>
</p>
<p>O zmenách stavu tohto požiadavku Vás budeme informovať emailom, bližšie detaily po prihlásení na <a href="http://is.spse-po.sk">is.spse-po.sk</a></p>

<p>Systém na správu porúch SPŠE Prešov</p>