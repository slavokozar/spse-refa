@extends('layouts.app')

@section('content')
    <div class="container">
<h2>O systéme</h2>
<p>
<strong>ReFa</strong> je systém určený pre profesorov SPŠE v Prešove slúžiaci pre nahlasovania nefunkčnosti HW alebo SW prípadne pre požiadavku doinštalovania SW alebo HW. Systém slúži aj na evidovanie, upozorňovanie a riešenie vzniknutých porúch.
</p>
<h2>Správa LAN infraštruktúry  SPŠE</h2>
<p>Správa LAN infraštruktúry v laboratóriách, odborných učebniach a kabinetoch je zabezpečená osobami, ktoré majú odstupňované kompetencie, čím je zabezpečená rôzna úroveň správy.<p>
<p>Systém eviduje tri rôzne úrovne správcov:</p>
<h3>L1 správa</h3>
<ul>
<li>lokálny administrátor Ethernet infraštruktúry LAB/OU/KAB</li>
<li>kontrola stavu a funkčnosti HW a SW PC v LAB/OU/KAB</li>
<li>odstránenie nedostatkov/porúch HW podľa kompetencií L1 správy, napr. výmena jednoduchých periférií (myš, klávesnica, monitor, dataprojektor, vizualizér, prezentér a pod.) a náplní (toner, baterky v ovládačoch a pod.), káblový manažment (kontrola konektivity a funkčnosť  – USB, VGA, HDMI, RJ 45, 230 V a pod.)</li>
<li>odstránenie nedostatkov/porúch SW podľa kompetencií  L1 správy (napr. obnova OS, inštalácia SW, správa užívateľských profilov, správa lokálnych údajov)</li>
<li>zápis porúch/nedostatkov HW a SW mimo kompetencií L1 – oznámenie pre L2 správu</li>
<li>evidencia požiadaviek na SW od vyučujúcich v LAB/OU/KAB </li>
<li>konzultácie pre vyučujúcich v LAB/OU/KAB</li>
</ul>
<h3>L2 správa</h3>
<ul>
<li>správa a konfigurácia Ethernet infraštruktúry v LAB/OU/KAB</li>
<li>inštalácia a konfigurácia OS, antivírových SW v PC</li>
<li>priebežný monitoring stavu Ethernet infraštruktúry, dokumentácia Ethernet infraštruktúry a jej zmien</li>
<li>odstránenie nedostatkov/porúch HW a SW PC podľa požiadaviek L1 správy</li>
<li>zápis porúch/nedostatkov – oznámenie pre L3 správu</li>
<li>dohľad, konzultácie pre L1 správu</li>
</ul>

<h3>L3 správa</h3>
<ul>
<li>správa a konfigurácia Ethernet a WiFi LAN infraštruktúry SPŠE</li>
<li>správa a konfigurácia sieťových služieb LAN infraštruktúry SPŠE</li>
<li>správa serverov LAN infraštruktúry SPŠE</li>
<li>správa kont</li>
<li>bezpečnostná politika</li>
<li>audit (bezpečnosť, licencie, dodržiavanie pravidiel a pod.)</li>
<li>odstránenie nedostatkov/porúch HW a SW podľa požiadaviek L2 správy</li>
<li>dohľad, konzultácie pre L2 správu</li>
</ul>

<h2>Požiadavky na servis</h2>
<p>Požiadavka je záznam  v systéme ReFa vytvorený užívateľom systému pre nahlásenie nefunkčnosti HW alebo SW prípadne požiadavke doinštalovania SW alebo HW na niektorom z PC. Po vytvorení požiadavky je upozornený vecne príslušná osoba úrovne správy L1, ktorej sa táto požiadavka týka, a tá môže zmeniť stav tejto požiadavky.</p>
<p>O vytvorení, alebo zmene stavu požiadavky sú e-mailom upozornení užívateľ systému, ktorý požiadavku vytvoril ako aj vecne príslušná osoba úrovne správy L1.</p>
<p>Admin ako aj užívateľ systému si môže kedykoľvek pozrieť históriu zmien stavu požiadavky kliknutím na tlačidlo, s aktuálnym stavom požiadavky.</p>
<p>
Každá požiadavka na podporu môže nadobudnúť tieto štyri stavy:
</p>


        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-danger" style="width:100%" ><i class="fa fa-spinner fa-spin"></i> Neriešená</button>
            </div>
            <div class="col-md-10">V tomto stave sa nachádza každá novovytvorená požiadavka.</div>
        </div>

        <hr/>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-warning" style="width:100%" ><i class="fa fa-tasks"></i> Riešená</button>
            </div>
            <div class="col-md-10">V tomto stave sa nachádza požiadavka, ktorá sa práve rieši. Vecne príslušná osoba úrovne správy môže opakovane pridávať zmenu stavu do stavu Riešená, v takomto prípade môže pomocou poznámky pri zmene stavu informovať užívateľa systému, ako prebieha riešenie jeho požiadavky.</div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-primary" style="width:100%" ><i class="fa fa-exchange"></i> Presunutá</button>
            </div>
            <div class="col-md-10">V tomto stave sa nachádza požiadavka, na ktorej vyriešenie nemá vecne príslušná osoba úrovne správy na doterajšej úrovni kompetencie. V takomto prípade požiadavku presunie na vecne príslušnú osobu vyššej úrovne správy.</div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-success" style="width:100%" ><i class="fa fa-check"></i> Vyriešená</button>

            </div>
            <div class="col-md-10">V tomto stave sa nachádza vyriešená požiadavka, ktorá sa tým stáva uzavretá.</div>
        </div>
    </div>
@endsection
