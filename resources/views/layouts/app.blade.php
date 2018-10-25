@extends('layouts.wrapper')

@section('body')
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <ul class="nav navbar-nav navbar-right">

                    <li><a href="{{ action('Tickets\TicketController@index') }}">Moje požiadavky</a></li>

                    @if(Auth::user()->isAdmin())
                        <li><a href="{{ action('Management\TicketController@index') }}">Správa požiadaviek</a></li>
                    @endif

                    @if(Auth::user()->isSuperAdmin())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Statistiky <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ action('StatsController@users') }}">Uzivatelia</a>
                                </li>
                                <li>
                                    <a href="{{ action('StatsController@areas') }}">Miestnosti</a>
                                </li>
                            </ul>
                        </li>

                        <li class="hidden-xs"><a href="{{ action('Settings\SettingsController@index') }}">Nastavenia</a></li>

                        <li class="visible-xs-block dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Nastavenia <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{action('Settings\SettingsController@index')}}">{{ trans('settings.index.link') }}</a>
                                </li>
                                <li{!! $_controller == 'ManagersController' ? ' class="active"' : '' !!}>
                                    <a href="{{action('Settings\ManagersController@index')}}">{{ trans('settings.managers.link') }}</a>
                                </li>
                                <li{!! $_controller == 'AreaController' ? ' class="active"' : '' !!}>
                                    <a href="{{action('Settings\AreaController@index')}}">{{ trans('settings.areas.link') }}</a>
                                </li>
                                <li{!! $_controller == 'FailureController' ? ' class="active"' : '' !!}>
                                    <a href="{{action('Settings\FailureController@index')}}">{{ trans('settings.failures.link') }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif



                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer style="margin-top: 3rem">
        <div class="container">
                <div class="text-center" style="margin-bottom: 0.5rem">
                    <a class="text-danger" href="{{ action('HelpController@index') }}">
                        <i class="fa fa-4x fa-question-circle" aria-hidden="true"></i><br/>Pomoc
                    </a>
                </div>
                <div class="text-center">
                    &copy; 2018 <a href="https://spse-po.sk">SPŠE Prešov</a> & <a href="https://slavokozar.sk">Ing. Slavomír Kožár jr.</a>
                </div>
        </div>
    </footer>
@endsection

@section('scripts')
    @if(isset($users))
        <script>
            var users = [
                    @foreach($users as $user)
                {
                    id: {!! $user->id !!}, text: '{!! $user->name !!}'
                },
                @endforeach
            ];

            $('.select-users').select2({
                data: users
            });


        </script>
    @endif

    <script>
        $(document).ready(function () {
            if (window.screen.width > 768) {
                $('.select').select2({
                    minimumResultsForSearch: Infinity
                });
            }


            $('[data-toggle="modal"]').click(function (e) {
                var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
                if(w < 768) return;

                console.log('modal');

                e.preventDefault();
                e.stopPropagation();

                var href = $(this).attr('href');
                $.ajax({
                    'url': href
                }).done(function (data) {

                    var $modal = $(data);
                    $('body').append($modal);

                    $modal.modal('show');

                    var $select_users = $modal.find('.select-users');
                    if ($select_users.length > 0) {
                        $select_users.select2({
                            data: users
                        });
                    }

                    $modal.on('hidden.bs.modal', function () {
                        $modal.remove();
                    })

                });

            });
        });

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}});

        $(document).ajaxStart(function () {
            $('#page-loader-wrapper').removeClass('hidden');
        });

        $(document).ajaxStop(function () {
            $('#page-loader-wrapper').addClass('hidden');
        });


        $('[name="area"]').change(function(){
            var $selected = $(this).find(":selected");

            var $select = $('[name="computer"]');
            $select.empty();
            for(var i = 1; i <= $selected.data('pc'); i++){
                $select.append('<option value="' + i + '">PC' + i + '</option>');
            }
        })

    </script>

@endsection
