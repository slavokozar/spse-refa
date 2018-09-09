<?php

namespace App\Http\Controllers;

use App\Area;
use App\Failure;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->logged = User::where('email','slavo.kozar@gmail.com')->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $areas = Area::where('enable',1)->where('id','!=',1)->get();
        $failures = Failure::where('enable',1)->get();

        $users = User::all();
        $logged = $this->logged;

        $area = Area::find(1);

        $adminsL3 = $area->admins()->where('level',3)->get();
        $adminsL4 = $area->admins()->where('level',4)->get();

        return view('settings.index', compact(['logged','areas','failures','users','adminsL3','adminsL4']));

    }

//    public function mail(){
//        Mail::raw('Message text', function($message) {
//            $message->from('hwservis@spse-po.sk', 'SPSE HW udrzba');
//            $message->to('slavo.kozar@gmail.com');
//        });
//    }


    public function store(Request $request){
        $area = Area::find(1);

        $admins = $area->admins()->where('level',3)->orWhere('level',4)->get();
        foreach ($admins as $admin) {
            $area->admins()->detach($admin->id);
        }

        $area->admins()->attach($request->adminL3,['level'=>3]);
        $area->admins()->attach($request->adminL4,['level'=>4]);

        $area->save();

        return redirect(action('SettingsController@index'));
    }
}
