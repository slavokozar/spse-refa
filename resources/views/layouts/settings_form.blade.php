@extends('layouts.settings')

@section('settings-content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @yield('form_header')

            @if(isset($form_action))
                <form class="form-horizontal" method="post" action="{{ $form_action }}">
                    {!! csrf_field() !!}
                    @endif

                    @yield('form_body')

                    <div class="text-right">
                        @yield('form_footer')
                    </div>


                    @if(isset($form_action))
                </form>
            @endif
        </div>
    </div>

@endsection
