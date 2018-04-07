<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use App\User;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except'=>['register','login']]);
    }

  
    public function login(Request $request)
    {
    $credentials = $request->only('email','password');
    if($token=$this->guard()->attempt($credentials)){
        return $this->responseWithToken($token);
    }
    return response()->json(['error'=>'authorized'],401);
    }

  
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

    protected function responseWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>$this->guard()->factory()->getTTL() * 60
        ]);
    }

    public function guard(){
        return Auth::guard();
    }


    public function me(){
        return response()->json($this->guard()->user());
    }
}
