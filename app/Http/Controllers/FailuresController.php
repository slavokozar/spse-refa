<?php

namespace App\Http\Controllers;

use App\Failure;
use Illuminate\Http\Request;

use App\Http\Requests;

class FailuresController extends Controller
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
        $failure = new Failure;
        return view('failures.edit', compact(['failure']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Failure::Create(['name'=>$request->name, 'pc'=>$request->pc]);
        return redirect(action('FailuresController@index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $failure = Failure::find(intval($id));
        $action = 'update';
//        return compact(['failure','action']);
        return view('Failures.edit', compact(['failure','action']));

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
        $failure = Failure::find(intval($id));

        $failure->name = $request->name;

        $failure->save();

        return redirect(action('FailuresController@index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $failure = Failure::find($id);
        return view('failures.delete',compact(['failure']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $failure = Failure::find($id);
        $failure->enable = 0;
        $failure->save();

        return redirect(action('FailuresController@index'));
    }
}
