<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function create(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ]);

        $responseStatus = 0;

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            $responseStatus = 1;
        } else {
            $responseStatus = 2;
        }
        return response()->json([[$responseStatus]]);
    }

    function check(Request $request)
    {
        //Validate inputs
        $responseStatus = 0;
        $validation = $request->validate([
            'email' => 'required',
            'password' => 'required|min:5|max:30'
        ]);


        $creds = $request->only('email', 'password');
        if (Auth::attempt($creds)) {
            $responseStatus = 1;
        } else {
            $responseStatus = 3;
        }
        return response()->json([[$responseStatus]]);
    }

    function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
