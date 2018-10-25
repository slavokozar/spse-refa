<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StatsController extends Controller
{
    public function users()
    {
        $users = User::get();

        return view('stats/users', compact(['users']));
    }


    public function areas()
    {
        $areas = Area::all();

        return view('stats/areas', compact(['areas']));
    }

}
