@extends('layouts.wrapper')

@section('body')
<div class="container">
    <div class="row">
        <div id="login-panel" class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

            <h1>{{ env('APP_NAME') }}</h1>
            <div class="logo">
                <img src="{{asset('img/logo_spse.png')}}" alt="SPSE-PO logo"/>
            </div>


            @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    <ul class="errors">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('login') }}" role="form">
                {!! csrf_field() !!}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control input-lg" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control input-lg" name="password" placeholder="Heslo" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="checkbox text-center">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Zapamataj si prihlasenie
                        </label>
                    </div>
                </div>

                <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-lg btn-danger btn-block">Prihlásiť sa</button>

            </form>

            <div class="text-center">
                <a href="{{ action('HelpController@index') }}">
                    <i class="fa fa-4x fa-question-circle" aria-hidden="true"></i>
                    </br>
                    nápoveda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
