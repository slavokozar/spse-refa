@extends('app')

@section('content')
    <div class="container">


<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1>O systéme</h1>

        <p>
            Systém nahlasovania hardvérových porúch je určený pre učiteľov Strednej Priemyselnej Školy Elektrotechnickej v Prešove. Systém slúži na nahlasovanie, evidovanie a upozorňovanie na vzniknuté poruchy a ich riešenia.
        </p>
        <h2>Správcovia hardvéru</h2>

        <p>
            Správcovia hardvéru v učebniach sú osoby určené administrátorom systému. Systém eviduje štyri rôzne úrovne správcov.
        </p>


        <p>Správca 1. úrovne - správca počítačovej učebne. Je to správca, ktorý je informovaný o každom novom požiadavku v ním spravovanej učebni. V jeho kompetencii je oprava základných porúch.</p>
        <hr/>

        <p>Správca 2. úrovne - správca počítačovej učebne. V jeho kompetencii je oprava porúch, na ktoré správca 1. úrovne nie je oprávnený.</p>
        <hr/>

        <p>Správca 3. úrovne - správca školskej domény. Tento správca nie je pridelený konkrétnej učebni, ale všetkym učebniam pripojeným do domény SPŠE. V kompetencii tohto správcu je riešiť systémové, prevažne SW problémy.</p>
        <hr/>

        <p>Správca 4. úrovne - správca chrbtice siete SPŠE. V kompetencii tohto správcu je riešiť problémy spôsobené poruchami v celkovej infraštruktúre školsej siete.</p>


        <h2>Požiadavky na servis</h2>
        <p>Požiadavka je zázam v systéme vytvorený užívateľom systému o poruche na niektorom z počítačov. Po vytvorení požiadavky je upozornený správca učebne, ktorej sa táto požiadavka týka, a ten môže zmeniť stav tejto požiadavky.</p>

        <p>O vytvorení, alebo zmene stavu sú upozornení užívateľ, ktorý požiadavku vytvoril, aj správca danej učebne na danej úrovni emailom.</p>
        <p>Ako admin, tak aj užívateľ si môže kedykoľvek pozrieť históriu zmien stavovo požiadavky kliknutím na tlačidlo, s aktuálnym stavom objednávky.</p>
        <p>Každá požiadavka na podporu môže nadobnúť tieto štyry stavy:</p>



        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-danger" style="width:100%" ><i class="fa fa-spinner fa-spin"></i> Neriešená</button>
            </div>
            <div class="col-md-10">

                v tomto stave sa nachádza každá vytvorená požiadavka.
            </div>
        </div>

        <hr/>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-warning" style="width:100%" ><i class="fa fa-tasks"></i> Riešená</button>
            </div>
            <div class="col-md-10">
                v tomto stave sa nachádza požiadavok, ktorý sa práve rieši. Správca učebne môže opakovane pridávať zmenu stavu do stavu riešený, v takomto prípade môže pomocou poznámky pri zmene stavu informovať užívateľa, ako prebieha riešenie jeho požiadavku.
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-primary" style="width:100%" ><i class="fa fa-exchange"></i> Presunutá</button>
            </div>
            <div class="col-md-10">
                v tomto stave sa nachádza požiadavka, na ktorej vyriešenie nemá správca na doterajšej úrovni kompetencie. V takomto prípade požiadavku presunie na správcu na vyššej úrovni.
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-success" style="width:100%" ><i class="fa fa-check"></i> Vyriešená</button>

            </div>
            <div class="col-md-10">
                v tomto stave sa nachádza uzavretá, vyriešená požiadavka.
            </div>
        </div>


    </div>
</div>
    </div>
@stop