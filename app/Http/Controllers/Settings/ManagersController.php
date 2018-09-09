<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Area;

use App\Notifications\Manager\GlobalManagerAttached;
use App\Notifications\Manager\GlobalManagerDetached;
use Illuminate\Http\Request;

class ManagersController extends Controller
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

        $areaObj = Area::withoutGlobalScope('not_global')->find(1);

        $users = User::all();

        $managers = [];
        for($i = 1; $i <= env('MANAGER_LEVELS'); $i++){

            $managers[$i] = $areaObj->managers()->where('level', $i)->get();
        }
        
        return view('settings.managers.index', compact(['users','managers']));
    }

    public function store(Request $request){
        $areaObj = Area::withoutGlobalScope('not_global')->find(1);


        $managers = $request->input('manager');
        for ($i = 1; $i <= env('MANAGER_LEVELS'); $i++) {

            $old = $areaObj->managers()->where('level', $i)->pluck('users.id')->toArray();
            $new = isset($managers[$i]) ? $managers[$i] : [];

            foreach($old as $id){
                if(!in_array($id, $new)){
                    $areaObj->managers()->detach($id, ['level' => $i]);

                    User::find($id)->notify(new GlobalManagerDetached($areaObj, $i));
                }
            }

            foreach($new as $id){
                if(!in_array($id, $old)){
                    $areaObj->managers()->attach($id, ['level' => $i]);

                    User::find($id)->notify(new GlobalManagerAttached($areaObj, $i));
                }
            }
        }

        return redirect(action('Settings\ManagersController@index'));
    }
}
