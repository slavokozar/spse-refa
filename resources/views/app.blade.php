<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SPSE Presov information system">
    <meta name="author" content="Slavomir Kozar jr., SPSE Presov">

    <title>IS - SPŠE Prešov</title>


    <!-- Bootstrap Core CSS -->
    <link href="{!! asset('css/bootstrap.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/timeline.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/sb-admin-2.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/font-awesome.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/select2.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/loader.css') !!}" rel="stylesheet">

    @section('styles')
    @show
            <style>
                #test-mode{
                    font-size:14px;
                    position:absolute;
                    top: 120px;
                    right: -100px;
                    background: #d9534f;
                    text-align: center;
                    width:400px;
                    height:80px;
                    color: #fff;
                    -ms-transform: rotate(45deg); /* IE 9 */
                    -webkit-transform: rotate(45deg); /* Chrome, Safari, Opera */
                    transform: rotate(45deg);
                }
                #test-head{
                    font-size:140%;
                }
            </style>

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">SPSE Support
                    <!-- <img src="../logo_spse.png" style="height:80pt"/> -->
                </a>

            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                @if(Auth::check())
                <li>
                    <a href="/help"><i class="fa fa-question-circle fa-fw"></i>Nápoveda</a>
                </li>

                <li>

                    <a href="{!! action('TicketsController@index') !!}"><i class="fa fa-user-md fa-fw"></i>Požiadavky na podporu</a>

                </li>



                <li>
                    @if(Auth::user()->isSuperAdmin())
                    <a href="{!! action('SettingsController@index') !!}"><i class="fa fa-gears fa-fw"></i> Nastavenia</a>
                    @endif
                </li>



                <li  class="dropdown">

                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="fa fa-user"></i> {{Auth::user()->name}}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="{!! action('Auth\PasswordController@getChange') !!}"><i class="fa fa-unlock-alt"></i> Zmeniť heslo</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{!! action('Auth\AuthController@getLogout') !!}"><i class="fa fa-sign-out"></i> Odhlásiť</a></li>
                        </ul>

                </li>
                @endif

            </ul>

        </nav>

        <div id="page-wrapper" class="page-wrapper-noside">
            @if (Session::has('flash_notification.message'))

                    <div class="row">
                        <div class="col-lg-12">
                            <p>
                                <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ Session::get('flash_notification.message') }}
                                </div>
                            </p>


                        </div>
                    </div>



            @endif


            @section('content')
            @show


        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <div id="page-loader-wrapper">
        <div class="loader">
            <div class="spinner">
                <div class="point point1"><div></div></div>
                <div class="point point2"><div></div></div>
                <div class="point point3"><div></div></div>
                <div class="point point4"><div></div></div>
            </div>
            <div class="logo"></div>
        </div>
    </div>

    <div id="test-mode">
        <span id="test-head">Testovacia prevádzka</span><br/>
        v prípade problému píšte na<br/>
        slavo.kozar@gmail.com
    </div>

    <!-- jQuery -->
    <script src="{!! asset('js/jquery.min.js') !!}"></script>
    <script src="{!! asset('js/bootstrap.min.js') !!}"></script>
    <script src="{!! asset('js/select2.js') !!}"></script>
    <script src="{!! asset('js/custom.js') !!}"></script>

    @section('scripts')
    @show

</body>

</html>
