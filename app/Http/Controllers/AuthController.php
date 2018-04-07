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
           'firstName' =>'required',
           'email' =>'unique:users|required',
           'password' =>'required'
       ];

       $input = $request->only('firstName','email','password');
       $validator = Validator::make($input, $rules);
       if($validator->fails()){
           return response()->json(['success'=>false,'error'=>$validator->messages()]);
       }
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $email = $request->email;
        $password = $request->password;

        $user = User::create([
            'firstName'=>$firstName,
            'lastName'=>$lastName,
            'email'=>$email,
            'password'=>Hash::make($password),
        ]);

        return response()->json(['success'=>true]);



    }
}
