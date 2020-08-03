<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;

class UserController extends Controller
{
    
    public function login(Request $request)
    {
        $auth=Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if($auth){
            return response()->json(['data'=>User::where('email',$request->email)->with(['role','employee'])->get()]);
        }else{
            return response()->json(['data'=>'Unauthorized action.'],403);
        }
    }

    public function index()
    {
        return response()->json(['data'=>User::with(['employee','role'])->get()]);
    }

    public function store(Request $request)
    {
        return response()->json(['data'=>User::create($request->all())]);
    }

    public function show(User $user)
    {
        return response()->json(['data'=>$user->with(['employee','role'])->get()]); 
    }

}
