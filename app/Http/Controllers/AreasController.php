<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

use App\Http\Requests;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return redirect(action('SettingsController@index'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = new Area;
        return view('areas.edit', compact(['area']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $area = Area::Create(['name'=>$request->name, 'pc'=>$request->pc]);

        $area->admins()->attach($request->adminL1,['level'=>1]);
        $area->admins()->attach($request->adminL2,['level'=>2]);

        return redirect(action('AreasController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::find(intval($id));
        $adminsL1 = $area->admins()->where('level',1)->get();
        $adminsL2 = $area->admins()->where('level',2)->get();

        return view('areas.edit', compact(['area','adminsL1','adminsL2']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $area = Area::find(intval($id));

        $area->name = $request->name;
        $area->pc = $request->pc;

        $admins = $area->admins()->where('level',1)->orWhere('level',2)->get();
        foreach ($admins as $admin) {
            $area->admins()->detach($admin->id);
        }

        $area->admins()->attach($request->adminL1,['level'=>1]);
        $area->admins()->attach($request->adminL2,['level'=>2]);

        $area->save();

        return redirect(action('AreasController@index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $failure = Area::find($id);
        return view('areas.delete',compact(['failure']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);
        $area->enable = 0;
        $area->save();

        return redirect(action('AreasController@index'));

    }
}
