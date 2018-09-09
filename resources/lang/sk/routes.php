<?php

return [
    'help' => 'pomoc',

    'tickets' => [
        'index' => '/poziadavky',
        'create' => '/poziadavky/nova',
        'store' => '/poziadavky',
        'show' => '/poziadavky/{id}',
    ],

    'management' => [
        'index' => '/sprava/{area?}',
        'show' => '/sprava/poziadavka/{ticket}',
        'status' => '/sprava/poziadavka/{ticket}/stav'
    ],

    'settings' => [

        'index' => '/nastavenia',

        'managers' => [
            'index' => '/nastavenia/spravcovia',
            'store' => '/nastavenia/spravcovia',
        ],

        'areas' => [
            'index' => '/nastavenia/ucebne',
            'create' => '/nastavenia/ucebne/nova',
            'store' => '/nastavenia/ucebne',
            'show' => '/nastavenia/ucebne/{ucebna}',
            'edit' => '/nastavenia/ucebne/{ucebna}/uprava',
            'update' => '/nastavenia/ucebne/{ucebna}/uprava',
            'delete' => '/nastavenia/ucebne/{ucebna}/vymazat',
            'destroy' => '/nastavenia/ucebne/{ucebna}/vymazat'
        ],

        'failures' => [
            'index' => '/nastavenia/poruchy',
            'create' => '/nastavenia/poruchy/nova',
            'store' => '/nastavenia/poruchy',
            'show' => '/nastavenia/poruchy/{porucha}',
            'edit' => '/nastavenia/poruchy/{porucha}/uprava',
            'update' => '/nastavenia/poruchy/{porucha}/uprava',
            'delete' => '/nastavenia/poruchy/{porucha}/vymazat',
            'destroy' => '/nastavenia/poruchy/{porucha}/vymazat'
        ]

    ]

];
