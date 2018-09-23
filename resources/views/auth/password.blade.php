@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{$logged->name}}</h1>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2>Zmena hesla</h2>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="{{action('Auth\PasswordController@postChange')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                        <div class="row">
                            <div class="col-md-12">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        {{$errors->first()}}
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Aktuálne heslo</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="old_password" class="form-control" id="inputEmail3">
                                    </div>
                                </div>

                                <hr/>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">Nové heslo</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="new_password" class="form-control" id="inputPassword3">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">Nové heslo znova</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="new_password_confirmation" class="form-control" id="inputPassword3">
                                    </div>
                                </div>


                            </div>

                            <div class="col-lg-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary btn-lg">Uložiť</button>
                                    <button type="button" class="btn btn-danger btn-lg">Zrušiť</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>

    </form>


@stop
