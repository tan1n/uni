<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use Hash;

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
        return response()->json(['data'=>User::create([
            'name'=>$request->name,
            'employee_id'=>$request->employee_id,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'role_id'=>$request->role_id
        ])]);
    }

    public function show(User $user)
    {
        return response()->json(['data'=>$user->with(['employee','role'])->get()]); 
    }

}
