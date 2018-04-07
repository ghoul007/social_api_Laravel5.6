<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use App\User;
class AuthController extends Controller
{
    

      public function register(Request $request)
    {
       $rules= [
           'name' =>'unique:users|required',
           'email' =>'unique:users|required',
           'password' =>'required'
       ];

       $input = $request->only('name','email','password');
       $validator = Validator::make($input, $rules);
       if($validator->fails()){
           return response()->json(['success'=>false,'error'=>$validator->messages()]);
       }
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $user = User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password),
        ]);

        return response()->json(['success'=>true]);



    }
}
