<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

//    var rows = $('.table0 tr');
//    var teachers = Array();
//    for (var i = 1; i < rows.length; i++){
//
//        var teacher = {
//            'name' : $(rows[i]).find('td').first().text(),
//            'email' : $(rows[i]).find('td').last().text().replace("(zavináč)", "@")
//        };
//
//        teachers.push(teacher);
//    }
//    JSON.stringify(teachers);

public
function import()
{
    $users = '[{"name":"Ing. Slavomír Kožár, MBA","email":"0905 347 112"},{"name":"Ing. Judita Sakáčová","email":"0918 739 298"},{"name":"Mgr. Vladimír Hudáček ","email":"0918 740 576"},{"name":"Ing. Juraj Budiš","email":"0918 740 018"},{"name":"Mgr. Viera Barjaková","email":"barjakova(zavináč)spse-po.sk"},{"name":"Mgr. Tatiana Imrichová","email":"imrichova(zavináč)spse-po.sk"},{"name":"Ing. Viera Kuchárová","email":"kucharova(zavináč)spse-po.sk"},{"name":"Iveta Vinklerová","email":"vinklerova(zavináč)spse-po.sk"}]';



    $users = json_decode($users, JSON_UNESCAPED_UNICODE);


    foreach ($users as $user) {

        if (User::where('email', $user['email'])->get()->count() == 0) {
            $password = str_random(8);
            $user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
//                'password' => Hash::make($password)
            ]);

//            Mail::send('emails.import', compact(['user','password']), function ($message) use ($user){
//                $message->from('hwservis@spse-po.sk', 'HW servis');
//                $message->subject('HW Servis SPSE - Vytvorenie prístupu');
//                $message->to($user->email);
//            });

        }

    }


}

public function edit()
{

}


public function update(Request $request)
{

    $user = Auth::user();


    if (Hash::check($request->old_password, $user->password) && $request->password == $request->old_password) {
        $user->password = bcrypt($request->$password);
    }


}
}
