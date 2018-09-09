<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use App\Models\Area;
use App\Models\User;

use App\Notifications\Manager\ManagerAttached;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        $users = User::all();
        return view('settings.areas.index', compact(['areas', 'users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areaObj = new Area;
        $form_action = action('Settings\AreaController@store');

        $managers = [];
        for ($i = 1; $i <= env('MANAGER_LEVELS'); $i++) {
            $managers[$i] = [];
        }
        return view('settings.areas.edit', compact(['areaObj', 'managers', 'form_action']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'pc' => 'required|integer|min:1|max:100'
        ]);

        if ($validator->fails()) {
            return redirect(action('Settings\AreaController@create'))
                ->withErrors($validator)
                ->withInput();
        }

        $areaObj = Area::Create([
            'name' => $request->input('name'),
            'pc' => $request->input('pc')
        ]);

        $managers = $request->input('manager');
        for ($i = 1; $i <= env('MANAGER_LEVELS'); $i++) {

            $new = isset($managers[$i]) ? $managers[$i] : [];

            foreach($new as $id){
                $areaObj->managers()->attach($id, ['level' => $i]);

                User::find($id)->notify(new ManagerAttached($areaObj, $i));
            }
        }

        return redirect(action('Settings\AreaController@index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areaObj = Area::find(intval($id));
        $form_action = action('Settings\AreaController@update', [$areaObj->id]);
        $form_method = 'put';

        $managers = [];
        for ($i = 1; $i <= env('MANAGER_LEVELS'); $i++) {
            $managers[$i] = $areaObj->managers()->where('level', $i)->get();
        }

        return view('settings.areas.edit', compact(['areaObj', 'managers', 'form_action', 'form_method']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $areaObj = Area::find(intval($id));

        $areaObj->name = $request->input('name');
        $areaObj->pc = $request->input('pc');

        $managers = $request->input('manager');
        for ($i = 1; $i <= env('MANAGER_LEVELS'); $i++) {

            $old = $areaObj->managers()->where('level', $i)->pluck('users.id')->toArray();
            $new = isset($managers[$i]) ? $managers[$i] : [];

            foreach($old as $id){
                if(!in_array($id, $new)){
                    $areaObj->managers()->detach($id, ['level' => $i]);

                    User::find($id)->notify(new ManagerDetached($areaObj, $i));
                }
            }

            foreach($new as $id){
                if(!in_array($id, $old)){
                    $areaObj->managers()->attach($id, ['level' => $i]);

                    User::find($id)->notify(new ManagerAttached($areaObj, $i));
                }
            }
        }

        $areaObj->save();

        return redirect(action('Settings\AreaController@index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $areaObj = Area::find($id);
        $form_action = action('Settings\AreaController@destroy', [$areaObj->id]);
        $form_method = 'delete';
        return view('settings.areas.delete',compact(['areaObj','form_action','form_method']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $areaObj = Area::find($id);
        $areaObj->delete();

        return redirect(action('Settings\AreaController@index'));

    }
}
