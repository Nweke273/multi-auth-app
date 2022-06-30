<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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

        $user = new Admin();
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

    function check(Request $request){
        $responseStatus = 0;
         $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30'
         ],[
             'email.exists'=>'This email is not exists in admins table'
         ]);

         $creds = $request->only('email','password');

         if( Auth::guard('admin')->attempt($creds) ){
            $responseStatus = 1;

         }else{
            $responseStatus = 3;
         }
           return response()->json([[$responseStatus]]);
    }

    function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
