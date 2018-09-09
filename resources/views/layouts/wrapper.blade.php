<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SPSE Presov information system">
    <meta name="author" content="Slavomir Kozar jr., SPSE Presov">

    <title></title>

    <style>
        body{
            padding-top: 70px;
        }

        .data-list .data-row{
            display: flex;
            justify-content: space-between;
            margin: 0;
            padding-bottom: 5px;
            margin-bottom: 5px;
            border-bottom: 1px solid #e7e7e7;
        }

        .data-list .data-row > div{
            padding: 0;
        }

        .data-list .data-row .lead{
            margin-bottom: 0;
        }
    </style>
    <link href="{!! asset('css/bootstrap.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/timeline.css') !!}" rel="stylesheet">
{{--    <link href="{!! asset('css/sb-admin-2.css') !!}" rel="stylesheet">--}}
    <link href="{!! asset('css/font-awesome.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/select2.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/loader.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/login.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/sidebar.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/bootstrap-select.css') !!}" rel="stylesheet">
    <style>

        .heading{
            margin-bottom: 3rem;
            text-align: left;
        }

        #quick-stats{
            display: flex;
        }

        #quick-stats .stats-panel{
            width: 25%;
            padding: 1rem 2rem;
            margin-right: .2rem;
        }
        #quick-stats .stats-panel:last-of-type{
            margin-right: 0;
        }

        #quick-stats .stats-panel .icon{
            display: none;
        }

        #quick-stats .stats-panel .stats-value{
            text-align:center;
            font-size: 60%;

        }

        #quick-stats .stats-panel .stats-value .huge{
            font-size: 3rem;
        }


        .table-heading{
            font-size: 80%;
            font-weight: 500;
            border-bottom: 2px solid black;
            padding: .5rem;
        }

        @media only screen and (min-width:768px){
            #quick-stats .stats-panel{
                display: flex;
                justify-content: space-between;
            }

            #quick-stats .stats-panel .icon{
                display: block;
            }

            #quick-stats .stats-panel .stats-value{
                text-align:right;
                font-size: 100%;
            }

            #quick-stats .stats-panel .stats-value .huge{
                font-size: 5rem;
            }

            .table-heading{
                font-size: 120%;
            }
        }


        /*background:#fff; color:#337ab7;*/

        .label-lg{
            display: inline-block;
            padding: .8rem 1rem .8rem;
            font-size: 100%;
            font-weight: 300;
        }

        .ticket{
            font-size: 15px;
            letter-spacing: 1px;
            padding: 0 .5rem;
        }

        .ticket strong{
            display: block;
            padding: .5rem 0;
            font-weight: 500;
            letter-spacing: 2px;
        }


        @media only screen and (max-width:768px){
            .ticket .col-xs-12{
                background: rgba(255, 255, 255, .5);
            }
        }


        .ticket.ticket-pending{
            color: #000 !important;
            background: rgba(204, 0, 0, .2) !important;

            border: solid #CC0000;
            border-width: .1rem 0 .1rem 0;
        }

        .ticket.ticket-processing{
            color: #000 !important;
            background: rgba(255, 136, 0, .2) !important;

            border: solid #ff8800;
            border-width: .1rem 0 .1rem 0;
        }

        .ticket.ticket-transfered{
            color: #000 !important;
            background: rgba(0, 153, 204, .2) !important;
            border: solid #0099CC;
            border-width: .1rem 0 .1rem 0;
        }
        .ticket.ticket-done{
            color: #000 !important;
            background: rgba(0, 126, 51, .2) !important;
            border: solid #007E33;
            border-width: .1rem 0 .1rem 0;
        }

        .ticket-pending{
            color: #fff !important;
            background: #CC0000 !important
        }

        .ticket-processing{
            color: #fff !important;
            background: #ff8800 !important
        }

        .ticket-transfered{
            color: #fff !important;
            background: #0099CC !important

        }
        .ticket-done{
            color: #fff !important;
            background: #007E33 !important
        }


        .ticket-radio{
            display: block;
            text-align: left;
            padding: 6px 12px;
            margin-bottom: .2rem;
            font-size: 16px;
            font-weight: normal;
            line-height: 1.42857143;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 0px;
            min-width: 15rem;
            max-width: 20rem;
            position: relative;
            padding-left: 60px;
        }

        .ticket-radio.disabled{
            -webkit-filter: grayscale(50%); /* Safari 6.0 - 9.0 */
            filter: grayscale(50%);
            opacity: .5;
            cursor: not-allowed;
        }

        /* Hide the browser's default radio button */
        .ticket-radio input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .ticket-radio .checkmark {
            border:2px solid #fff;
            position: absolute;
            top: 4px;
            left: 8px;
            height: 24px;
            width: 24px;
            background-color: #eee;
            border-radius: 50%;
        }

        /* On mouse-over, add a grey background color */
        .ticket-radio:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .ticket-radio input:checked ~ .checkmark {
            background-color: #2196F3;

        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .ticket-radio .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .ticket-radio input:checked ~ .checkmark:after {
            display: block;
        }


        /* Show the indicator (dot/circle) when checked */
        .ticket-radio input:disabled ~ .checkmark:after {
            display: block;
        }


        /* Style the indicator (dot/circle) */
        .ticket-radio .checkmark:after {
            top: 6px;
            left: 6px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }


        h1, h2, h3 {
            margin-top: 0;
        }
    </style>

    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

@yield('body')

<div id="page-loader-wrapper">
    <div class="loader">
        <div class="spinner">
            <div class="point point1">
                <div></div>
            </div>
            <div class="point point2">
                <div></div>
            </div>
            <div class="point point3">
                <div></div>
            </div>
            <div class="point point4">
                <div></div>
            </div>
        </div>
        <div class="logo"></div>
    </div>
</div>

<script src="{!! asset('js/jquery.min.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('js/select2.js') !!}"></script>
<script src="{!! asset('js/bootstrap-select.js') !!}"></script>
<script>
    $( document ).ready(function() {
        $('#page-loader-wrapper').addClass('hidden');
    });
</script>
{{--<script src="{!! asset('js/custom.js') !!}"></script>--}}
@yield('scripts')

</body>
</html>