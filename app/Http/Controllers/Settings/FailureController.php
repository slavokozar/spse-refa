<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\FailureReqeust;
use App\Models\Failure;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class FailureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $failures = Failure::all();
        return view('settings.failures.index', compact(['failures']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $failureObj = new Failure;

        $form_action = action('Settings\FailureController@store');

        return view('settings.failures.edit', compact(['failureObj', 'form_action']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(action('Settings\FailureController@create'))
                ->withErrors($validator)
                ->withInput();
        }

        Failure::Create([
            'name'=>$request->input('name')
        ]);
        return redirect(action('Settings\FailureController@index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $failureObj = Failure::find(intval($id));
        $form_action = action('Settings\FailureController@update', [$failureObj->id]);
        $form_method = 'put';

        return view('settings.failures.edit', compact(['failureObj', 'form_action', 'form_method']));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(action('Settings\FailureController@edit', [$id]))
                ->withErrors($validator)
                ->withInput();
        }

        $failure = Failure::find(intval($id));
        $failure->name = $request->input('name');
        $failure->save();

        return redirect(action('Settings\FailureController@index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $failureObj = Failure::find($id);
        $form_action = action('Settings\FailureController@destroy', [$failureObj->id]);
        $form_method = 'delete';
        return view('settings.failures.delete',compact(['failureObj','form_action','form_method']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $failureObj = Failure::find($id);
        $failureObj->delete();

        return redirect(action('Settings\FailureController@index'));
    }
}
