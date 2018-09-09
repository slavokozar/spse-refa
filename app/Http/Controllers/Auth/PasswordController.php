<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


    public function __construct()
    {
//        $this->middleware('guest');
    }


    public function getChange()
    {
        $logged = Auth::User();
        return view('auth.password', compact(['logged']));

    }

    public function postChange(Request $request)
    {
        $user = Auth::user();

        if (Auth::validate(array('email' => Auth::user()->email, 'password' => Input::get('old_password')))){
            if(strlen($request->new_password) < 6){
                return Redirect::back()->withErrors(['Nové heslo musí mať minimálne 6 znakov!']);
            }

            if($request->new_password == $request->new_password_confirmation) {
                $user->password = bcrypt($request->new_password);
                $user->save();
            }else{
                return Redirect::back()->withErrors(['Heslá sa musia zhodnovať!']);
            }
        }else{
            return Redirect::back()->withErrors(['Staré heslo sa nezhoduje!']);
        }

        Flash::success('Heslo úspešne zmenené');
        return redirect(action('TicketsController@index'));


    }
}
